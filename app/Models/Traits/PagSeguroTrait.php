<?php

namespace App\Models\Traits;

trait PagSeguroTrait
{
    public function getConfigs()
    {
        return [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token'),
        ];
    }
    
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
    
    public function getItems()
    {
        $items = [];
        $itemsCart = $this->cart->getItems();

        $posistion = 1;
        foreach ($itemsCart as $item) {
            $items["itemId{$posistion}"]            = $item['itemDescription']->id;
            $items["itemDescription{$posistion}"]   = $item['itemDescription']->id;
            $items["itemAmount{$posistion}"]        = number_format(limpaString($item['itemDescription']->valor), 2, '.', '');
            $items["itemQuantity{$posistion}"]      = $item['itemQuantity'];

            $posistion++;
        }

        return $items;

    }
    
    public function getSender()
    {
        return [
            'senderName'        => mb_strtoupper($this->user->name . " " . $this->user->last_name),
            'senderAreaCode'    => is_null($this->user->aluno->celular) ? mb_substr($this->user->aluno->celular,1,2) : mb_substr($this->user->aluno->telefone,1,2),
            'senderPhone'       => is_null($this->user->aluno->celular) ? mb_substr(limpaString($this->user->aluno->celular),2) : mb_substr(limpaString($this->user->aluno->telefone),2),
            'senderEmail'       => $this->user->email,
            'senderCPF'         => limpaString($this->user->aluno->cpf),
        ];
    }
    
    public function getShipping()
    {
        return [
            'shippingType'                  => '1',
            'shippingAddressStreet'         => $this->user->aluno->endereco->logradouro,
            'shippingAddressNumber'         => $this->user->aluno->endereco->numero,
            'shippingAddressComplement'     => $this->user->aluno->endereco->complemento,
            'shippingAddressDistrict'       => $this->user->aluno->endereco->bairro,
            'shippingAddressPostalCode'     => $this->user->aluno->endereco->cep,
            'shippingAddressCity'           => $this->user->aluno->endereco->localidade,
            'shippingAddressState'          => $this->user->aluno->endereco->uf,
            'shippingAddressCountry'        => 'BRL',
        ];
    }

    public function getCreditCard($holderName)
    {
        return [
            'creditCardHolderName'      => $holderName,
            'creditCardHolderCPF'       => limpaString($this->user->aluno->cpf),
            'creditCardHolderBirthDate' => $this->user->aluno->data_nascimento,
            'creditCardHolderAreaCode'  => is_null($this->user->aluno->celular) ? mb_substr($this->user->aluno->celular,1,2) : mb_substr($this->user->aluno->telefone,1,2),
            'creditCardHolderPhone'     => is_null($this->user->aluno->celular) ? mb_substr(limpaString($this->user->aluno->celular),2) : mb_substr(limpaString($this->user->aluno->telefone),2),
        ];
    }

    public function billingAddress()
    {
        return [
            'billingAddressStreet'      => $this->user->aluno->endereco->logradouro,
            'billingAddressNumber'      => $this->user->aluno->endereco->numero,
            'billingAddressComplement'  => $this->user->aluno->endereco->complemento,
            'billingAddressDistrict'    => $this->user->aluno->endereco->bairro,
            'billingAddressPostalCode'  => $this->user->aluno->endereco->cep,
            'billingAddressCity'        => $this->user->aluno->endereco->localidade,
            'billingAddressState'       => $this->user->aluno->endereco->uf,
            'billingAddressCountry'     => 'BRL',
        ];
    }
}
