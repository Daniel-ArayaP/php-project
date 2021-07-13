<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


  <link href="https://fonts.googleapis.com/css?family=Manrope&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/todo.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pageWeb.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landingPage.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
</head>

<body>

    <div class="oculter"></div>
        
    <div class="top-bar navbar-fixed-top">
        <div class="container">
            <div class="row">
                <div class="col-xs-4">
                    <ul class="list-inline d-flex flex-row">
                        <li class="list-inline-item">
                            <a href="#">#PROYECTO <b>UNO</b></a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-8 text-right account-details">
                    <ul class="list-inline">

                        <li class="list-inline-item dropdown default">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->email}} <i class="fas fa-caret-down"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    @switch (Auth::user()->role_id) @case (1)
                                    <a href="{{route('adminProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a> @break
                                    @case (2)
                                    <a href="{{route('studentProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a> @break
                                    @case (3)
                                    <a href="{{route('companyProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a> @break
                                    @case (4)
                                    <a href="{{route('instituteProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a>                                    @break @default: @break @endswitch

                                </li>
                                <li>
                                    <a href="{{ route('logoutOutlook') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Salir
                                            </a>
                                    <form id="logout-form" action="{{ route('logoutOutlook') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                        </ul>
                        </ul>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-fixed-top">

        <div class="container">
            <div class="col-lg-12">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"
                        aria-controls="navbar">
                        <i class="fas fa-bars"></i>
                      </button>
                    <a class="navbar-brand">
                            <img src="{{asset('images/logo2.png')}}" style="height: 60px"/>
                      </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right hidescroll">
                        <li class="active">
                            <a style="">Servicios disponibles</a>
                            <ul class="subUL">


                                <li><a href="{{ route('registerUsers') }}">Ver cupones disponibles</a></li>
                            </ul>
                        </li>
                        <li><a href="#info">Informacion general</a></li>
                        <li><a href="{{$serviceDir}}">Seccion de Servicios</a></li>
                        <li><a href="{{ route('entornoColaborativo') }}">Entorno Colaborativo</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="carousel fade-carousel slide carousel-fade" data-ride="carousel" data-interval="4000" id="bs-carousel">

        <div class="carousel-inner">
            <div class="item slides active carousel-item">
                <div class="slide-1">
                    <div class="overlay"></div>
                </div>
            </div>
            <div class="item slides carousel-item">
                <div class="slide-2">
                    <div class="overlay"></div>
                </div>
            </div>
            <div class="item slides carousel-item">
                <div class="slide-3">
                    <div class="overlay"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="container">
            <div class="title">
                <b>-- Escuela Ing. Sistemas Computacionales -- </b>
                <button class="btn btn-primary"><a class="btn pull-center"  href="{{ route('participantesreportstudents')}}">Detalles--Ruta bloqueada</a>
                </button>
            </div>
            <div class="texto">
                Una plataforma muy faci de usar, creada por estudiantes, para estudiantes, cuya misi&oacute;n es conectar todas las sedes de la Universidad Latina. Como estudiante puedes realizar tr&aacute;mites administrativos
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
            </div>
            <div class="footer">
                <div class="container-fluid footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="https://ulatina.ac.cr/wp-content/uploads/2017/07/laureate.png" alt="">
                            </div>
                            <div class="col-lg-6 creditos-centro">
                                #PROYECTO<b>UNO</b> - Escuela Ing. Sistemas Computacionales Pa&iacute;s. <br>
                                creado por estudiantes, para estudiantes.
                            </div>
                            <div class="col-lg-3 creditos-centro">
                                    <img src="{{asset('images/logo1.png')}}" width="50px" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="gotop">
        <a href="#top">go top</a>
    </div>
    <script src="{{ asset('js/todo.min.js') }}"></script>
    <script src="{{ asset('js/pageWeb.js') }}"></script>


</body>

</html>