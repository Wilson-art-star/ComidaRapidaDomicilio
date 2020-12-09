<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Comida Rapida Laravel Vue Js">
    <meta name="author" content="adsi.com">
    <meta name="keyword" content="Sistema Comida Rapida Laravel Vue Js">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="img/9.png">
    <title>Comida Rapida a Domicilios</title>
    <!-- Icons -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link href="css/plantilla.css" rel="stylesheet">  
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app">
    <header class="app-header navbar">
    
        
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav d-md-down-none">
        <li>
        <a class="nav-link dropdown-toggle nav-link">
        <img src="img/9.png" class="img-avatar">
        </a>
        </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Escritorio</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Configuraciones</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#" data-toggle="dropdown">
                    <i class="icon-bell"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Notificaciones</strong>
                    </div>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-envelope-o"></i> Libros
                        <span class="badge badge-success">3</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-tasks"></i> New
                        <span class="badge badge-danger">2</span>
                    </a>
                </div>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto">
       <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" role="button" href="#" aria-haspopup="true" aria-expanded="false">
       <img src="img/avatars/Logo.jpg" class="img-avatar" alt="">
       <span>{{Auth::user()->name}}</span>
       </a>
       
       <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header">
          <strong>Cuenta</strong>
          
          <div>
          <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Perfil</a>
          <a class="dropdown-item"  href="{{route('logout')}}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          ><i class="fa fa-lock"></i> Cerrar Sesión</a>

          <form id="logout-form" action="{{route('logout')}}" method="POST" style="display:none">
          {{csrf_field()}}
          </form>
          </div>
          
          </div>
       
       </div>
    </li>
    </ul>

    </header>

    <div class="app-body">


    @if(Auth::check())
    @include('plantilla.sidebar')
    
    @endif

        <!-- Contenido Principal -->

  
       
        @yield('contenido')
        
       
        <!-- /Fin del contenido principal -->
    </div>
    </div>

    

    <footer class="app-footer">
        <span><a href="http://www.ADSI.com/">ADSI</a> &copy; 2020</span>
        <span class="ml-auto">Desarrollado por <a href="http://www.ADSI.com/">WilsonC69</a></span>
    </footer>

    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
</body>

</html>