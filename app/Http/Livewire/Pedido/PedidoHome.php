<?php

namespace App\Http\Livewire\Pedido;

use App\Models\ItemPedido;
use App\Models\Pedido;
use Livewire\Component;
use Livewire\WithPagination;

class PedidoHome extends Component
{

    //public $rsMorador;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $rsPedidos = Pedido::paginate(15);
        return view('livewire.pedido.pedido-home', compact('rsPedidos'));
    }

}
