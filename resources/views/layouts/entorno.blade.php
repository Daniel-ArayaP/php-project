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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <link href="{{ asset('css/todo.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pageWeb.css') }}" rel="stylesheet">
    <style>
          .wrapper {
              margin-top:40px;
              background: #fff
          }

          .navbar {
              z-index: 3
          }

          .list-group-item .fas {
              font-weight: 900;
              background: rgba(0,0,0,.2);
              line-height: 2;
              padding: 0 10px;
              border-radius: 10px;
              margin-right: 10px;
              color: white;
          }
  a {
      text-decoration: none !important;
      color: inherit
  }

          .forum_category_title_icon .fas {
      position: relative;
      left: 50%;
      transform: translateX(-50%);
  }

  .list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
      z-index: 2;
      color: #fff;
      background-color: #8DC63F;
      border-color: #89C33B;
  }
  .panel-primary {
      border-color: #dee5e7 !important;
  }

  .panel-primary>.panel-heading {
      border-color: #ddd !important;
  }

  .dropdown .fas {
      color: white !important
  }

  .btn-primary-ulat {
      color: #fff;
      background-color: #8dc63f;
      transition: .2s;
      box-shadow: 0px 0px 2px #ddd inset;
      text-shadow: 0px 0px 1px rgba(0, 0, 0, .1);
  }

  .btn-sm btn-primary-ulat:hover {
      color: #fff;
      background-color: #0D844D;
      border-color: #0D844D;
      transform: translateY(1%);
  }

  .btn-right {
      position: absolute;
      right: 10px;
      top: 5px;
      width: 100px;
  }

  .btn-right2 {
      position: absolute;
      top: -48px;
      width: 100px;
      right: 40px;
  }

  .infoRight {
      position: absolute;
      right: 40px;
      top: -14px;
      font-size: 10px;
  }

  .editorContainer {
      padding: 10px;
      border: 1px solid #ddd;
      background: white;
      border-radius: 0px 0px 4px 4px;
      display: block;
  }

  .editorContainer>* {
      display: block;
  }

  .lblfix {
      line-height: 2.0 !important;
      margin: 0 !important;
      text-align: left !important;
      padding-right: 0;
  }

  .postModified {
      background: #f6f6f6;
      padding: 10px;
      border-radius: 10px;
      margin: 15px 21px;
  }

  .inputname {
      margin-bottom: 10px;
  }

  .ck-editor__editable_inline {
      min-height: 200px !important
  }

  .cpbtn {
      margin-top: 10px
  }

  .reply_title {
      margin-bottom: 0;
      border-radius: 4px 4px 0px 0px;
      padding: 15px 10px;
      font-weight: 400;
      letter-spacing: .8px;
      text-transform: uppercase;
  }

  .reply_title::first-letter {
      text-transform: uppercase;
  }

  .replyNombre {
      border-bottom: 1px solid #ddd;
      margin: 0;
      background: #fbfbfb;
      padding: 5px 0;
      border-radius: 4px;
  }

  .reply {
      background: #fff;
      border-radius: 4px;
      border: 1px solid #ddd;
      margin: 10px 0;
  }

  .reply_body>.reply:nth-child(2) {
      margin: 0 !important;
      border-radius: 0 0 4px 4px
  }

  .replyPost {
      text-align: justify;
      text-justify: inter-word;
  }

  .replyPost {
      margin: 0 !important;
      padding: 40px;
  }

  .editorContainerReply {
      border-radius: 4px;
  }


  .forum_category_title [class^='col-']>[class^='col-'] {
      padding: 0 !important
  }

  .index {
      border-radius: 4px;
      margin-bottom: 15px;
      background: #f5f5f5;
      border: 1px solid #dee5e7;
  }

  .index ul {
      list-style: none;
      padding: 0;
      margin: 0;
  }

  .index ul>li {
      display: inline-block;
      line-height: 2.3;
      min-width: 80px;
      text-align: center;
  }

  .index ul>li::after {
      font-family: "Font Awesome 5 Free";
      font-weight: 900;
      font-style: normal;
      font-variant: normal;
      text-rendering: auto;
      line-height: 1;
      content: "\f105";
      -webkit-text-stroke: .36rem #f5f5f5;
      -webkit-font-smoothing: antialiased;
      font-size: 37px;
      float: right;
  }

  .replyPost .table table {
      border-collapse: collapse !important;
      width: 80%;
      text-align: center;
      margin: 0 auto;
  }

  .chatBoxTitle,
  .forum_category,
  .panel-heading {
      font-size: 18px;
      line-height: 1.8;
      border-bottom: 1px solid #dee5e7;
      padding: 0;
      position: relative;
      padding: 5px 10px;
      background-color: #f5f5f5 !important;
      font-weight: 300;
      color: #333 !important;
      border-radius: 4px 4px 0 0;
  }

  .chatBoxTitle::first-letter,
  .forum_category::first-letter,
  .panel-heading::first-letter {
      font-weight: 400;
      font-size: 20px
  }

  .userName::first-letter {
      text-transform: uppercase;
  }

  .forum_category {
      border-radius: 4px 4px 0px 0px;
      margin-top: 22px;
      border: 1px solid #dee5e7;
  }


  .replyPost .table {
      text-align: center;
  }

  .replyPost .table tr td {
      border: 1px solid;
  }

  .replyPost .table tr:first-child {
      height: 50px;
      text-align: center;
      font-weight: bold;
      background: #3a3f51;
      color: white !important;
  }

  .replyPost .table tr:first-child>td {
      color: white !important;

  }

  .replyPost .table tr:nth-child(2n) {
      background: #eee;
  }

          .forum_body {
      margin-top: 20px;
  }

  .created_by {
      font-size: 12px;
  }

  .latestPost {
      font-size: 13px;
      font-weight: 300;
      text-align: right;
  }

  .latestname {
      font-size: 13px;
      font-weight: 300;
  }

  .forum_category_title {
      background: #fff;
      margin: 0;
      padding: 10px;
      border-bottom: 1px solid #ddd;
      border-right: 1px solid #ddd;
      border-left: 1px solid #ddd;
      height: 70px;
  }

  .forum_category_title:last-child {
      border-radius: 0px 0px 4px 4px;
  }

  .forum_category_subtitle {
      color: #b4b4b4 !important;
      font-size: 12px;
  }

  .forum_category_title_icon {
      line-height: 2.7;
      background: #8dc63f;
      border-radius: 100px;
      font-size: 18px;
      color: white !important;
      width: 50px;
      margin: 0px auto;
      border: 1px solid #4c9058;
      box-shadow: 0px -4px 7px #719e32 inset;
  }

  .title {
      text-align: center;
      margin: 10px 0;
      text-transform: uppercase;
      font-weight: bold;
      letter-spacing: 1px;
  }


  .pl-0 {
      padding-left: 0 !important
  }

  #hidden_div {
      display: none
  }


