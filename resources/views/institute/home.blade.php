@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <h2>Página Principal del Instituto</h2>
    <hr />
    <br />
    
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#pes">PES</a></li>
        <li><a data-toggle="tab" href="#tfg">TFG</a></li>
    </ul>
    <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-default">
                    <div class="panel-heading">Propuesta Proyecto PES</div>
                    <div class="panel-body">
                        <p>
                            Para plantear la Práctica Empresarial Supervisada, debe prestar atención a las siguientes recomendaciones que evitarán que su proyecto pueda ser rechazado:
                        </p>
                        <ol>
                            <li>
                                Debe ser un proyecto. Acorde a Project Management Institute (2000) un proyecto se define como: "...es un esfuerzo temporal acometido para crear un único servicio o producto. Temporal quiere decir que todo proyecto tiene un comienzo claro y un final claro. Único significa que el producto o servicio es diferente de alguna forma clara de todos los productos o servicios similares..."
                            </li>
                            <li>
                                Debe ser un proyecto para optar por un grado universitario de bachillerato. Por ende, propuestas de instalar una red o dar mantenimiento a equipos no son válidos ya que corresponden a nivel de técnico. 
                            </li>
                            <li>
                                El proyecto debe tener una duración mínima de 320 horas por persona.
                            </li>
                            <li>
                                La empresa en la que desea realizar la PES debe estar debidamente inscrita y tener cédula jurídica.
                            </li>
                            <li>
                                La empresa en la que desea realizar la PES no puede pertenecer a un familiar.
                            </li>
                            <li>
                                Si se desea realizar la PES en la empresa en la usted labora actualmente debe considerar: su tutor empresarial no puede ser su jefe; que no realizará la práctica en horas laborales y que no se le pagará por el proyecto.
                            </li>
                            <li>
                                El título de proyecto debe describir: ¿Qué va a desarrollar?, ¿Dónde lo va a realizar? y ¿En qué periodo lo va hacer?
                            </li>
                            <li>
                                El Estado actual del caso debe indicar en forma de prosa la problemática de la empresa.
                            </li>
                            <li>
                                El problema general y los problemas específicos se deben plantear en forma de pregunta, cuyas respuestas no sean SI o NO. Debe guardar relación con el título.
                            </li>
                            <li>
                                El detalle de las herramientas es una mención breve de las requeridas. Se debe describir aquellas que no sean de uso común.
                            </li>
                            <li>
                                Objetivo general y los objetivos específicos deben responder a los problemas. Deben iniciar con un infinitivo, que sería el único admitido dentro de todo el objetivo. No pueden llevar punto y seguido.
                            </li>
                            <li>
                                Los objetivos específicos deben ser 3 mínimo y máximo 5.
                            </li>
                            <li>
                                Los alcances responden a los objetivos específicos y representan el producto de los mismos.
                            </li>
                            <li>
                                Las limitaciones nos marcan el "terreno de juego" donde se desarrolla el proyecto, además de aquellos puntos que quedan fuera de cobertura.
                            </li>
                            <li>
                                Los puntos acá descritos le servirán para redactar el capítulo 1 del documento escrito, empero el tutor que se le designará tendrá la potestad de realizar modificaciones o mejoras para reescribir la información sin disminuir los alcances.
                            </li>
                        </ol>
                    </div>
                </div>
        </div>
        <div id="tfg" class="tab-pane fade">
            <div class="panel panel-default">
                <div class="panel-heading">Propuesta Proyecto TFG</div>
                <div class="panel-body">
                    <p>
                            Para plantear el Trabajo Final de Graduación, debe prestar atención a las siguientes recomendaciones que evitarán que su proyecto pueda ser rechazado:
                    </p>
                    <ol>
                        <li>
                            Debe ser un proyecto. Acorde a Project Management Institute (2000) un proyecto se define como: "...es un esfuerzo temporal acometido para crear un único servicio o producto. Temporal quiere decir que todo proyecto tiene un comienzo claro y un final claro. Único significa que el producto o servicio es diferente de alguna forma clara de todos los productos o servicios similares..."
                        </li>
                        <li>
                            Debe ser un proyecto para optar por un grado universitario de bachillerato. Por ende, propuestas de instalar una red o dar mantenimiento a equipos no son válidos ya que corresponden a nivel de técnico. 
                        </li>
                        <li>
                            El proyecto debe tener una duración mínima de 320 horas por persona.
                        </li>
                        <li>
                            La empresa en la que desea realizar la PES debe estar debidamente inscrita y tener cédula jurídica.
                        </li>
                        <li>
                            La empresa en la que desea realizar la PES no puede pertenecer a un familiar.
                        </li>
                        <li>
                            Si se desea realizar la PES en la empresa en la usted labora actualmente debe considerar: su tutor empresarial no puede ser su jefe; que no realizará la práctica en horas laborales y que no se le pagará por el proyecto.
                        </li>
                        <li>
                            El título de proyecto debe describir: ¿Qué va a desarrollar?, ¿Dónde lo va a realizar? y ¿En qué periodo lo va hacer?
                        </li>
                        <li>
                            El Estado actual del caso debe indicar en forma de prosa la problemática de la empresa.
                        </li>
                        <li>
                            El problema general y los problemas específicos se deben plantear en forma de pregunta, cuyas respuestas no sean SI o NO. Debe guardar relación con el título.
                        </li>
                        <li>
                            El detalle de las herramientas es una mención breve de las requeridas. Se debe describir aquellas que no sean de uso común.
                        </li>
                        <li>
                            Objetivo general y los objetivos específicos deben responder a los problemas. Deben iniciar con un infinitivo, que sería el único admitido dentro de todo el objetivo. No pueden llevar punto y seguido.
                        </li>
                        <li>
                            Los objetivos específicos deben ser 3 mínimo y máximo 5.
                        </li>
                        <li>
                            Los alcances responden a los objetivos específicos y representan el producto de los mismos.
                        </li>
                        <li>
                            Las limitaciones nos marcan el "terreno de juego" donde se desarrolla el proyecto, además de aquellos puntos que quedan fuera de cobertura.
                        </li>
                        <li>
                            Los puntos acá descritos le servirán para redactar el capítulo 1 del documento escrito, empero el tutor que se le designará tendrá la potestad de realizar modificaciones o mejoras para reescribir la información sin disminuir los alcances.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
