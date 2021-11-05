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
                            <a href="{{ route('mscurso.anexos.edit',$dadosAnexos->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                            <a href="{{ route('mscurso.donwload.anexo',$dadosAnexos->caminho) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Abrir" class="btn btn-icon btn-success"><i class="fas fa-file-download"></i></a>
                            <a id="btndeletaranexo"
                               style="cursor: pointer !important;"
                               data-tt="tooltip"
                               data-placement="top"
                               data-original-title="Deletar"
                               data-toggle="modal"
                               data-anexoid="{{ $dadosAnexos->id }}"
                               data-target="#modal-deleta-anexo" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></a>
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
