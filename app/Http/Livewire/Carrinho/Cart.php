<?php

namespace App\Http\Livewire\Carrinho;

use App\Models\Carrinho;
use App\Models\Cursos;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Cart extends Component
{

    public $rsPoduto;
    public $rsItens;
    public $totalItens;
    public $rsCarrinho;
    public $cart;


    public function render()
    {

        $cart = new Carrinho;

        $this->rsItens    = $cart->getItems();
        $this->totalItens = $cart->total();

        return view('livewire.carrinho.cart');
    }

    public function deletarCurso($id)
    {

        $product = Cursos::find($id);
        if( !$product )
            return redirect()->back();

        $cart = new Carrinho;
        $cart->remove($product);

        Session::put('_cart', $cart);
    }
}
