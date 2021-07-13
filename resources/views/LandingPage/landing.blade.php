<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>#Ing. Sistemas U. Latina</title>

    <link href="{{ asset('css/todo.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landingPage.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Manrope&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
    crossorigin="anonymous">   
</head>

<body>
    <div class="row">
        <div class="col-lg-4 col-md-offset-4 dismissInfo">
            @if(session('sucess'))
                <div class="alert alert-success">
                <button type = "button" class="close" data-dismiss = "alert">x</button>
                    {{ session('sucess') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alertDismissible">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    
    <div class="oculter"></div>

    <div class="popupper">
       @yield('content')
    </div>
    
    <div class="popUpController col-xs-12 col-md-5">
        <center>
            <div class="logo">
                <img src="{{asset('images/logo.png')}}" width="200px" />
            </div>
        </center>
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#login">Ingresar</a></li>
                <li><a data-toggle="tab" href="#menu1">Registrarse</a></li>
                <li><a data-toggle="tab" href="#menu2">Reset contrase&ntilde;a</a></li>
            </ul>

            <div class="tab-content">
                <div id="login" class="tab-pane fade in active">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('loginForm') }}">
                            {{ csrf_field() }}

                            <div class="field form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="field-label">Correo</label>

                                <input id="email" title="Ingrese el correo electrónico de usuario registrado en el sistema INTEGRA." type="email" class="form-control field-input"
                                    name="email" value="{{ old('email') }}" required autofocus>                                @if ($errors->has('email'))
                                <span class="help-block">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span> @endif
                            </div>

                            <div class="field form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="field-label">Contrase&ntilde;a</label>

                                <input id="password" title="Presione este botón una vez que haya ingresado el usuario y la contrase&ntilde;a" type="password" class="form-control field-input"
                                    name="password" required> 
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span> 
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('locked') ? ' has-error' : '' }}">
                                <button type="submit" class="btn btn-success pull-right">Ingresar</button> 
                                @if ($errors->has('locked'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('locked') }}</strong>
                                    </span> 
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <div class="col-md-12">

                        <div class="form-group">
                            <div class="col-md-12">
                                <a class="btn btn-success btn-close btn-block" href="{{ route('registerRegistro') }}">Registrar usuarios de Registro</a>
                                <a class="btn btn-success btn-close btn-block" href="{{ route('register') }}">Registrar usuarios Estudiantes</a>
                                <a class="btn btn-success btn-close btn-block" href="{{route('registerProfessor') }}">Registrar usuario Profesor</a>
                                <a class="btn btn-success btn-close btn-block" href="{{ route('registerCompany') }}">Registrar usuario Empresa</a>
                                <a class="btn btn-success btn-close btn-block" href="{{ route('registerCompany') }}">Registrar usuario Instituto</a>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <div class="col-md-12">

                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}

                            <div class="field form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label field-label">Correo</label>

                                <input id="email" type="email" class="form-control field-input" name="email" value="{{ old('email') }}" required>                                @if ($errors->has('email'))
                                <span class="help-block">
                                                                        <strong>{{ $errors->first('email') }}</strong>
                                                                    </span> @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success pull-right">
                                                                    Recibir Link
                                                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button aria-controls="bs-navbar" aria-expanded="false" class="collapsed navbar-toggle" data-target="#bs-navbar" data-toggle="collapse"
                    type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span> <span class="icon-bar"></span>
                            <span class="icon-bar"></span> </button>

                <a href="index.php" class="navbar-brand">
                            <img src="{{ asset('images/logo.png') }}" width="218px"  />
                        </a>
            </div>
            <nav class="collapse navbar-collapse" id="bs-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="padding-7">
                            <button type="button" class="btn btn-sm btn-default btn-success" id="popUpShow">
                                Ingresar
                            </button>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>
    <div class="imgback"></div>

    <div class="container">
        <div class="title">
            Escuela Ing. Sistemas Computacionales<b>UNO</b> -
        </div>
        <div class="texto">
            Una plataforma facil de usar, creada por estudiantes, para estudiantes, cuya misi&oacute;n es conectar todas las sedes de la Universidad Latina. Como estudiante puedes realizar tr&aacute;mites administrativos
            correspondientes a la escuela desde aqu&iacute;: Levantamiento de requisitos, Convalidaciones, correo, Practicas Empresariales Supervisadas (PES), Trabajos
            Finales de Graduación (TFG), Trabajo Comunal Universitario (TCU), adhesi&oacute;n a proyectos de investigaci&oacute;n y extensi&oacute;n.

            <br><br>
            Necesitas informaci&oacute;n, cambio de plan, contactar a un representante acad&eacute;mico, o bien un programa de actualizaci&oacute;n de egresados?
            Ven&iacute; y disfrut&aacute; de eventos, biblioteca de pr&aacute;cticas y ex&aacute;menes anteriores, tutor&iacute;as virtuales semanales y m&aacute;s!
        </div>

        <div class="row divider">
            <div class="col-lg-3">
                <div class="row card">
                    <div class="col-lg-12 card1"></div>
                    <div class="col-lg-12 card-title">
                        Bolet&iacute;n informativo
                    </div>
                    <div class="col-lg-12 card-container">
                        Descarga informaci&oacute;n relativa con la carrera de Ingenier&iacute;a en Sistemas Computacionales:
                        Perfil porfesional, objetivos, Malla curricular.
                    </div>
                    <div class="col-lg-12">
                        <a href="{{ route('download','Baucher') }}">
                            <button type="button" class="btn btn-sm btn-default btn-success" id="notpopper">
                                Descargar
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                    <div class="row card">
                            <div class="col-lg-12 card2"></div>
                            <div class="col-lg-12 card-title">
                                Autorizaci&oacute;n cambio de plan
                            </div>
                            <div class="col-lg-12 card-container">
                                Ingenier&iacute;a en Sistemas Computacionales se encuentra acreditada en Heredia desde el II Cuatrimestre del 2018. Cambia de Plan voluntariamente.
                            </div>
                            <div class="col-lg-12">
                                <a href="{{ route('download','CambioPlan') }}">
                                    <button type="button" class="btn btn-sm btn-default btn-success" id="notpopper">
                                        Descargar
                                    </button>
                                </a>
                            </div>
                        </div>
            </div>
            <div class="col-lg-3">
                    <div class="row card">
                            <div class="col-lg-12 card3"></div>
                            <div class="col-lg-12 card-title">
                                TCU - Robotico
                            </div>
                            <div class="col-lg-12 card-container">
                                Te falta TCU? Ven&iacute; y disfrut&aacute; de nuestros proyectos preaprobados, lideres en el mercado nacional como ROBOTICO!                                
                            </div>
                            <div class="col-lg-12">
                                <a href="{{ route('download','ROBOTICO') }}">
                                    <button type="button" class="btn btn-sm btn-default btn-success" id="notpopper">
                                        Descargar
                                    </button>
                                </a>
                            </div>
                        </div>
            </div>
            <div class="col-lg-3">
                <div class="row card">
                        <div class="col-lg-12 card4"></div>
                        <div class="col-lg-12 card-title">
                            Levantamiento de requisitos
                        </div>
                        <div class="col-lg-12 card-container">
                            Revisa las materias que pueden ser levantadas, la informaci&oacute;n general y c&oacute;mo optar por este beneficio                                
                        </div>
                        <div class="col-lg-12">
                            <a href="{{ route('download','Levantamientos') }}">
                                <button type="button" class="btn btn-sm btn-default btn-success" id="notpopper">
                                    Descargar
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row card">
                        <div class="col-lg-12 card4"></div>
                        <div class="col-lg-12 card-title">
                            Proyectos de investigaci&oacute;n
                        </div>
                        <div class="col-lg-12 card-container">
                            Verifique los diferentes proyectos de investigaci&oacute;n que se realizan y es bienvenido a participar en ellos.                                       
                        </div>
                        <div class="col-lg-12">
                            <a href="{{ route('download','Investigacion') }}">
                                <button type="button" class="btn btn-sm btn-default btn-success" id="notpopper">
                                    Descargar
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container-fluid footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <img src="https://ulatina.ac.cr/wp-content/uploads/2017/07/laureate.png" alt="" >
                    </div>
                    <div class="col-lg-6 creditos-centro">
                        #SOMOSs<b>UNO</b>  Ing. Sistemas Computacionales Pa&iacute;s. <br>
                        creado por estudiantes, para estudiantes.
                    </div>
                    <div class="col-lg-3 creditos-centro">
                            <img src="{{asset('images/logo.png')}}" width="200px" alt="" class="w-auto animated bounceIn">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/todo.min.js') }}"></script>
<script>
    $(function() {
            $("#popUpShow").on("click",function(){
                $(".oculter").fadeIn("slow", function(){
                    $(".popUpController").fadeIn("slow");
                });
            });
        });

        $(document).keyup(function(e) {
            if (e.keyCode === 27 && $(".popUpController").css("display") !== "none" ) {
                $(".popUpController").fadeOut("fast",function(){
                    $(".oculter").fadeOut("fast");
                });
            }
        });

</script>

</html>
