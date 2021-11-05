<?php

namespace App\Http\Livewire\Pagamento;

use App\Models\Carrinho;
use App\Models\PagSeguro;
use App\Models\Pedido;
use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Pagamento extends Component
{
    public $rsItens;
    public $totalItens;
    public $idDaSessao;
    public $text;
    public $qtdParcelas = false;
    public $hidradaPrcelas;
    public $maxInstallmentNoInterests;
    public $boleto    = false;
    public $tabactivec = true;
    public $tabactived = false;
    public $linkBoleto = null;

    protected $listeners = [
        'pagamentoArray' => 'processarPagamento', 'getInstallment' => 'maxInstallmentNoInterests'
    ];

    public function mount(PagSeguro $pagseguro)
    {
        $this->idDaSessao = $pagseguro->getSessionId();
    }

    public function processarPagamento($data,PagSeguro $pagseguro, Pedido $pedido)
    {

        try{

            if(is_null($this->maxInstallmentNoInterests)) {
                throw new Exception('Campo parcela precisa ser selecionado!');
            }

            $data['installments'] = $this->maxInstallmentNoInterests;
            $retorno = $pagseguro->paymentCredCard($data);

            if(!$retorno['success']) {
                throw new Exception('Erro ao Enviar Pagamento!'.$retorno['code']);
            }

            $cart = new Carrinho;

            // Registra a compra do usuário
            $pedido->newOrderProducts($cart, $retorno['reference'], $retorno['code'], $retorno['status'], 1, explode('/', $data['installments'])[0]);

            // Limpa o carrinho de compras
            $cart->emptyCart();

            $this->dispatchBrowserEvent('alert',['type' => 'success', 'message' => 'Compra Realizada Com sucesso!', 'titulo' => 'Sucesso!']);
            sleep(5);

            $this->tabactivec = true;
            $this->tabactived = false;

            return redirect()->to('/mscurso/meus-pedidos');

        }catch (Exception $e){

            $this->tabactivec = true;
            $this->tabactived = false;
            $this->dispatchBrowserEvent('alert',['type' => 'error', 'message' => 'Erro ao enviar pagamento!'.$e->getMessage(), 'titulo' => 'Error!']);
        }


    }

    public function processarPagamentoBoleto($sendHash,PagSeguro $pagseguro, Pedido $pedido)
    {

        try{

            $retorno = $pagseguro->paymentBillet($sendHash);

            if(!$retorno['success']) {
                throw new Exception('Erro ao Enviar Pagamento!'.$retorno['code']);
            }

            $cart = new Carrinho;

            // Registra a compra do usuário
            $pedido->newOrderProducts($cart, $retorno['reference'], $retorno['code'],1 , 2, 1);

            // Limpa o carrinho de compras
            $cart->emptyCart();

            $this->dispatchBrowserEvent('alert',['type' => 'success', 'message' => 'Compra Realizada Com sucesso!', 'titulo' => 'Sucesso!']);

            $this->tabactivec = false;
            $this->tabactived = true;
            $this->linkBoleto = $retorno['payment_link'];

        }catch (Exception $e){
            $this->tabactivec = false;
            $this->tabactived = true;
            $this->dispatchBrowserEvent('alert',['type' => 'error', 'message' => 'Erro ao enviar pagamento!'.$e->getMessage(), 'titulo' => 'Error!']);
        }


    }

    public function maxInstallmentNoInterests($data)
    {

        if(count($data) > 0){
            $this->qtdParcelas = true;
            $this->hidradaPrcelas = $data['installments'];
        }

    }

    public function render()
    {
        $cart = new Carrinho;

        $this->rsItens    = $cart->getItems();
        $this->totalItens = $cart->total();
        return view('livewire.pagamento.pagamento');
    }
}
