@section('title', 'Finalizando Pedidoo')

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

    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>

    <script src="{{ config('pagseguro.url_transparent_js') }}"></script>
@endsection

@section('pluginsScriptsManual')
    @parent

    <script>
        function cartaoDeCredito() {
            return{
                brandName: '',
                cardNumbers: '',
                cardFormInputName: '',

                getBrand(e) {

                    let cardNumber = e.target.value;

                    if( cardNumber.length > 6){

                        PagSeguroDirectPayment.getBrand({
                            cardBin: cardNumber,
                            success: (response) => {
                                //bandeira encontrada
                                this.brandName = response.brand.name;
                                this.getInstallments();
                            },
                            error: (response) => {
                                //tratamento do erro
                                console.log(response);
                            },
                            complete: (response) => {
                                //tratamento comum para todas chamadas
                            }
                        });
                    }

                },
                cardToken(e) {

                    let formEl         = document.querySelector('form[name=crediCard]');
                    let formData       = new FormData(formEl);
                    this.cardNumbers   = formData.get('cardNumber');
                    this.cardFormInputName = formData.get('nome');

                    if(this.brandName === "")
                    {
                        this.getBrandEmpety()
                    }

                    PagSeguroDirectPayment.createCardToken({
                        cardNumber: this.cardNumbers,
                        brand: this.brandName,
                        cvv: formData.get('cvv'),
                        expirationMonth: formData.get('expirationMonth'),
                        expirationYear: formData.get('expirationYear'),
                        success: (response) => {
                            // Retorna o cartão tokenizado.
                            let payload ={
                                'cardNomeUser': this.cardFormInputName,
                                'token': response.card.token,
                                'senderHash': PagSeguroDirectPayment.getSenderHash(),
                            };
                            this.getInstallments();
                            Livewire.emit('pagamentoArray', payload);
                        },
                        error: (response) => {
                            // Callback para chamadas que falharam.
                            console.log(this.brandName);
                        },
                        complete: (response) => {
                            // Callback para todas chamadas.
                        }
                    });
                },
                getInstallments(e) {
                    PagSeguroDirectPayment.getInstallments({
                        amount: '{{ Session::get('_cart')->total() }}',
                        maxInstallmentNoInterest: 12,
                        brand: this.brandName,
                        success: (response) => {
                            // Retorna as opções de parcelamento disponíveis
                            let installmentss ={
                                'installments': response.installments[this.brandName]
                            };
                            //console.log(response.installments[this.brandName]);
                            Livewire.emit('getInstallment', installmentss);
                        },
                        error: (response) => {
                            // callback para chamadas que falharam.
                            console.log(response);
                        },
                        complete:(response) => {
                            // Callback para todas chamadas.
                        }
                    });
                },
                getBrandEmpety(e) {

                    PagSeguroDirectPayment.getBrand({
                        cardBin: this.cardNumbers,
                        success: (response) => {
                            //bandeira encontrada
                            this.brandName = response.brand.name
                        },
                        error: (response) => {
                            //tratamento do erro
                            console.log(response);
                        },
                        complete: (response) => {
                            //tratamento comum para todas chamadas
                        }

                    });
                },
            }
        }

        $(document).ready(function(){
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-top-right",
            };
        });

        window.addEventListener('alert',event => {
            toastr[event.detail.type](event.detail.message, event.detail.titulo) ;
        });

    </script>
@endsection
<!-- I begin to speak only when I am certain what I will say is not better left unsaid - Cato the Younger -->
<x-app-layout>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pagamento</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('mscurso.carrinho.curso') }}">Carinho</a></div>
                    <div class="breadcrumb-item">Pagamento</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <h4>Formas de Pagamento</h4>
                            </div>
                            <x-alertas />
                            <div class="card-body">

                                @livewire('pagamento.pagamento')
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </div>
</x-app-layout>
