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



    <script src="{{ config('pagseguro.url_transparent_js') }}"></script>
@endsection

@section('pluginsScriptsManual')
    @parent
    <script>
        $(function(){
            $('.btn-finished').click(function(){
                setSessionId();

                return false;
            });
        });

        function setSessionId()
        {
            var data = $('#form').serialize();

            $.ajax({
                url: "{{route('mscurso.pagseguro.code.transparente')}}",
                method: "POST",
                data: data
            }).done(function(data){
                PagSeguroDirectPayment.setSessionId(data);

                //getPaymentMethods();

                paymentBillet();
            }).fail(function(){
                alert("Fail request... :-(");
            });
        }

        function getPaymentMethods()
        {
            PagSeguroDirectPayment.getPaymentMethods({
                success: function(response){
                    //console.log(response);

                    if( response.error === false ) {
                        $.each(response.paymentMethods, function(key, value){
                            $('.payments-methods').append(key+"<br>");
                        });
                    }
                },
                error: function(response){
                    console.log(response);
                },
                complete: function(response){
                    //console.log(response);
                }
            });
        }

        function paymentBillet()
        {
            var sendHash = PagSeguroDirectPayment.getSenderHash();

            var data = $('#form').serialize()+"&sendHash="+sendHash;

            $.ajax({
                url: "{{route('mscurso.pagseguro.billet')}}",
                method: "POST",
                data: data
            }).done(function(url){
                //console.log(data);

                location.href=url;
            }).fail(function(){
                alert("Fail request... :-(");
            });
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

                                <form action="" id="form" method="post">
                                    @csrf
                                </form>
                                <a href="" class="btn-finished">Pagar com Boleto Bancário!</a>

                                <div class="payments-methods"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
