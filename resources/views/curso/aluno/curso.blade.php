@section('title', 'Editar Cadastro de Curso')

@section('pluginsCss')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('pluginsCssManual')
    @parent
@endsection

@section('pluginsScripts')
    @parent
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/modules/summernote/lang/summernote-pt-BR.js') }}"></script>
    <script src="{{ asset('assets/modules/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('assets/modules/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

    <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endsection

@section('pluginsScriptsManual')
    @parent
    <script>
        $(document).on("click", "#btndeletaranexo", function () {
            var id = $(this).attr('data-anexoid');
            $(".modal-body #anexoid").val(id);
        });
    </script>
@endsection
<!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
<x-app-layout>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $rsCursos->nome }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('mscurso.aluno.index') }}">Relação de Cursos</a></div>
                    <div class="breadcrumb-item {{ request()->routeIs('mscurso.cursos.edit.*')  ? 'active' : ''  }}">{{ $rsCursos->nome }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">
                        <x-alertas />
                        <div class="card">
                            <div class="card-header">
                                <h4>Material de Apoio do Curso</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">Descrição</th>
                                        <th scope="col" class="text-right">Publicado em:</th>
                                        <th scope="col" class="text-right">Material</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($rsCursos->anexos as $dadosAnexos)
                                        <tr>
                                            <th>{{ $dadosAnexos->titulo }}</th>
                                            <th class="text-right">{{ $dadosAnexos->created_at }}</th>
                                            <td class="text-right" width="10%">
                                                <div class="buttons">
                                                    <a href="{{ route('mscurso.donwload.anexo',$dadosAnexos->caminho) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Abrir" class="btn btn-icon btn-success"><i class="fas fa-file-download"></i></a>
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

                    </div>

                </div>
            </div>

        </section>

    </div>

</x-app-layout>
