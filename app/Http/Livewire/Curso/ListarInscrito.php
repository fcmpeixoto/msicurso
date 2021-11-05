<?php

namespace App\Http\Livewire\Curso;

use App\Exports\Relatorio\ReportListaInscritoXls;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Excel;

class ListarInscrito extends Component
{

    //public $rsMorador;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $openAdvancedFilters = false;
    public $porPagina = 10;
    public $ordenar   = [];
    protected $getRelatorio = [];
    public $filtros = ['busca' => null];
    public $uuidmodal =  null;
    public $status;

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
        $query = Pedido::query()->with('itemnspedido','user')->when($this->filtros['busca'], function ($query, $busca) {
            $query->whereRelation('user', 'name', "like", "%$busca%");
            $query->orwhereRelation('user', 'email', "like", "%$busca%");
            $query->orWhere('status', "like", "%$busca%");
            $query->orWhere('tipo_pessoa', "like", "%$busca%");
        });

        return $this->fazOrdenacao($query);
    }

    public function updatedPorPagina($value)
    {
        $this->resetPage();
        session()->put('ordenarPor', $value);
    }

    public function arquivoPdf()
    {

        $report = new \App\Relatorios\ReportListaInscritop($this->runQueryBuilder()->paginate($this->porPagina));
        $report->BuildPDF();
        //$report->Exibir('lista-de-usuarios');

        return Storage::disk('relatorio')->download('lista-de-usuarios.pdf');
    }

    public function arquivoxls()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new ReportListaInscritoXls($this->runQueryBuilder()->paginate($this->porPagina)), 'lista-de-usuarios.xlsx');

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

                $rsPrdido = Pedido::find($id);
                $rsPrdido->delete();
            });

            $this->dispatchBrowserEvent('alert',['type' => 'success', 'message' => 'Dados Excluídos com Sucesso', 'titulo' => 'Sucesso!']);
            $this->runQueryBuilder()->paginate($this->porPagina);
            $this->fecharModalDelete();

        }catch (\Exception $e){

            $this->dispatchBrowserEvent('alert',['type' => 'error', 'message' => 'Erro ao Excluir'.$e->getCode(), 'titulo' => 'Error!']);
        }
    }

    public function fecharModalEdit()
    {
        $this->uuidmodal = null;
        $this->dispatchBrowserEvent('modal-hide',['type' => 'modal-edita-status']);
    }

    public function abrirModalEdit($uuid)
    {
        $this->uuidmodal = (string) $uuid;
        $this->dispatchBrowserEvent('modal-show',['type' => 'modal-edita-status']);
    }

    public function editConfirmar()
    {
        $id = $this->uuidmodal ;

        try{

            DB::transaction(function () use ($id){

                $rsPrdido = Pedido::find($id);
                $rsPrdido->update(['status' => $this->status]);
            });

            $this->dispatchBrowserEvent('alert',['type' => 'success', 'message' => 'Dados Alterados com Sucesso', 'titulo' => 'Sucesso!']);
            $this->runQueryBuilder()->paginate($this->porPagina);
            $this->reset(['status']);
            $this->fecharModalEdit();

        }catch (\Exception $e){

            $this->dispatchBrowserEvent('alert',['type' => 'error', 'message' => 'Erro ao Alterar dados'.$e->getCode(), 'titulo' => 'Error!']);
        }
    }

    public function render()
    {

        $rsInscritos = $this->runQueryBuilder()->paginate($this->porPagina);

        return view('livewire.curso.listar-inscrito', compact('rsInscritos'));
    }
}
