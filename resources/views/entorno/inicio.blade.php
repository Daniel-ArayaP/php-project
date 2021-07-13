@extends('layouts.entorno')
@section('content')  
<style>
.carousel-caption {
  background-color: rgba(0, 0, 0, 0.5);
  padding: 10px;
  border-radius: .5rem;
}
p{
  color:white!important;
}
h3{
  color:white!important;
}
</style> 
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" ></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item " >
     <a   href="{{route('mail')}}"> <img class="d-block w-100" src="{{asset('images/banner-correo.jpg')}}" alt="Correo"></a>
     <div class="carousel-caption d-none d-md-block">
    <h3>Correo</h3>
    <p>Desea ver su correo.</p>
  </div>
    </div>
    <div class="carousel-item active">
    <a href=""><img  class="d-block w-99" src="{{asset('images/entorno1.png')}}" alt="Calendario"></a>
    <div class="carousel-caption d-none d-md-block">
    <h3>Bienvenido</h3>
    <p>En este modulo te va a permitir entrar y trabajar vía zoom con cualquier estudiante de la escuela y en cualquier sede.</p>
  </div>
    </div>
    <div class="carousel-item">
    <a href="{{route('listEvents')}}"><img class="d-block w-100" src="{{asset('images/entornoColaborativo.jpg')}}" alt="Entorno Colaborativo"></a>
    <div class="carousel-caption d-none d-md-block">
    <h3>Eventos colaborativos</h3>
    <p>Desea ver la actividad de eventos colaborativos que tiene pendientes.</p>
  </div>
    </div>
    <div class="carousel-item">
    <a href="{{route('calendarIndex')}}"><img class="d-block w-100" src="{{asset('images/calendario.jpg')}}" alt="Calendario"></a>
    <div class="carousel-caption d-none d-md-block">
    <h3>Calendario</h3>
    <p>Desea ver sus eventos registrados y lo eventos que están pendientes o pasados.</p>
  </div>
    </div>
    <div class="carousel-item">
    <a href="{{route('listLibrary')}}"><img class="d-block w-100" src="{{asset('images/biblioteca.jpg')}}" alt="Biblioteca"></a>
    <div class="carousel-caption d-none d-md-block">
    <h3>Biblioteca</h3>
    <p>Te brinda la facilidad de guardar y encontrar documentos que hayan sido guardados por otros estudiantes.</p>
  </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

@endsection
