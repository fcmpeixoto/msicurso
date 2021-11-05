<div>
    <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto"></div>
        <ul class="navbar-nav navbar-right">
            <li class="dropdown">
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    <a href="{{ route('mscurso.carrinho.curso') }}" class="text-sm text-white underline">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ $rsTotal }} &nbsp;
                    </a>
                </div>
            </li>
            <li class="dropdown">
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/mscurso/dashboard') }}" class="text-sm text-white underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-white underline">Entrar</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-white underline">Criar Conta</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </li>
        </ul>
    </nav>
    <div class="main-content" style="padding-left: 30px; !important;">
        <section class="section">
            <div class="section-header">
                <h1>MSI CURSOS - </h1>
            </div>
            <div class="section-body">
                <div class="row">
                    @forelse($rsCurso as $dadosCurso)
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="pricing">
                                <div class="pricing-title">
                                    {{ $dadosCurso->nome }}
                                </div>
                                <div class="pricing-padding">
                                    <div class="pricing-price">
                                        <div>R$ {{ $dadosCurso->valor }}</div>
                                    </div>
                                    <div class="pricing-details">
                                        <div class="pricing-item">
                                            {!! $dadosCurso->descricao !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="pricing-cta">
                                    <a wire:click.prevent="adiconarCarrinho('{{ (string) $dadosCurso->id }}')" style="cursor: pointer">Comprar <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Não há Cursos Cadastrados
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
        </section>
    </div>
</div>
