<div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Referência</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-right">Valor</th>
            <th scope="col" class="text-right">Forma de Pagamento</th>
            <th scope="col" class="text-right">Parcelamento</th>
            <th scope="col" class="text-right">Data da Compra</th>
        </tr>
        </thead>
        <tbody>
        @forelse($rsPedidos as $rdadosPedidos)
            <tr>
                <td>{{ $rdadosPedidos->referencia }}</td>
                <td class="text-centro">{{ $rdadosPedidos->status }}</td>
                <td class="text-right">{{ $rdadosPedidos->valor }}</td>
                <td class="text-right">{{ $rdadosPedidos->formapagamento }}</td>
                <td class="text-right">{{ $rdadosPedidos->parcelas }}</td>
                <td class="text-right">{{ $rdadosPedidos->created_at }}</td>
            </tr>
            <tr>
                <td colspan="6">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" colspan="6">Itens do Pedido</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td scope="col">Descricação</td>
                            <td scope="col" class="text-right">Quantidade</td>
                            <td scope="col" class="text-right">Valor</td>
                        </tr>
                        @foreach($rdadosPedidos->itemnspedido as $dadosItemnspedido)
                            <tr>
                                <td class="text-centro">{{ $dadosItemnspedido->descricao_produto }}</td>
                                <td class="text-right">{{ $dadosItemnspedido->quantidade }}</td>
                                <td class="text-right">{{ $dadosItemnspedido->valor }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </td>
            </tr>
        @empty
            <tr>
                <th scope="row" colspan="6">Não há Registro para Exibição</th>
            </tr>
        @endforelse
        <tfoot>
        <tr>
            <td colspan="4">
                {{ $rsPedidos->links() }}
            </td>
        </tr>
        </tfoot>
        </tbody>
    </table>
</div>
