<?php

namespace App\Http\Controllers\Pedido;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    //
    public function index()
    {
        return view('pedido.index');
    }
}
