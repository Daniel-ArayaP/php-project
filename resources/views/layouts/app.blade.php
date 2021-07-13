<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<?php 
    use App\Http\Controllers\MenuController;
?>
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
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">




    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- Theme style -->


    <!-- Theme style -->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>

    <div id="loader">
        <img src="{{ asset('images/logo.png') }}">
    </div>
    <div id="app">
        <div id="wrapper">

            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                    <a class="navbar-brand">
                        <img src="{{asset('images/logo.png')}}" style="height: 50px;" />
                    </a>
                </div>

                <ul class="nav navbar-right top-nav hidden-xs">
                    <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->email}} <i class="fas fa-caret-down"></i></a>


                        <ul class="dropdown-menu">
                            <li>
                                @switch (Auth::user()->role_id)
                                    @case (1)
                                        <a href="{{route('adminProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a> @break
                                    @case (2)
                                        <a href="{{route('studentProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a> @break

                                    @case (3)
                                    <a href="{{route('companyProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a> @break
                                    @case (4)
                                    <a href="{{route('instituteProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a> @break
                                @endswitch

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
                    </li>
                </ul>

                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <div class="scrollfix side-nav">
                        <ul class="nav navbar-nav hidescroll">

                            <li class="title">Navegación modulos</li>
                            {!! MenuController::createMenu() !!}
                            
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </nav>

            <div id="page-wrapper">
                @if(session('sucess'))
                    <div class="alert alert-success alertDismissible">
                    <button type = "button" class="close" data-dismiss = "alert">x</button>
                        {{ session('sucess') }}
                    </div>
                    
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alertDismissible">
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content')

            </div>

        </div>
    </div>

    <script src="{{ asset('js/todo.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script>
        var myWindow=null;
        function popup(link)
        {
            if(myWindow=== null)
            {
                 myWindow = window.open(link, "myWindow", 'width=800,height=600');
            }
            else
            {
                myWindow.close();
                myWindow=null;
                myWindow = window.open(link, "myWindow", 'width=800,height=600');
            }   
        }

        $(document).on("click",function(e) {
            var container = $("#outArea");
            if (!container.is(e.target) && container.has(e.target).length === 0) { 
        	    closeWindows();
            }
		});

        function closeWindows()
        {
            if (myWindow) {
                myWindow.close();
                myWindow=null;
                location.reload(true);
            }
        }
    </script>
    @yield('scripts')
</body>

</html>