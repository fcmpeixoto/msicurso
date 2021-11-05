<div class="section-body">
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">

            <div class="card">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Novo Curso Adicionado</th>
                        <th scope="col" class="text-center">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $rsCursos->nome }}</td>
                        <td class="text-right">
                            <div class="buttons">
                                <a wire:click='edit("{{ $rsCursos->id }}")' data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                <a wire:click.prevent='abrirModalDelete("{{ (string) $rsCursos->id }}")'
                                   style="cursor: pointer !important;"
                                   data-placement="top"
                                   data-original-title="Deletar"
                                   data-tt="tooltip"
                                   class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <div class="card-header">
                    <h4>Material de Apoio do Curso</h4>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="uploadMaterial">
                        @include('livewire.anexo._partial.form')
                        <div class="buttons">
                            <x-button-salvar-sumit legenda="Gravar" />
                        </div>
                    </form>

                    @include('livewire.anexo._partial.table')
                </div>

            </div>

        </div>

    </div>
</div>

