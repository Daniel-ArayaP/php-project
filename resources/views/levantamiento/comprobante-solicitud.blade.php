<div class="print" id="comprobante-levantamiento">
    {{-- comprobante de la solicitud de levantamiento. Este no se muestra en la pantalla para enviar 
        la solicitud, sin embargo el código si aparece dentro del HTML
    --}}
    <div class="container">
        <div class="col-xs-6">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo Universidad Latina de Costa Rica" style="width: 100%;">
        </div>

        <div class="col-xs-6 text-center">
            <h4>BOLETA DE SOLICITUD</h4>
            <h4>LEVANTAMIENTO DE REQUISITOS</h4>
        </div>
    </div>

    <div class="container">
        <hr>
    </div>

    <div class="container">
        <div class="col-xs-6">
            <p id="comp_sede">Sede donde cursa la carrera: ____________________</p>
            <p id="comp_estudiante_nombre">Nombre del estudiante: ____________________</p>
            <p id="comp_carrera">Carrera del estudiante: ____________________</p>
            <p id="comp_planes">Plan de estudios: ____________________</p>
        </div>
        <div class="col-xs-6">
            <p id="comp_cuatrimestre">Cuatrimestre: ____________________</p>
            <p id="comp_estudiante_carnet">Carnet: ____________________</p>
        </div>
    </div>

    <div class="container" style="margin-top:1rem;margin-bottom:1rem;">
        <div class="col-xs-10 col-xs-offset-1">
            <table class="tabla-cursos">
                <thead>
                    <tr>
                        <th class="fc">Materia que solicita matricular</th>
                        <th class="fc">Materia requisito pendiente</th>
                    </tr>
                </thead>
                <tbody id="cursos_solicitados">
                    <tr>
                        <td class="fc">1. Practica empresarial supervisada</td>
                        <td class="fc"></td>
                    </tr>
                    <tr>
                        <td class="fc">2. </td>
                        <td class="fc"></td>
                    </tr>
                </tbody>
            </table>
        </div>

            {{-- <table class="table table-bordered" id="tabla-cursos-solicitados">
                <thead>
                    <th>Materia que solicita matricular</th>
                    <th>Materia requisito pendiente</th>
                </thead>
                <tbody id="cursos_solicitados">
                    <tr>
                        <td>1. Practica empresarial</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td></td>
                    </tr>
                </tbody>
            </table> --}}
    </div>

    <div class="container" style="margin-top:1rem;margin-bottom:2rem;">
        <p id="motivo_solicitud">Motivo de la solicitud: </p>
    </div>

    <div class="container">
        <p>
            <b>
                Si el levantamiento de requisito es aprobado por la Dirección Académica, 
                el estudiante entiende y acepta las siguientes condiciones, 
                establecidas por la Universidad Latina:
            </b>
        </p>
        <ul>
            <li>
                La presente es una solicitud para el levantamiento de requisitos, 
                la cual debe ser justificada y documentada. 
                La decisión de aprobar dicha solicitud es potestad de la Universidad.
            </li>
            <li>
                Esta autorización aplica únicamente para el periodo y cursos indicados.
            </li>
            <li>
                El estudiante es consciente y responsable de eventuales inconvenientes que esa 
                situación le genere y acepta la responsabilidad de la carga académica que 
                esta solicitud implica, liberando de esta forma a la Universidad de toda 
                responsabilidad sobre ello.
            </li>
        </ul>
    </div>

    <div class="container" style="margin-top:2rem;">
        <div class="col-xs-6">
            <p>Firma del estudiante: ____________________</p>
        </div>
        <div class="col-xs-6">
            <p>Fecha: ____________________</p>
        </div>
    </div>

    <div class="container">
        <h2 class="text-center" style="background: darkgray;">
            PARA USO DE LA DIRECCIÓN ACADÉMICA
        </h2>
        <hr>
    </div>

    <div class="container">
        <p>
            Yo, Jose Antonio Remón Ramírez, Director Académico de la carrera arriba indicada, 
            atendiendo la solicitud del estudiante en mención, he analizado su historial académico, 
            así como las implicaciones académicas y carga de trabajo que esto implica. 
            De esta forma autorizo como excepción que se le permita matricular los cursos indicados, 
            en el entendido de que esto implica una carga académica de la cual he advertido al 
            estudiante y él acepta que es responsable.
        </p>
    </div>

    <div class="container" style="margin-top:1rem;margin-bottom:1rem;">
        <div class="col-xs-7">
            <table class="tabla-cursos">
                <thead>
                    <th>Materia que solicita matricular</th>
                </thead>
                <tbody id="tabla_aprobacion_cursos_solicitud">
                    <tr>
                        <td>
                            1. Practica empresarial supervisada
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2.
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-5">
            <h4 class="text-center sello">SELLO DE LA ESCUELA</h4>
        </div>
    </div>

    <div class="container">
        <p>Firma del director académico: ____________________</p>
        <p>Fecha de aprobación: ____________________</p>
    </div>

    <div class="container">
        <p>
            Recibido de registro: ____________________
        </p>
    </div>
</div>