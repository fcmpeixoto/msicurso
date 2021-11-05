<?php

namespace App\Http\Controllers\Pagamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    //

    public function index()
    {
        return view('pagamento.pagamento');
    }
}
