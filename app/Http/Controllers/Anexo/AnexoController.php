<?php

namespace App\Http\Controllers\Anexo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Anexo\CreateRequest;
use App\Http\Requests\Anexo\DeleteRequest;
use App\Models\Anexos;
use App\Models\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class AnexoController extends Controller
{
    /**
     * @var Anexos
     */
    private $anexosModel;
    /**
     * @var Cursos
     */
    private $cursosModel;

    /**
     * AnexoController constructor.
     */
    public function __construct(Anexos $anexosModel, Cursos $cursosModel)
    {
        $this->anexosModel = $anexosModel;
        $this->cursosModel = $cursosModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        //

        try{

            $novoNome = null;

            if ($request->hasFile('txtanexo') && $request->file('txtanexo')->isValid()) {

                $noArquivo = uniqid(date('HisYmd'));

                $extensaoArquivo = $request->txtanexo->extension();

                $novoNome = "{$noArquivo}.{$extensaoArquivo}";

                $upload = $request->txtanexo->storeAs('anexo', $novoNome);

                if( !$upload ){
                    throw new \Exception('Erro ao Gravar Arquivo. Entre em contato com o Desenvolvedor');
                }

            }

            DB::transaction(function () use ($request, $novoNome) {

                $rsAnexo = $this->anexosModel->create(
                    [
                        'titulo'  => $request->input('txtnomeanexo'),
                        'caminho' => $novoNome
                    ]
                );

                $rsCurso = $this->cursosModel->find($request->input('txtidcurso'))->id;
                $rsAnexo->curso()->attach($rsCurso);

            });

            return redirect()->route('mscurso.cursos.edit', $request->input('txtidcurso'))->with('message', 'Cadastro realizado com sucesso!');

        }catch (Exception $exception){

            if(Storage::disk('anexo')->exists("$novoNome"))
            {
                Storage::disk('anexo')->delete("$novoNome");
            }

            return redirect()->back()->with('warning', 'Entre em contato com o administrador do Sistema.' . $exception->getCode());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $rsAnexos = $this->anexosModel->find( $id);

        return view('anexo.edit', compact('rsAnexos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{

            $novoNome = null;

            if ($request->hasFile('txtanexo') && $request->file('txtanexo')->isValid()) {

                $noArquivo = uniqid(date('HisYmd'));

                $extensaoArquivo = $request->txtanexo->extension();

                $novoNome = "{$noArquivo}.{$extensaoArquivo}";

                $upload = $request->txtanexo->storeAs('anexo', $novoNome);

                if( !$upload ){
                    throw new \Exception('Erro ao Gravar Arquivo. Entre em contato com o Desenvolvedor');
                }

            }

            DB::transaction(function () use ($request, $novoNome, $id) {

                $rsAnexo = $this->anexosModel->find($id);

                if(File::exists(storage_path("app/anexo/$rsAnexo->caminho")))
                {
                    Storage::disk('anexo')->delete("$rsAnexo->caminho");
                }

                $rsAnexo->update(
                    [
                        'titulo'  => $request->input('txtnomeanexo'),
                        'caminho' => $novoNome
                    ]
                );

            });

            return redirect()->back()->with('message', 'Cadastro atualizado com sucesso!');

        }catch (Exception $exception){

            if(File::exists(storage_path("app/anexo/$novoNome")))
            {
                Storage::disk('anexo')->delete("$novoNome");
            }

            return redirect()->back()->with('warning', 'Entre em contato com o administrador do Sistema.' . $exception->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download($caminho)
    {
        //

        if(File::exists(storage_path("app/anexo/$caminho")))
        {
            $pathToFile = storage_path("app/anexo/$caminho");
            return response()->download($pathToFile);
        }else{
            return redirect()->back()->with('warning', 'Arquivo não encontrado. Entre em contato com o desenvolvedor do Sistema.');
        }

    }

    public function delete(DeleteRequest $request)
    {
        //
        try{

            DB::transaction(function () use ($request) {

                $rsAnexo = $this->anexosModel->find($request->input('anexoid'));

                $rsAnexo->delete();

                if(File::exists(storage_path("app/public/anexo/".$rsAnexo->caminho.".pdf")))
                {
                    Storage::disk('anexo')->delete($rsAnexo->caminho.".pdf");
                }

            });

            return redirect()->back()->with('message', 'Arquivo deletado com sucesso!');

        }catch (Exception $exception){

            return redirect()->back()->with('warning', 'Entre em contato com o administrador do Sistema.' . $exception->getCode());
        }

    }
}
