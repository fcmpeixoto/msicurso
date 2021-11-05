@section('title', 'Novo Cadastro')

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

<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="login-brand">
                    <img src="{{ asset('img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary">
                    <div class="card-header"><h4>Criar Conta</h4></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="first_name">Nome</label>
                                    <input id="first_name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                                    @error('name') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="last_name">SobreNome</label>
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                                    @error('last_name') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="cpf">C.P.F</label>
                                    <input id="cpf" type="text" class="form-control text-right cpf" name="cpf" value="{{ old('cpf') }}">
                                    @error('cpf') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="data_nascimento">Data de Nascimento</label>
                                    <input id="data_nascimento" type="text" class="form-control text-right nascimento" name="data_nascimento" value="{{ old('data_nascimento') }}">
                                    @error('data_nascimento') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @error('email') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="form-divider">
                                Seu Endereço
                            </div>
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="cep">C.E.P</label>
                                    <input id="vcep" type="text" class="form-control text-right cep" name="cep" value="{{ old('cep') }}">
                                    @error('cep') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-7">
                                    <label for="cidade">Cidade</label>
                                    <input id="cidade" type="text" class="form-control" name="cidade" value="{{ old('cidade') }}">
                                    @error('cidade') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-2">
                                    <label for="uf">UF</label>
                                    <input id="uf" type="text" class="form-control" name="uf" value="{{ old('uf') }}">
                                    @error('uf') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-9">
                                    <label for="logradouro">Logradouro</label>
                                    <input id="logradouro" type="text" class="form-control" name="logradouro" value="{{ old('logradouro') }}">
                                    @error('logradouro') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label for="numero">Nº</label>
                                    <input id="numero" type="text" class="form-control" name="numero" value="{{ old('numero') }}">
                                    @error('numero') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-5">
                                    <label for="bairro">Bairro</label>
                                    <input id="bairro" type="text" class="form-control" name="bairro" value="{{ old('bairro') }}">
                                    @error('bairro') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-7">
                                    <label for="complemento">Complemento</label>
                                    <input id="complemento" type="text" class="form-control" name="complemento" value="{{ old('complemento') }}">
                                    @error('complemento') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-divider">
                                Contato
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" class="form-control telefone" name="telefone" value="{{ old('telefone') }}">
                                    @error('telefone') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="celular">Celular</label>
                                    <input id="celular" type="text" class="form-control celular" name="celular" value="{{ old('celular') }}">
                                    @error('celular') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Estudante/Profissional/Associado</label>
                                    <select class="form-control selectric" name="tipo">
                                        <option value="0" selected>Selecione um Tipo</option>
                                        <option value="1" {{ old('tipo') == 1 ? 'selected' : '' }}>Estudante</option>
                                        <option value="2" {{ old('tipo') == 2 ? 'selected' : '' }}>Profissional</option>
                                        <option value="3" {{ old('tipo') == 3 ? 'selected' : '' }}>Associado</option>
                                    </select>
                                    @error('tipo') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>

                            </div>
                            <div class="form-divider">
                                Credenciais
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="password" class="d-block">Password</label>
                                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                                    <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                        <div class="label"></div>
                                    </div>
                                    @error('password') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="password2" class="d-block">Password Confirmation</label>
                                    <input id="password2" type="password" class="form-control" name="password_confirmation">
                                    @error('password_confirmation') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="agree" class="custom-control-input" id="agree" value="{{ old('agree') }}">
                                    <label class="custom-control-label" for="agree">Eu concordo com os termos e condições</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Registrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; Stisla 2018
                </div>
            </div>
        </div>
    </div>
</section>
</x-guest-layout>
