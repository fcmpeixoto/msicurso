<div>
    <x-input-busca />
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Descrição</th>
            <th scope="col" class="text-right">Valor</th>
            <th scope="col" class="text-right">Dat/Início</th>
            <th scope="col" class="text-right">Data/Fim</th>
            <th scope="col" class="text-right" width="10%">Ação</th>
        </tr>
        </thead>
        <tbody>
        @forelse($rsCursos as $dadosCursos)
            <tr>
                <td wire:click="ordenarPor('descricao')">
                    <h5 class="m-3">{{ $dadosCursos->nome }}</h5>
                    {!! $dadosCursos->descricao !!}
                </td>
                <td>{{ $dadosCursos->valor }}</td>
                <td wire:click="ordenarPor('data_inicio')">{{ $dadosCursos->data_inicio }}</td>
                <td wire:click="ordenarPor('data_fim')">{{ $dadosCursos->data_fim }}</td>
                <td class="text-right" width="10%">
                    <div class="buttons">
                        <a href="{{ route('mscurso.cursos.edit',$dadosCursos->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                        <a wire:click.prevent='abrirModalDelete("{{ (string) $dadosCursos->id }}")' data-toggle="tooltip" data-placement="top" title="" data-original-title="Deletar" class="btn btn-icon btn-danger text-white"><i class="fas fa-trash"></i></a>
                    </div>
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
                {{ $rsCursos->links() }}
            </td>
        </tr>
        </tfoot>
        </tbody>
    </table>
    <x-modal-delete />
</div>

