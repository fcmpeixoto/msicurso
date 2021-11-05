@section('title', 'Login')

@section('pluginsCss')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
@endsection

@section('pluginsCssManual')
    @parent
@endsection

@section('pluginsScripts')
    @parent
    <script src="{{ asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

    <script src="{{ asset('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('assets/modules/cleave-js/dist/addons/cleave-phone.us.js') }}"></script>

    <script src="{{ asset('js/forms-login-forms.js') }}"></script>
@endsection

@section('pluginsScriptsManual')
    @parent
@endsection
<x-guest-layout>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{ asset('/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header"><h4>Login</h4></div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                                    @csrf

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" value="{{ old('email') }}" required autofocus>
                                        <div class="invalid-feedback">
                                            Por favor digite seu email
                                            @error('email') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <a href="{{ route('password.request') }}" class="text-small">
                                                    Esqueceu sua senha?
                                                </a>
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            Por favor digite sua senha
                                            @error('password') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input id="remember_me" name="remember" type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Manter Conectado</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Entrar
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Não tem uma conta? <a href="{{ route('register') }}">Crie uma.</a>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Stisla 2018
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
