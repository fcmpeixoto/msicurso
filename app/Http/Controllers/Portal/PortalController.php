<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Cursos;
use App\Services\ConsultaCep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PortalController extends Controller
{
    //
    /**
     * @var Cursos
     */
    private $cursosModel;

    /**
     * PortalController constructor.
     */
    public function __construct(Cursos $cursosModel)
    {
        $this->cursosModel = $cursosModel;
    }

    public function index()
    {

        $rsCurso = $this->cursosModel->all();

        return view('welcome', compact('rsCurso'));
    }

    public function consultaCep(Request $request)
    {
        return ConsultaCep::verificaCep($request->input('viacep'));
    }
}
