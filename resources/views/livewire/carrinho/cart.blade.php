<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col"class="text-center">Ação</th>
                    <th scope="col">Descrição do Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col" class="text-right">Valor</th>
                </tr>
                </thead>
                <tbody>

                @forelse($rsItens as $dadosCarrinho)
                    <tr>
                        <td class="text-center">
                            <a wire:click.prevent="deletarCurso('{{ (string) $dadosCarrinho['itemDescription']->id }}')" style="cursor: pointer"><i class="fas fa-trash text-danger"></i></a>
                        </td>
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
                        <td colspan="3" class="text-right">Total</td>
                        <td class="text-right">{{ $totalItens }}</td>
                    </tr>
                </tfoot>
            </table>

        </div>
        <div class="card-footer">
            <div class="buttons">
                <a href="{{ route('mscurso.pagamento.index') }}" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i> Finalizar Compra</a>
            </div>
        </div>
    </div>

</div>
