<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jhetro | Sis. Guias</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
        <link data-require="bootstrap@3.3.7" data-semver="3.3.7" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"/>

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/select2.min.css') }}"  /> 
    
    <!-- Sweet Alert-->
    <link rel="stylesheet" href="{{asset('adminlte/css/sweetalert.css')}}">
    

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/css/AdminLTE.min.css')}}">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('adminlte/css/_all-skins.min.css')}}">
    
    <link rel="apple-touch-icon" href="{{asset('adminlte/img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    
    

    
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="{{url('/admin')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SIS</b>J</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SISJhetro</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              
              <li class="dropdown"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <img src="{{asset('/adminlte/img/avatar_plusis.jpg')}}" class="user-image" alt="User Image" style="float:left;width:25px;height:25px;border-radius:50%;margin-right:10px;margin-top:-2px" />
                  <!-- Status -->
                  <small class="bg-red">Online</small>
                  <span class="hidden-xs">{{ auth()->user()->name}}</span>  
                  <small class="bg-red">| Sucursal</small>
                  <span class="hidden-xs">{{ session('sucursal') }}</span>  
                  <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <a href="#" class="align-content-lg-around"><i class="fa fa-user"></i> Perfil</a>
                    <br>
                    <a href="#" class="align-content-around"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-btn fa-sign-out"></i>
                            Cerrar Sesión
                    </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
             @if (! Auth::guest())
              <div class="user-panel">
                  <div class="pull-left image">
                      <img src="{{asset('/adminlte/img/avatar_plusis.jpg')}}" class="img-circle" alt="User Image" />
                  </div>
                  <div class="pull-left info">
                      <p>{{ Auth::user()->name }}</p>
                      <!-- Status -->
                      <a href=""><i class="fa fa-circle text-success"></i>Online</a>
                  </div>
              </div>
            @endif
            @if(Auth::user()->id_rol == 1)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Mantenimiento</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{URL('mantenimiento/cargo')}}"><i class="fa fa-circle-o"></i> Cargo</a></li>
                  <li><a href="{{URL('mantenimiento/ciudad')}}"><i class="fa fa-circle-o"></i> Ciudad</a></li>
                  <li><a href="{{URL('mantenimiento/empresa')}}"><i class="fa fa-circle-o"></i> Empresa</a></li>
                  <li><a href="{{URL('mantenimiento/formas_pago')}}"><i class="fa fa-circle-o"></i> Formas de Pago</a></li>
                  <li><a href="{{URL('mantenimiento/motivo_traslado')}}"><i class="fa fa-circle-o"></i> Motivo de Traslado</a></li>
                  <li><a href="{{URL('mantenimiento/sucursal')}}"><i class="fa fa-circle-o"></i> Sucursal</a></li>
                </ul>
              </li>
            @endif
            @if(Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-shopping-cart"></i>
                  <span>Ventas</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{URL('ventas/guia')}}"><i class="fa fa-circle-o"></i> Guia</a></li>
                  <li><a href="{{URL('personas/cliente')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
                </ul>
              </li>
            @endif
            @if(Auth::user()->id_rol == 1)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-edit"></i>
                  <span>Editar Guia</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{ URL('editar_guia/recargo') }}"><i class="fa fa-circle-o"></i>Recargo/cancelar</a></li>
                  <li><a href="{{ URL('editar_guia/editarCliente') }}"><i class="fa fa-circle-o"></i>Cancelar por bloque</a></li>
                  </ul>
              </li>
            @endif
            @if(Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-bank"></i>
                  <span>Cajas</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{URL('caja')}}"><i class="fa fa-circle-o"></i>Cancelar Guias</a></li>
                </ul>
              </li>
            @endif
            <li class="treeview">
              <a href="#">
                <i class="fa fa-search-plus"></i>
                <span>Buscar guia para clientes</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{URL('buscar_guia/cliente')}}"><i class="fa fa-circle-o"></i>Busqueda para Cliente</a></li>
              </ul>
            </li>
            @if(Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2 || Auth::user()->id_rol == 3)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-search"></i>
                  <span>Consultar Guias Canceladas</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
            @endif
                <ul class="treeview-menu">
                    @if(Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2 || Auth::user()->id_rol == 3)
                      <li><a href="{{URL('bodega/entrega')}}"><i class="fa fa-circle-o"></i>Registro entrega</a></li>
                    @endif
                </ul>
              </li>
            @if(Auth::user()->id_rol == 1)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-user-plus"></i> <span>Seguridad</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{URL('seguridad/usuario')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                  <li><a href="{{URL('seguridad/empleado')}}"><i class="fa fa-circle-o"></i> Empleados</a></li>
                </ul>
              </li>
            @endif
            @if(Auth::user()->id_rol == 1)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-folder"></i> <span>Control Personal</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{URL('controlpersonal')}}"><i class="fa fa-circle-o"></i>Reporte Empleados</a></li>
                </ul>
              </li>
            @endif
            @if(Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2)
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-calendar"></i> <span>Reportes</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{URL('reportes/clientes')}}"><i class="fa fa-circle-o"></i>Clientes</a></li>
                  <li><a href="{{URL('reportes/mensual')}}"><i class="fa fa-circle-o"></i>Mensualizados</a></li>
                  <li><a href="{{URL('reportes/varios')}}"><i class="fa fa-circle-o"></i>Varios</a></li>
                </ul>
              </li>
            @endif
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="https://www.transporte-jhetro.com/">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>    
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema Jhetro</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                              <!--Contenido-->
                              @yield('contenido')
                              <!--Fin Contenido-->
                           </div>
                        </div>
                        
                      </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 5.8.0
        </div>
        <strong>Copyright &copy; 2015-2020 <a href="">Jhetro</a>.</strong> All rights reserved.
      </footer>

    </div>
    <!-- jQuery 2.1.4 -->
         <script data-require="jquery@2.2.4" data-semver="2.2.4" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
       <script data-require="bootstrap@3.3.7" data-semver="3.3.7" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>

    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('js/select2.min.js') }}"></script> 
    
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/js/app.min.js')}}"></script>
    <script src="{{asset('adminlte/js/sweetalert.min.js')}}"></script>
    
    <!-- Mias -->
    <script src="{{asset('adminlte/js/validarDocumento.js')}}"></script>
    <script src="{{asset('adminlte/js/validarCantidad.js')}}"></script>

    <!--SweetAlert-->
    <script src="vendor/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    
    <!-- Include this after the sweet alert js file -->
    @include('sweetalert::alert')
  </body>
</html>
