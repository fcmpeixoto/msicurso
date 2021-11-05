<div>
    <x-input-busca />
    <div class="buttons">
        <a wire:click.prevent="arquivoPdf" class="btn btn-icon icon-left btn-danger text-white"><i class="far fa-file-pdf"></i> Exportar PDF</a>
        <a wire:click.prevent="arquivoxls" class="btn btn-icon icon-left btn-success text-white"><i class="far fa-file-excel"></i> Exportar XLS</a>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Inscrito</th>
            <th scope="col">Categoria</th>
            <th scope="col" class="text-right">Data.Insc</th>
            <th scope="col" class="text-right">CPF</th>
            <th scope="col">E-mail</th>
            <th scope="col">UF</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-right">Total</th>
            <th scope="col" class="text-right" width="10%">Ação</th>
        </tr>
        </thead>
        <tbody>

        @forelse($rsInscritos as $dadosInscritos)
            <tr>
                <td wire:click="ordenarPor('nome')">{{ $dadosInscritos->user->name }} {{ $dadosInscritos->user->last_name }}</td>
                <td wire:click="ordenarPor('tipo_pessoa')">{{ $dadosInscritos->user->aluno->tipo_pessoa  }}</td>
                <td class="text-right">{{ $dadosInscritos->created_at }}</td>
                <td>{{ $dadosInscritos->user->aluno->cpf }}</td>
                <td wire:click="ordenarPor('email')">{{ $dadosInscritos->user->email }}</td>
                <td>{{ $dadosInscritos->user->aluno->endereco->uf }}</td>
                <td wire:click="ordenarPor('status')">{{ $dadosInscritos->status }}</td>
                <td class="text-right">{{ $dadosInscritos->valor }}</td>
                <td class="text-right" width="10%">
                    <div class="buttons">
                        <a wire:click.prevent='abrirModalEdit("{{ (string) $dadosInscritos->id }}")' data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" class="btn btn-icon btn-primary text-white"><i class="far fa-edit"></i></a>
                        <a wire:click.prevent='abrirModalDelete("{{ (string) $dadosInscritos->id }}")' data-toggle="tooltip" data-placement="top" title="" data-original-title="Deletar" class="btn btn-icon btn-danger text-white"><i class="fas fa-trash"></i></a>
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
                {{ $rsInscritos->links() }}
            </td>
        </tr>
        </tfoot>
        </tbody>
    </table>
    <x-modal-delete />
    <x-modal-edit-status />
</div>
