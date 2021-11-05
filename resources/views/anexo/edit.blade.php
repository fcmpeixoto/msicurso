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
@endsection
<!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
<x-app-layout>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Relação de Anexos</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('mscurso.dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('mscurso.cursos.index') }}">Relação de Cursos</a></div>
                    <div class="breadcrumb-item {{ request()->routeIs('mscurso.anexos.*')  ? 'active' : ''  }}">Editando Anexo</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">
                        <x-alertas />
                        <div class="card">
                            <div class="card-header">
                                <h4>Anexos</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('mscurso.anexos.update', $rsAnexos->id) }}" method="POSt" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @include('livewire.anexo._partial.form')
                                    <div class="buttons">
                                        <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="far fa-save"></i> Gravar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </div>
</x-app-layout>
