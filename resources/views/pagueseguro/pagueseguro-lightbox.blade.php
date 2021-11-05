@section('title', 'Novo Cadastro de Paciente')

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



    <script src="{{ config('pagseguro.url_lightbox') }}"></script>
@endsection

@section('pluginsScriptsManual')
    @parent
    <script>
        $(document).on('ready', function () {
            $("#file-0").fileinput();
        });

        $(function () {
            $(".btn-buy").click(function () {
                let _token = $('input[name=_token]').val();
                //alert(_token);
                $.ajax({
                    url:"{{ route('mscurso.pagueseguro.lightbox.code') }}",
                    method: "POST",
                    data:{_token},
                    beforeSend: startPreloader()
                }).done(function(code){
                    lightbox(code);
                }).fail(function(){
                    alert("Erro inesperado, tente novamente!");
                }).always(function(){
                    stopPreloader();
                });

                return false;
            });
        });

        function lightbox(code) {

            let isOpenLightBox = PagSeguroLightbox({
                code: code
            },{
                success: function (transactionCode) {
                    $('.msg-return').html("Pedido realizado com sucesso: "+transactionCode);
                },
                abort: function() {
                    alert('Compra Cancelada')
                }
              }
            );

            if(!isOpenLightBox)
            {
                location.href="{{ config('pagseguro.url_redirect_after_request') }}"+code;
            }
        }

        function startPreloader()
        {
            $('.preloader').show();
        }

        function stopPreloader()
        {
            $('.preloader').hide();
        }
    </script>
@endsection
<!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
<x-app-layout>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pague Seguro</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('mscurso.dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item {{ request()->routeIs('mscurso.cursos.index')  ? 'active' : ''  }}">Relação de Cursos</div>
                </div>
            </div>

            <div class="section-body">
                <x-alertas />

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="buttons">
                            <a href="{{ route('mscurso.cursos.create') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-file"></i> Novo Cadastro</a>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Cursos</h4>
                            </div>
                            <div class="card-body">
                                @csrf
                                <a href="#" class="btn-buy btn btn-icon icon-left btn-primary"><i class="far fa-file"></i> Comprar</a>
                                <div class="msg-return"></div>

                                <div class="preloader" style="display: none;">Carregando...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
