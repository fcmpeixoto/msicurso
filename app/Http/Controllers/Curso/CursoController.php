<?php

namespace App\Http\Controllers\Curso;

use App\Http\Controllers\Controller;
use App\Http\Requests\Anexo\DeleteRequest;
use App\Http\Requests\Curso\CreateRequest;
use App\Models\Aluno;
use App\Models\Cursos;
use App\Models\PagSeguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class CursoController extends Controller
{
    /**
     * @var Cursos
     */
    private $cursosModel;
    private $idNovoCurso;

    /**
     * CursoController constructor.
     */
    public function __construct(Cursos $cursosModel)
    {
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
        return view('curso.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('curso.create');
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

            DB::transaction(function () use ($request) {
                $data = $this->cursosModel->create(
                    [
                        'nome'          => $request->input('txtnomecurso'),
                        'descricao'     => $request->input('txtdescricaocurso'),
                        'valor'         => $request->input('txtvalorcurso'),
                        'data_inicio'   => $request->input('txtdatainicio'),
                        'data_fim'      => $request->input('txtdatafim'),
                        'qtd_inscritos' => $request->input('txtquantidadecurso'),
                    ]
                );
                $this->idNovoCurso = $data->id;
            });

            return redirect()->route('mscurso.cursos.edit', $this->idNovoCurso)->with('message', 'Cadastro realizado com sucesso!');


        }catch (Exception $exception){

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
        $rsCursos = $this->cursosModel->with('anexos')->find( $id);

        return view('curso.edit', compact('rsCursos'));
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

            DB::transaction(function () use ($request,$id) {

                $data = $this->cursosModel->find($id);
                $data->update(
                    [
                        'nome'          => $request->input('txtnomecurso'),
                        'descricao'     => $request->input('txtdescricaocurso'),
                        'valor'         => $request->input('txtvalorcurso'),
                        'data_inicio'   => $request->input('txtdatainicio'),
                        'data_fim'      => $request->input('txtdatafim'),
                        'qtd_inscritos' => $request->input('txtquantidadecurso'),
                    ]
                );
                $this->idNovoCurso = $data->id;
            });

            return redirect()->route('mscurso.cursos.edit', $this->idNovoCurso)->with('message', 'Cadastro atualizado com sucesso!');


        }catch (Exception $exception){

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

    public function listarInscritos()
    {
        //
        return view('curso.listar-inscritos');
    }
}