.title_entorno{
    margin: 10px 0;
    text-transform: uppercase;
    font-weight: bold;
    letter-spacing: 1px;
}

/*Presentacion de eventos en eventos colaborativos*/
.dateEvent {
    margin-top: 50%;
}

.eventTitle {
font-size: x-large;
font-weight: bolder;
}

.box-event{
border-left: 2px solid #e6e6e6;
}
.eventTime {
    font-size: large;
    color: #6c757d;
}
    </style>

@yield('styles')
</head>

<body>
    <div class="top-bar navbar-fixed-top">
        <div class="container">
            <div class="row">
                <div class="col-xs-4">
                    <ul class="list-inline d-flex flex-row">
                        <li class="list-inline-item">
                            <a href="#">#SOMOS<b>UNO</b></a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-8 text-right account-details">
                    <ul class="list-inline">
                        <li class="list-inline-item dropdown default">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->email}} <i class="fas fa-caret-down"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    @switch (Auth::user()->role_id)
                                        @case (1)
                                            <a href="{{route('adminProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a>
                                        @break
                                        @case (2)
                                            <a href="{{route('studentProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a>
                                        @break
                                        @case (3)
                                            <a href="{{route('companyProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a>
                                        @break
                                        @case (4)
                                            <a href="{{route('instituteProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a>
                                        @break
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
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-fixed-top">

        <div class="container">
            <div class="col-lg-12">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a class="navbar-brand">
                        <img src="{{asset('images/logo2.png')}}" style="height: 35px;" />
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right hidescroll">
                        <li><a href="{{ route('webPage') }}">Inicio</a></li>
                        <li><a href="{{route(Auth::user()->getIndexPage())}}">Servicios</a></li>
                        <li><a href="/ojs">OJS</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="devider"></div>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-3">


                    <div class="title">Entorno Colaborativo</div>

                    <div class="list-group">
                        <a href="{{route('entornoColaborativo')}}" class="list-group-item active">
                            <i class="fas fa-folder-open"></i> Inicio
                        </a>
                        <a href="{{route('mail')}}" class="list-group-item"><i class="fas fa-folder-open"></i> Correo</a>
                        <a href="{{route('calendarIndex')}}" class="list-group-item"><i class="fas fa-book-dead"></i> Calendario</a>
                        <a href="{{route('listEvents')}}" class="list-group-item"><i class="fas fa-user-plus"></i> Eventos colaborativos</a>
                        <a href="{{route('listLibrary')}}" class="list-group-item"><i class="fas fa-book"></i> Biblioteca </a>
                        <a href="{{ route('entorno.reportes.index') }}" class="list-group-item">
                            <i class="fas fa-file-invoice"></i>
                            Reportes
                        </a>
                    </div>
                </div>

                <div class="col-xs-9">
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

    </div>
    <div class="gotop">
        <a href="#top">go top</a>
    </div>
    <script src="{{ asset('js/todo.min.js') }}"></script>
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
     </script>
    @yield('scripts')
</body>

</html>
