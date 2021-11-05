@section('title', 'Novo Cadastro de Usuário')

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
        $(document).on('ready', function () {
            $("#file-0").fileinput();
        });
    </script>
@endsection
<!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
<x-app-layout>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Relação de Cursos</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('mscurso.dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item {{ request()->routeIs('mscurso.usuario.index')  ? 'active' : ''  }}">Relação de Usuários</div>
                </div>
            </div>

            <div class="section-body">
                <x-alertas />

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="buttons">
                            <a href="{{ route('mscurso.usuario.create') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-file"></i> Novo Usuário</a>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Usuário</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Sobrenome</th>
                                        <th scope="col" class="text-right" width="10%">Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($rsUsuario as $dadosUsuario)
                                    <tr>
                                        <th>{{ $dadosUsuario->name }}</th>
                                        <td>{{ $dadosUsuario->last_name }}</td>
                                        <td class="text-right" width="10%">
                                            <div class="buttons">
                                                <a href="{{ route('mscurso.usuario.edit',$dadosUsuario->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                                <a href="{{ route('mscurso.usuario.destroy',$dadosUsuario->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deletar" class="btn btn-icon btn-danger"><i class="fas fa-trash"></i></a>
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
