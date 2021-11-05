<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Carrinho extends Model
{
    use HasFactory;

    protected $items = [];

    /**
     * Carrinho constructor.
     * @param array $items
     */
    public function __construct()
    {
        if( Session::has('_cart') )
        {

            $cart = Session::get('_cart');

            $this->items = $cart->items;
        }
    }

    public function adicionar(Cursos $product)
    {
        $this->items[$product->id] = [
            'itemDescription' => $product,
            'itemQuantity' => 1,
        ];

    }

    public function remove(Cursos $product)
    {
        if (isset($this->items[$product->id]) && $this->items[$product->id]['itemQuantity'] > 1) {
            $this->items[$product->id] = [
                'itemDescription' => $product,
                'itemQuantity'    => $this->items[$product->id]['itemQuantity'] - 1,
            ];
        } elseif (isset($this->items[$product->id])){
            unset($this->items[$product->id]);
        }
    }

    public function getItems()
    {
        return $this->items;
    }

    public function total()
    {
        $total = 0;

        foreach($this->items as $item)
        {
            $subTotal = getConverteParaTotal($item['itemDescription']->valor) * $item['itemQuantity'];

            $total += $subTotal;
        }

        return number_format($total, 2, '.', '');
    }

    public function totalItems()
    {
        return count($this->items);
    }


    public function emptyCart()
    {
        if( Session::has('_cart') )
        {
            Session::forget('_cart');
        }

    }

}
