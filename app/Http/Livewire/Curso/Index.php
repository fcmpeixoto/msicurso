<?php

namespace App\Http\Livewire\Curso;

use App\Models\Cursos;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    //public $rsMorador;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $openAdvancedFilters = false;
    public $porPagina = 10;
    public $ordenar   = [];
    public $filtros = ['busca' => null];
    public $uuid;
    //public $rsCursos;

    public function limparFiltros() {
        $this->reset('filtros');
    }

    public function ordenarPor($coluna)
    {
        if(!isset($this->ordenar[$coluna])) return $this->ordenar[$coluna] = 'asc';
        if($this->ordenar[$coluna] === 'asc') return $this->ordenar[$coluna] = 'desc';

        unset($this->ordenar[$coluna]);
    }

    public function fazOrdenacao($query)
    {
        foreach($this->ordenar as $column => $direction)
        {
            $query->orderBy($column, $direction);
        }
        return $query;
    }

    public function  updatedFiltros()
    {
        $this->resetPage();
    }

    public function runQueryBuilder()
    {
        $query = Cursos::query()->when($this->filtros['busca'], function ($query, $busca) {
            $query->where("nome", "like", "%$busca%");
            $query->orWhere("descricao", "like", "%$busca%");
            $query->orWhere("data_fim", "like", "%$busca%");
            $query->orWhere("data_inicio", "like", "%$busca%");
        });
        return $this->fazOrdenacao($query);
    }

    public function updatedPorPagina($value)
    {
        $this->resetPage();
        session()->put('ordenarPor', $value);
    }

    public function render()
    {
        $rsCursos = $this->runQueryBuilder()->paginate($this->porPagina);
        return view('livewire.curso.index', compact('rsCursos'));
    }

    public function fecharModalDelete()
    {
        $this->uuidmodal = null;
        $this->dispatchBrowserEvent('modal-hide',['type' => 'modal-deleta']);
    }

    public function abrirModalDelete($uuid)
    {
        $this->uuidmodal = (string) $uuid;
        $this->dispatchBrowserEvent('modal-show',['type' => 'modal-deleta']);
    }

    public function deleteConfirmar()
    {
        $id = $this->uuidmodal ;

        try{

            DB::transaction(function () use ($id){

                $trsCursos = Cursos::find($id);
                $trsCursos->delete();
            });

            $this->runQueryBuilder()->paginate($this->porPagina);
            $this->fecharModalDelete();


        }catch (\Exception $e){

            $this->dispatchBrowserEvent('alert',['type' => 'error', 'message' => 'Erro ao Excluir'.$e->getCode(), 'titulo' => 'Error!']);
        }
    }
}
