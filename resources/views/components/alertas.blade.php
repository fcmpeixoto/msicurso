@if ($errors->any())
    <div class="alert alert-danger alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <div class="alert-title">Erro!</div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif

@if (session('message'))
    <div class="alert alert-success alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <div class="alert-title">Sucesso!</div>
            {{ session('message') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <div class="alert-title">Erro!</div>
            {{ session('error') }}
        </div>
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <div class="alert-title">Informação!</div>
            {{ session('info') }}
        </div>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <div class="alert-title">Atenção!</div>
            {{ session('warning') }}
        </div>
    </div>
@endif
