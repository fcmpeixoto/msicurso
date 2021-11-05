<?php

namespace App\Http\Controllers\Carrinho;

use App\Http\Controllers\Controller;
use App\Models\Carrinho;
use App\Models\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function MongoDB\BSON\toJSON;

class CarrinhoController extends Controller
{

    public function adiciona($id)
    {
        //
        $rsPoduto = Cursos::find($id);

        if( !$rsPoduto )
            return redirect()->back();

        $cart = new Carrinho;

        $cart->adicionar($rsPoduto);

        Session::put('_cart', $cart);

       //return redirect()->route('mscurso.carrinho.curso');
        return view('carrinho.cart');
    }


    public function carrinho()
    {
        //
        $cart = new Carrinho;
        $rsCarrinho = $cart->getItems();

        return view('carrinho.cart', compact('rsCarrinho', 'cart'));
    }
}
