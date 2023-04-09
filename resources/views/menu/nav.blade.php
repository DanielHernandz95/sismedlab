<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block ">
            <a class="nav-link"  href="../home">
                <i class="fas fa-home color_texto"></i>
                <span class="color_texto">Inicio</span>
            </a>
        </li> 
    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-cogs color_texto"></i>
                <span class="color_texto">Cuenta</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">                         
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user-cog"></i></i> Perfil
                </a>
                <a class="dropdown-item color_texto" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt color_texto"></i> {{ __('Salir') }}
                </a>                              
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>