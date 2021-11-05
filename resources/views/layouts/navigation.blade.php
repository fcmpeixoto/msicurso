<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">msicurso</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">MSI</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Página Inicial</li>
            <li class="nav-item">
                <a href="{{ route('mscurso.dashboard.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Home</span></a>
            </li>
            @role('administrador')
            <li class="menu-header">Cursos</li>
            <li class="nav-item {{ request()->routeIs('mscurso.cursos.*')  ? 'active' : ''  }}">
                <a href="{{ route('mscurso.cursos.index') }}" class="nav-link"><i class="fas fa-columns"></i><span>Listar Curso</span></a>
            </li>
            @endrole
            @role('aluno')
            <li class="menu-header">Comprar Cursos</li>
            <li class="nav-item">
                <a href="{{ route('mscurso.comprar.mcurso') }}" class="nav-link"><i class="fa fa-shopping-cart"></i><span>Comprar</span></a>
            </li>
            <li class="menu-header">Meus Cursos</li>
            <li class="nav-item {{ request()->routeIs('mscurso.aluno.*')  ? 'active' : ''  }}">
                <a href="{{ route('mscurso.aluno.index') }}" class="nav-link"><i class="fas fa-columns"></i><span>Listar Curso</span></a>
            </li>
            @endrole
            @role('administrador')
            <li class="menu-header">Usúario</li>
            <li class="nav-item {{ request()->routeIs('mscurso.usuarios.*')  ? 'active' : ''  }}">
                <a href="{{ route('mscurso.usuario.index') }}" class="nav-link"><i class="fas fa-columns"></i><span>Listar Usúario</span></a>
            </li>
            <li class="nav-item {{ request()->routeIs('mscurso.curso.*')  ? 'active' : ''  }}">
                <a href="{{ route('mscurso.curso.listar.inscritos') }}" class="nav-link"><i class="fas fa-table"></i><span>Listar Inscrito</span></a>
            </li>
            @endrole
        </ul>
    </aside>
</div>
