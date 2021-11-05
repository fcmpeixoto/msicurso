@section('title', 'Novo Cadastro de Curso')

@section('pluginsCss')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/notification/toastr/toastr.css') }}">
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
    <script src="{{ asset('plugins/notification/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>

    <script src="{{ asset('plugins/custom/custom-javascript.js') }}"></script>
    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
@endsection

@section('pluginsScriptsManual')
    @parent
@endsection
<!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
<x-app-layout>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Meu Carrinho</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('mscurso.comprar.mcurso') }}">Cursos</a></div>
                    <div class="breadcrumb-item">Meu carrinho</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <h4>Carrinho</h4>
                            </div>

                            <div class="card-body">
                                @livewire('carrinho.cart')
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </div>
</x-app-layout>
