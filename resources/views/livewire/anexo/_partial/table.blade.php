<div class="row">
    <div class="col-12 col-md-12 col-lg-12">

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Descrição</th>
                <th scope="col" class="text-right">Publicado em:</th>
                <th scope="col" class="text-right" width="20%">Ação</th>
            </tr>
            </thead>
            <tbody>

            @forelse($rsCursos->anexos as $dadosAnexos)
                <tr>
                    <th>{{ $dadosAnexos->titulo }}</th>
                    <th class="text-right">{{ $dadosAnexos->created_at }}</th>
                    <td class="text-right" width="10%">
                        <div class="buttons">
                            <a href="{{ route('mscurso.anexos.edit',$dadosAnexos->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" class="btn btn-icon btn-primary text-white"><i class="far fa-edit"></i></a>
                            <a wire:click.prevent="download({{$dadosAnexos->id}},{{$dadosAnexos->caminho}})" data-toggle="tooltip" data-placement="top" title="" data-original-title="Abrir" class="btn btn-icon btn-success text-white"><i class="fas fa-file-download"></i></a>
                            <a wire:click.prevent='abrirModalDeleteAnexo("{{ (string) $dadosAnexos->id }}")' data-toggle="tooltip" data-placement="top" title="" data-original-title="Deletar" class="btn btn-icon btn-danger text-white"><i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <th scope="row" colspan="6">Não há Registro para Exibição</th>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>

</div>
