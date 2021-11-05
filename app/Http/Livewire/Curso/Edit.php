<?php

namespace App\Http\Livewire\Curso;

use App\Models\Anexos;
use App\Models\Cursos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use PHPUnit\Exception;

class Edit extends Component
{
    use WithFileUploads;

    public $txtid;
    public $uuidmodal;
    public $txtnomecurso;
    public $txtquantidadecurso;
    public $txtdescricaocurso;
    public $txtvalorcurso;
    public $txtdatainicio;
    public $txtdatafim;
    public $txrtdatainicio;
    public $txrmaterial;
    public $txrmaterialdescricao;

    public $rsAnexos;
    public $rsCursos;
    public $grupoAnexo = true;

    protected $rules = [
        'txtnomecurso'       => 'required|min:5|max:120',
        'txtdescricaocurso'  => 'required|min:15',
        'txtvalorcurso'      => 'required|regex:/[0-9]{0,10}[.][0-9]{0,10}[,]{1,1}[0-9]{0,2}/',
        'txtdatainicio'      => 'date_format:d/m/Y',
        'txtdatafim'         => 'date_format:d/m/Y',
        'txtquantidadecurso' => 'required|numeric',
    ];

    protected $messages = [];

    protected $validationAttributes = [
        'txtnomecurso'       => 'NOME DO CURSO',
        'txtquantidadecurso' => 'NUMERO DE VAGAS',
        'txtdescricaocurso'  => 'DESCRIÇÃO',
        'txtvalorcurso'      => 'VALOR',
        'txtdatainicio'      => 'DATA DO INÍCIO',
        'txtdatafim'         => 'DATA DO FIM'
    ];

    public function render()
    {
        $this->edit($this->rsCursos->id);
        return view('livewire.curso.edit');
    }

    public function store()
    {

        $data = $this->validate();

        try{

            DB::transaction(function () use ($data) {
                $this->rsCursos = Cursos::updateOrCreate(
                    ['id' => $this->txtid],
                    [
                        'nome'          => $data['txtnomecurso'],
                        'descricao'     => $data['txtdescricaocurso'],
                        'valor'         => $data['txtvalorcurso'],
                        'data_inicio'   => $data['txtdatainicio'],
                        'data_fim'      => $data['txtdatafim'],
                        'qtd_inscritos' => $data['txtquantidadecurso'],
                    ]
                );
            });

            $this->dispatchBrowserEvent('alert',['type' => 'success', 'message' => 'Dados Gravados com Sucesso', 'titulo' => 'Sucesso!']);
            $this->resetFormCurso();
            $this->grupoAnexo = true;

        }catch (Exception $exception){

            return redirect()->back()->with('warning', 'Entre em contato com o administrador do Sistema.' . $exception->getCode());
        }

    }

    public function edit($id)
    {
        //
        $rsCursos = Cursos::with('anexos')->find( $id);

        $this->txtid              = (string) $rsCursos->id;
        $this->txtnomecurso       = $rsCursos->nome;
        $this->txtdescricaocurso  = $rsCursos->descricao;
        $this->txtvalorcurso      = $rsCursos->valor;
        $this->txtdatainicio      = $rsCursos->data_inicio;
        $this->txtdatafim         = $rsCursos->data_fim;
        $this->txtquantidadecurso = $rsCursos->qtd_inscritos;
    }

    public function uploadMaterial()
    {
        //
        try{
            $data = $this->validate([
                'txrmaterial'          => 'required|mimes:pdf|max:15048', // 1MB Max
                'txrmaterialdescricao' => 'required|min:5|max:120',
            ],[],['txrmaterial' => 'ARQUIVO', 'txrmaterialdescricao' => 'DESCRICAO DO MATERIAL']);


            DB::transaction(function () use ($data) {

                $novoNome = null;

                $noArquivo = uniqid(date('HisYmd'));

                $extensaoArquivo =  $data['txrmaterial']->extension();

                $novoNome = "{$noArquivo}.{$extensaoArquivo}";

                $rsAnexos = Anexos::create(
                    [
                        'titulo'  => $data['txrmaterialdescricao'],
                        'caminho' => $noArquivo,
                    ]
                );

                $rsAnexos->curso()->attach($this->rsCursos->id);

                if(!Storage::disk('anexo')->exists($this->uuidmodal))
                {
                    Storage::disk('anexo')->makeDirectory($this->uuidmodal);
                }

                $this->rsCursos = Cursos::find($this->rsCursos->id);
                Storage::disk('anexo')->put($novoNome,$this->uuidmodal);

            });
            $this->dispatchBrowserEvent('alert',['type' => 'success', 'message' => 'Material de apoio Gravado com Sucesso', 'titulo' => 'Sucesso!']);
            $this->resetFormAnexo();

        }catch (Exception $exception) {

            return redirect()->back()->with('warning', 'Entre em contato com o administrador do Sistema.' . $exception->getCode());
        }


    }

    public function resetFormCurso()
    {

        $this->reset(
            [
                'txtid',
                'txtnomecurso',
                'txtdescricaocurso',
                'txtvalorcurso',
                'txtdatainicio',
                'txtdatafim',
                'txtquantidadecurso'
            ]
        );
    }

    public function resetFormAnexo()
    {

        $this->reset(
            [
                'txrmaterial',
            ]
        );
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

    public function fecharModalDeleteAnexo()
    {
        $this->uuidmodal = null;
        $this->dispatchBrowserEvent('modal-hide',['type' => 'modal-deleta-anexo']);
    }

    public function abrirModalDeleteAnexo($uuid)
    {
        $this->uuidmodal = (string) $uuid;
        $this->dispatchBrowserEvent('modal-show',['type' => 'modal-deleta-anexo']);
    }

    public function deleteConfirmar()
    {
        $id = $this->uuidmodal ;

        try{

            DB::transaction(function () use ($id){

                $this->rsCursos = Cursos::find($id);
                $this->rsCursos->delete();
            });

            $this->dispatchBrowserEvent('alert',['type' => 'success', 'message' => 'Dados Excluídos com Sucesso', 'titulo' => 'Sucesso!']);
            $this->resetFormCurso();
            $this->grupoAnexo = false;
            $this->fecharModalDelete();

        }catch (\Exception $e){

            $this->dispatchBrowserEvent('alert',['type' => 'error', 'message' => 'Erro ao Excluir'.$e->getCode(), 'titulo' => 'Error!']);
        }
    }

    public function deleteConfirmarAnexo()
    {
        $id = $this->uuidmodal;
        try{

            DB::transaction(function () use ($id){

                $this->rsAnexos = Anexos::find($id);
                $this->rsAnexos->delete();
            });

            $this->dispatchBrowserEvent('alert',['type' => 'success', 'message' => 'Dados Excluídos com Sucesso', 'titulo' => 'Sucesso!']);
            $this->fecharModalDeleteAnexo();

        }catch (\Exception $e){

            $this->dispatchBrowserEvent('alert',['type' => 'error', 'message' => 'Erro ao Escluir'.$e->getCode(), 'titulo' => 'Error!']);
        }
    }

    public function download($caminho, $arquivo)
    {
        //
        if(File::exists(storage_path("app/anexo/$caminho/$arquivo")))
        {
            return Storage::disk('anexo')->download("$caminho/$arquivo");
        }else{
            return redirect()->back()->with('warning', 'Arquivo não encontrado. Entre em contato com o desenvolvedor do Sistema.');
        }

    }
}
