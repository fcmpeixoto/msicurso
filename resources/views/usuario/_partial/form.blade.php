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

<div class="form-group">
    <label for="email">Email</label>
    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
    @error('email') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
    <div class="invalid-feedback">
    </div>
</div>
<div class="form-divider">
    Credenciais
</div>
<div class="row">
    <div class="form-group col-12">
        <label>Perfil</label>
        <select class="form-control selectric" name="perfil">
            <option value="0" selected>Selecione um Perfil</option>
            @forelse($rsPerfil as $dadosPerfil)
                <option value="{{ $dadosPerfil->id }}" {{ old('tipo') == $dadosPerfil->id ? 'selected' : '' }}>{{ $dadosPerfil->name }}</option>
            @empty @endforelse
        </select>
        @error('perfil') <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #dc3545;">{{ $message }}</span> @enderror
    </div>
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

