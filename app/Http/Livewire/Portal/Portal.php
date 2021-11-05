<?php

namespace App\Http\Livewire\Portal;

use App\Models\Carrinho;
use App\Models\Cursos;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Portal extends Component
{

    public $rsCurso;
    public $rsTotal = 0;

    public function render()
    {
        $this->rsTotal = Session::has('_cart') ? Session::get('_cart')->totalItems() : 0;
        return view('livewire.portal.portal');
    }

    public function adiconarCarrinho($id)
    {

        $rsPoduto = Cursos::find($id);

        if( !$rsPoduto )
            return redirect()->back();

        $cart = new Carrinho;

        $cart->adicionar($rsPoduto);

        Session::put('_cart', $cart);

    }

    public function carrinho()
    {
        //
        $cart = new Carrinho;
        $cart->getItems();
    }
}
