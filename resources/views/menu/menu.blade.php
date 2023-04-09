
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <ul class="flex-column" >
            <img src="/imagenes/nuevo.png" alt="AdminLTE Logo" class="nav-link logo_person" style="">
        </ul>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image ">
                <img src="/imagenes/avatar.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <h6 class="d-block color_texto">{{ Auth::user()->name }}</h6>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                $rol = Auth::user()->llaveRol_usuario ;
                $menu = DB::table('menus')
                ->join('tbl_rol','tbl_rol.id_rol','=','menus.rol_menu')
                ->where('rol_menu','=',$rol )
                ->where('tipo','=','principal')
                ->get() 
                @endphp
                @foreach($menu  as $key => $viewMenu)
                <li class="nav-item has-treeview">
                    <a href="{{ $viewMenu->ruta }}" class="nav-link">
                        <i class="{{ $viewMenu->icono }}"></i>
                        <p class="color_texto">
                            {{$viewMenu->menu}}
                            <i class="{{$viewMenu->iconoEspecial}}"></i>
                        </p>
                    </a>
                    @php
                    $subMenu = DB::table('menus')
                    ->where('tipo','=','segundario')
                    ->where('sub','=',$viewMenu->idMenus)
                    ->get() ;
                    $siHay = 0;                               
                    @endphp

                    @foreach($subMenu  as $key => $viewSubMenu)
                    @php
                    $siHay++;
                    @endphp
                    @endforeach

                    @if($siHay > 0 )
                    <ul class="nav nav-treeview">
                        @foreach($subMenu  as $key => $viewSubMenu)                               
                        <li class="nav-item">
                            <a href="{{ $viewSubMenu->ruta }}" class="nav-link">
                                <i class="{{ $viewSubMenu->icono }}"></i>
                                <p class="color_texto">{{$viewSubMenu->menu}}
                                    <i class="{{$viewSubMenu->iconoEspecial}}"></i>
                                </p>
                            </a>
                            @php
                            $triMenu = DB::table('menus')
                            ->where('tipo','=','tercera')
                            ->where('sub','=',$viewSubMenu->idMenus)
                            ->get() ;
                            $sitri = 0;                               
                            @endphp
                            @foreach($triMenu  as $key => $viewTriMenu)
                            @php
                            $sitri++;
                            @endphp
                            @endforeach
                            @if($sitri > 0 )
                            <ul class="nav nav-treeview">
                                @foreach($triMenu  as $key => $viewTriMenu)                               
                                <li class="nav-item">
                                    <a href="{{ $viewTriMenu->ruta }}" class="nav-link">
                                        <i class="{{ $viewTriMenu->icono }}"></i>
                                        <p class="color_texto">{{$viewTriMenu->menu}}

                                        </p>
                                    </a>
                                </li>                                 
                                @endforeach
                            </ul>
                            @endif
                        </li>                                 
                        @endforeach
                    </ul>
                    @endif
                </li> 
                @endforeach                          
                <!-- / Informe graficas -->                 
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>