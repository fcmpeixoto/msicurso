<div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-2">
            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $tabactivec == true ? 'active' : '' }}" id="home-tab4" data-toggle="tab" href="#credito" role="tab" aria-controls="credito" aria-selected="true">Cartão de Crédito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tabactived == true ? 'active' : '' }}" id="contact-tab4" data-toggle="tab" href="#boleto" role="tab" aria-controls="boleto" aria-selected="false">Boleto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" id="profile-tab4" data-toggle="tab" href="#debito" role="tab" aria-controls="debito" aria-selected="false">Cartão de Crédito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" id="contact-tab4" data-toggle="tab" href="#pix" role="tab" aria-controls="pix" aria-selected="false">PIX</a>
                </li>
            </ul>
        </div>
        <div class="col-12 col-sm-12 col-md-10">
            <div class="tab-content no-padding" id="myTab2Content">
                <div class="tab-pane fade {{ $tabactivec == true ? 'show active' : '' }}" id="credito" role="tabpanel" aria-labelledby="credito">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6" x-data="cartaoDeCredito()" x-init="PagSeguroDirectPayment.setSessionId('{{ $idDaSessao }}')">
                            <div class="card">
                            <div class="card-header">
                                <h4>Cartão de Crédito</h4>
                            </div>
                                <form name="crediCard">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputAddress">Número do Cartão</label>
                                            <input type="text" class="form-control" name="cardNumber" @keyup="getBrand" value="4111111111111111">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAddress">Nome Cartão</label>
                                            <input type="text" name="nome" class="form-control" value="FABRICIO MORAES">
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Mês Vencimento</label>
                                                <input type="text" name="expirationMonth" class="form-control" value="12">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4">Ano Vencimento</label>
                                                <input type="text" name="expirationYear" class="form-control" value="2026">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputZip">Código de Segurança</label>
                                                <input type="text" name="cvv" class="form-control" value="013">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputState">Parcelas</label>
                                                <select id="inputState" name="maxInstallmentNoInterests" class="form-control" wire:model="maxInstallmentNoInterests">
                                                    @if($qtdParcelas)
                                                        @foreach($hidradaPrcelas as $dadoshidradaPrcelas)
                                                            <option value="{{$dadoshidradaPrcelas['quantity'] }}/{{ $dadoshidradaPrcelas['installmentAmount'] }}">Parcelas {{ $dadoshidradaPrcelas['quantity'] }} X R$ {{ getValorView($dadoshidradaPrcelas['installmentAmount']) }} = R$ {{ getValorView($dadoshidradaPrcelas['totalAmount']) }}</option>
                                                        @endforeach
                                                    @else
                                                        <option disabled selected>Parcelas...</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="card-footer">
                                        <button @click.prevent="cardToken" class="btn btn-primary"wire:loading.attr="disabled">
                                            <i class="fas fa-sync fa-spin" wire:loading></i>&nbsp;&nbsp;Realizar Pagamento
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Descrição do Produto</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col" class="text-right">Valor</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($rsItens as $dadosCarrinho)
                                    <tr>
                                        <td>{{ $dadosCarrinho['itemDescription']->nome }}</td>
                                        <td>{{ $dadosCarrinho['itemQuantity'] }}</td>
                                        <td class="text-right">{{ $dadosCarrinho['itemDescription']->valor }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td scope="row" colspan="6">Não há Produtos no seu Carrinho</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2" class="text-right">Total</td>
                                    <td class="text-right">{{ getValorView($totalItens) }}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade {{ $tabactived == true ? 'show active' : '' }}" id="boleto" role="tabpanel" aria-labelledby="boleto">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6" x-data="cartaoDeCredito()" x-init="PagSeguroDirectPayment.setSessionId('{{ $idDaSessao }}')">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Pagamento por Boleto</h4>
                                </div>
                                <div class="card-body">

                                </div>
                                <div class="card-footer">

                                    @if(!is_null($linkBoleto))
                                        <a href="{!! $linkBoleto !!}">
                                            <i class="fas fa-file"></i>&nbsp;&nbsp;Gera Boleto
                                        </a>
                                    @else
                                        <button wire:click.prevent="processarPagamentoBoleto(PagSeguroDirectPayment.getSenderHash())" class="btn btn-primary"wire:loading.attr="disabled">
                                            <i class="fas fa-sync fa-spin" wire:loading></i>&nbsp;&nbsp;Realizar Pagamento
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Descrição do Produto</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col" class="text-right">Valor</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($rsItens as $dadosCarrinho)
                                <tr>
                                    <td>{{ $dadosCarrinho['itemDescription']->nome }}</td>
                                    <td>{{ $dadosCarrinho['itemQuantity'] }}</td>
                                    <td class="text-right">{{ $dadosCarrinho['itemDescription']->valor }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td scope="row" colspan="6">Não há Produtos no seu Carrinho</td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2" class="text-right">Total</td>
                                <td class="text-right">{{ getValorView($totalItens) }}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                </div>
                <div class="tab-pane fade disabled"  id="debito" role="tabpanel" aria-labelledby="debito"></div>
                <div class="tab-pane fade disabled" id="pix" role="tabpanel" aria-labelledby="pix"></div>
            </div>
        </div>
    </div>
</div>
