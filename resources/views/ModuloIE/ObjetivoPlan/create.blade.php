@extends('layouts.app')

@section('content')
      <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                  <h3>Registrar Objetivo</h3>
                  <br>



                  @if (count($errors)>0)
                  <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                              <li>{{$error}}</li>
                        @endforeach
                        </ul>
                  </div>
                  @endif




               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
<br>


           <div class="form-group">
                  <label>Objetivos EspecificoSSSS</label>
                  <br>
                <select name="objEP" id="objEP" class="form-control">

                <option value="0">Seleccionar Objetivo</option>

                 @foreach($objetivosP as $objP)
                 @if($objP->objetivo_general==0)
                <option value="{{$objP->objetivo_proyecto_id}}">{{$objP->objetivo_proyecto_descripcion}}</option>
                @endif
                @endforeach

                </select>


                </div>


                            <br>
              <div class="form-group">

                  <label>Indicadores</label>
                  <br>
              <TEXTAREA class="form-control" ID="indicadores" NAME="indicadores"> </TEXTAREA>
                </div>

           <div class="form-group">
              <label for="RESULTADOS">Resultados Esperados</label>
              <br>
              <TEXTAREA class="form-control" ID="RESULTADOS" NAME="RESULTADOS"> </TEXTAREA>
              </div>

             <div class="form-group">
                  <label>Recursos</label>
                  <br>
              <TEXTAREA class="form-control" ID="RECURSOS" NAME="RECURSOS"> </TEXTAREA>
                </div>

                <div class="form-group">
                  <label>Encargado</label>

              <p>

                <a href="" data-target="#modal-BuscarObjetivo" data-toggle="modal"><button id="btnBuscarColaborador" name="btnBuscarColaborador" class="btn btn-primary btn-block"><span class="fa fa-search"></span></button></a>
                @include('ModuloIE.ObjetivoPlan.modalBuscarEncargado')
              </p>


              <div class="table-responsive"; style="width:auto; height:150px; overflow:auto;">
            <table id="tblColaborador" class="table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th></th>
                    <th>Encargado</th>
                </thead>
                @if(isset($objetivosEspecificos))
                    @foreach($objetivosEspecificos as $objetivo)
                <tr>
                  <td>
             <div class="dropdown table-actions-dropdown">
              <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></button>
              <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
                    <a href="" data-target="#modal-delete-" data-toggle="modal" disabled="true"><button class="btn btn-danger" disabled="true"><span class='fa fa-trash-alt'></span></button></a>
                  </span>
              </ul>
         </div>

    </td>
                    <td> {{$objetivo->descripcion}}</td>
                </tr>


                    @endforeach
                @else

                <tr>
                  <td>
             <div class="dropdown table-actions-dropdown">
              <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></button>
              <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
                    <a href="" data-target="#modal-delete-" data-toggle="modal" disabled="true"><button class="btn btn-danger" disabled="true"><span class='fa fa-trash-alt'></span></button></a>
                  </span>
              </ul>
         </div>

    </td>
                    <td> Sin Encargado Agregado</td>
                </tr>

                @endif
            </table>
             </div>
           </div>




                </div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">



                <div class="form-group">
                  <br><br>
              <label for="FECHA_INICIO" float="left">Fecha De Inicio  &nbsp;&nbsp;&nbsp;</label>
              <input id="FECHA_INICIO" name="FECHA_INICIO" type="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
              <br><br>
              <label for="FECHA_FIN">Fecha De Fin  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;</label>
              <input id="FECHA_FIN" name="FECHA_FIN" type="date">
            </div>
            <br>
            <div class="form-group">
                  <label>Estado Del Objetivo</label>
                  <br>
                <select name="estadoObj" id="estadoObj" class="form-control">

                <option value="0">Estado Del Objetivo</option>

                 @foreach($estado as $std)
                <option value="{{$std->estado_objetivo_id}}">{{$std->estado_objetivo_nombre}}</option>
                @endforeach


                </select>


                </div>


<div class="form-group">

                  <label>Observaciones</label>
                  <br>
              <p><TEXTAREA class="form-control" id="txtObservacionP" name="txtObservacionP" placeholder="Ingrese Observacion. . . "> </TEXTAREA><br>
                <a><button id="btnAgregarObservacion" name="btnAgregarObservacion" class="btn btn-primary" onClick=cargarObservacion() hidden="true"><span class="fa fa-plus"></span></button></a>
                    <a><button id="btnModificarObservacion" name="btnAgregarObservacion" class="btn btn-success" onClick=modificarObservacion()><span class="fa fa-edit"></span></button></a>
                    <a><button id="btnAtrasObservacion" name="btnAgregarObservacion" class="btn btn-danger" onClick=atrasObservacion()><span class="fa fa-arrow-left"></span></button></a></p>

                                  <div class="table-responsive"; style="width:auto; height:150px; overflow:auto;">
            <table id="tblObservacion" class="table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th></th>
                    <th>Observaciones</th>
                </thead>
                @if(isset($objetivosEspecificos))
                    @foreach($objetivosEspecificos as $objetivo)
                <tr>
                   <td>
             <div class="dropdown table-actions-dropdown">
              <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></button>
              <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Editar">
                    <a href="#"><button class="btn btn-success"><span class='fa fa-edit' disabled="true"></span></button></a>
                  </span>

                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
                    <a href="" data-target="#modal-delete-" data-toggle="modal" disabled="true"><button class="btn btn-danger"><span class='fa fa-trash-alt'></span></button></a>
                  </span>
              </ul>
         </div>

    </td>
                    <td> {{$objetivo->descripcion}}</td>
                </tr>
                    @endforeach
                @else

                <tr>
                   <td>
             <div class="dropdown table-actions-dropdown">
              <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></button>
              <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Editar">
                    <a href="#"><button class="btn btn-success"  disabled="true"><span class='fa fa-edit' disabled="true"></span></button></a>
                  </span>

                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
                    <a href="" data-target="#modal-delete-" data-toggle="modal" disabled="true"><button class="btn btn-danger" disabled="true"><span class='fa fa-trash-alt'></span></button></a>
                  </span>
              </ul>
         </div>

    </td>
                    <td> Sin Observaciones Agregadas</td>
                </tr>

                @endif
            </table>
             </div>


                </div>


            </div>







</div>


<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
              <br><br><br>
<h3> Proyecto:   &nbsp;&nbsp;&nbsp;&nbsp; {{ $proyecto->nombre_proyecto}}</h3>

<br>

<h3>  Plan de Trabajo:   &nbsp;&nbsp;&nbsp;&nbsp; {{ $proyecto->plan_proyecto_nombre}}  /   {{ $proyecto->periodo}} </h3>
<br><br>
                    <div class="table-responsive";>
                      <label>Listado de Objetivos</label>
                      <br><br>
            <table id="tblObjetivosShow" class="table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Encargad@(s)</th>
                    <th>Objetivo Especifico</th>
                    <th>Fecha De Inicio</th>
                    <th>Fecha De Fin</th>
                </thead>


                <tr>
                    <td> Prueba</td>
                    <td> Prueba</td>
                    <td> Prueba</td>
                    <td> Prueba</td>
                </tr>
                <tr>
                    <td> Prueba</td>
                    <td> Prueba</td>
                    <td> Prueba</td>
                    <td> Prueba</td>
                </tr>
                <tr>
                    <td> Prueba</td>
                    <td> Prueba</td>
                    <td> Prueba</td>
                    <td> Prueba</td>
                </tr>
                <tr>
                    <td> Prueba</td>
                    <td> Prueba</td>
                    <td> Prueba</td>
                    <td> Prueba</td>
                </tr>
            </table>
             </div>
            </div>
</div>

<div class="row">


<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                     <div class="form-group" align="center">
                  &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" align="right" onclick="registrarPlanTrabajo()">GUADAR OBJETIVO</button>
                  <button class="btn btn-danger" type="reset" align="right" onclick="goBack()">CANCELAR</button>
             </div>
          </div>

<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

</div>

  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">

var bPreguntar = false;
var observacionesArray = [];

var observacionesArray2 = [];

var colaboradorArray = [];

var colaboradorArray2 = [];

var encargadosArray = [];


var planesLista = [];

var encargadosLista = [];


window.onload = function() {



      encargadosArray = <?php echo json_encode($profesores,JSON_FORCE_OBJECT); ?>;
      document.getElementById('btnModificarObservacion').disabled=true;
      document.getElementById('btnAtrasObservacion').disabled=true;
      planesLista = <?php echo json_encode($planes,JSON_FORCE_OBJECT); ?>;
      encargadosLista = <?php echo json_encode($encargadosObj,JSON_FORCE_OBJECT); ?>;
      cargarObjetivosPlan();
    // cargarInterfazProfesor();

    // proyectoEditarId = <?php //echo $Proyecto->proyecto_investigacion_id; ?>;
    //  cargarObjetivosProyecto();
    //   cargarColaboradoresProyecto();
    //   cargarObservacionesProyecto();
    //       cargarDePropiedades();



}



    window.onbeforeunload = preguntarAntesDeSalir;



    function preguntarAntesDeSalir()

    {

      if (bPreguntar)

        return "¿buenooo , estas Seguro que quieres salir?";

    }


                   function cargarObjetivosPlan(){

                            var pId  = <?php echo $proyecto->plan_proyecto_id; ?>;





                                      $('#tblObjetivosShow').empty();
                                      $('#tblObjetivosShow').append('<thead>' +
                                        '<th> Encargad@(s)</th>'+
                                        '<th> Objetivo Especifico</th>'+
                                        '<th> Fecha Inicio</th>'+
                                        '<th> Fecha Fin</th>'+
                                        '</thead>');

                                      var rowP4 = "";

                                      var encargadosName = "";


                                      $.each(planesLista, function(index, ObjetivoPlanFind){


                                          $.each(encargadosLista, function(index, userFIND){

                                            if (ObjetivoPlanFind.objetivo_plan_proyecto_id==userFIND.objetivo_plan_proyecto_id){

                                              if(encargadosName==""){
                                                encargadosName = userFIND.name + "; ";
                                              }else{
                                                encargadosName = encargadosName + userFIND.name + "; ";
                                              }

                                            }

                                          });


                                          if(encargadosName==""){

                                            encargadosName = "Sin Asignar";

                                          }


                                          var rowP = "<tr>"+
                                          "<td>"+ encargadosName +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.objetivo_proyecto_descripcion +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.fecha_inicio.toString().split(" ")[0] +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.fecha_final.toString().split(" ")[0] +"</td>";
                                           rowP4 += rowP;


                                            $('#tblObjetivosShow').append(rowP4 +
                                              "</tr>");


                                             rowP4="";
                                             encargadosName="";

                                      });




                }


/*

Seccion Observaciones


*/



function observacionObjetivo(observacion_objetivo_plan_id, observacion_objetivo_plan_descripcion, user_id, fecha, objetivo_plan_proyecto_id) {
  this.observacion_objetivo_plan_id = observacion_objetivo_plan_id;
  this.observacion_objetivo_plan_descripcion = observacion_objetivo_plan_descripcion;
  this.user_id = user_id;
  this.fecha = fecha;
  this.objetivo_plan_proyecto_id = objetivo_plan_proyecto_id;
}

    function cargarObservacion()
                {



                var observacionDescripcion = $('#txtObservacionP').val();
                var plan_proyecto_id = <?php echo $proyecto->plan_proyecto_id; ?>;



                if (observacionDescripcion.trim()==""){
                  alert("Cuidado!!!!!!!!!!! No se puede agregar una observacion vacia!")
                }else{



                var obj = [];




                $('#tblObservacion').empty();
                $('#tblObservacion').append('<thead>' +
                  '<th></th>' +
                    '<th>Observacion</th>' +
                '</thead>');

                var objetivoDescripcion = $('#txtObservacionP').val();




          observacionesArray2.push(new observacionObjetivo(0, observacionDescripcion, 1, Date(Date.now()), 0));



                $("#txtObservacionP").val("");

                var observacionParaGuardar = "";


                for(i=0; i<=observacionesArray2.length-1; i++){


                  observacionParaGuardar.trim();
                  observacionParaGuardar=observacionesArray2[i].observacion_objetivo_plan_descripcion;


                $('#tblObservacion').append("<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                  "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                  "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                  "<li>"+
                  "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                  "<button class='btn btn-success' type='button' onClick=editarObservacion('"+i+"')><span class='fa fa-edit'></span></button>"+
                  "</span>"+
                  "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                  "<button class='btn btn-danger'  type='button' onClick=eliminarObservacion('"+i+"')><span class='fa fa-trash-alt'></span></button>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+
                    "<td>"+ observacionesArray2[i].observacion_objetivo_plan_descripcion +"</td>"+
                "<td>"+

                "</tr>");




              }

          }

                }


function eliminarObservacion(desObj)
                {

                
                  var observacionesArrayTemp = [];


                  if (observacionesArray2.length<=1) {

                        $('#tblObservacion').empty();
                $('#tblObservacion').append('<thead>' +
                  '<th></th>' +
                    '<th>Observacion</th>' +
                '</thead>');

                $('#tblObservacion').append("<tr>"+
                  "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<button class='btn btn-success' type='button' disabled><span class='fa fa-edit'></span></button>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' disabled><span class='fa fa-trash-alt'></span></button>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+
                    "<td> Sin Observaciones Agregadas</td>"+
                "<td>"+

                "</tr>");

                      for(i=0; i<=observacionesArray2.length-1; i++){

                          if (i==desObj) {

                          }else{

                              observacionesArrayTemp.push(new observacionObjetivo(observacionesArray2[i].observacion_objetivo_plan_id, observacionesArray2[i].observacion_objetivo_plan_descripcion, observacionesArray2[i].user_id, observacionesArray2[i].fecha, observacionesArray2[i].objetivo_plan_proyecto_id));

                          }

                      }

                      observacionesArray2 = [];

                      for(i=0; i<=observacionesArrayTemp.length-1; i++){


                              observacionesArray2.push(new observacionObjetivo(observacionesArrayTemp[i].observacion_objetivo_plan_id, observacionesArrayTemp[i].observacion_objetivo_plan_descripcion, observacionesArrayTemp[i].user_id, observacionesArrayTemp[i].fecha, observacionesArrayTemp[i].objetivo_plan_proyecto_id));


                      }


                      observacionesArrayTemp = [];


                  }else{


                      for(i=0; i<=observacionesArray2.length-1; i++){

                          if (i==desObj) {

                          }else{

                              observacionesArrayTemp.push(new observacionObjetivo(observacionesArray2[i].observacion_objetivo_plan_id, observacionesArray2[i].observacion_objetivo_plan_descripcion, observacionesArray2[i].user_id, observacionesArray2[i].fecha, observacionesArray2[i].objetivo_plan_proyecto_id));

                          }

                      }

                      observacionesArray2 = [];

                      for(i=0; i<=observacionesArrayTemp.length-1; i++){


                              observacionesArray2.push(new observacionObjetivo(observacionesArrayTemp[i].observacion_objetivo_plan_id, observacionesArrayTemp[i].observacion_objetivo_plan_descripcion, observacionesArrayTemp[i].user_id, observacionesArrayTemp[i].fecha, observacionesArrayTemp[i].objetivo_plan_proyecto_id));


                      }


                      observacionesArrayTemp = [];


                       $('#tblObservacion').empty();
                $('#tblObservacion').append('<thead>' +
                  '<th></th>' +
                    '<th>Observacion</th>' +
                '</thead>');


                for(i=0; i<=observacionesArray2.length-1; i++){



                $('#tblObservacion').append("<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<button class='btn btn-success' type='button' onClick=editarObservacion('"+i+"')><span class='fa fa-edit'></span></button>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' onClick=eliminarObservacion('"+i+"')><span class='fa fa-trash-alt'></span></button>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+
                    "<td>"+ observacionesArray2[i].observacion_objetivo_plan_descripcion +"</td>"+

                "</tr>");



          }

                  }




                }


                var editandoObservacion = 0;
                var observacionEdit = 0;

function editarObservacion(observacionEditar){

  if (editandoObservacion == 0){

observacionEdit = observacionEditar;
document.getElementById('btnAgregarObservacion').disabled=true;
document.getElementById('btnModificarObservacion').disabled=false;
document.getElementById('btnAtrasObservacion').disabled=false;
document.getElementById('tblObservacion').disabled=true;
         $('tblObservacion').prop('disabled', true);



  observacionEditando = observacionesArray2[observacionEditar].observacion_objetivo_plan_descripcion;
  $("#txtObservacionP").val(observacionEditando);
    editandoObservacion = 1;

}else{
  alert("No se puede modificar estar observacion hasta que termine de editar la actual!");
}

}

function modificarObservacion(){


  var observacionParaGuardar = "";


  var observacionDescripcion2 = $('#txtObservacionP').val();
    $('#tblObservacion').empty();
    $('#tblObservacion').append('<thead>' +
      '<th></th>' +
        '<th>Observacion</th>' +
    '</thead>');

      for(t=0; t<=observacionesArray2.length-1; t++){




      if (observacionEdit==t) {


            observacionesArray2[t].observacion_objetivo_plan_descripcion = observacionDescripcion2;


      }




      observacionParaGuardar = observacionesArray2[t].observacion_objetivo_plan_descripcion;



         $('#tblObservacion').append("<tr>"+
      "<td>"+
      "<div class='dropdown table-actions-dropdown'>"+
                                "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                    "<li>"+
                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                        "<button class='btn btn-success' type='button' onClick=editarObservacion('"+t+"')><span class='fa fa-edit'></span></button>"+
                                        "</span>"+
                                        "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                        "<button class='btn btn-danger'  type='button' onClick=eliminarObservacion('"+t+"')><span class='fa fa-trash-alt'></span></button>"+
                                        "</span>"+
                                    "</li>"+
                                "</ul>"+
                            "</div>"+
       "</td>"+
       "<td>"+ observacionesArray2[t].observacion_objetivo_plan_descripcion +"</td>"+

     "</tr>");





  }

  editandoObservacion = 0;
  observacionEdit = 0;
  document.getElementById('btnAgregarObservacion').disabled=false;
  document.getElementById('btnModificarObservacion').disabled=true;
  document.getElementById('btnAtrasObservacion').disabled=true;
  $("#txtObservacionP").val("");
  observacionEditando = "";

}

function atrasObservacion(){

document.getElementById('btnAgregarObservacion').disabled=false;
document.getElementById('btnModificarObservacion').disabled=true;
document.getElementById('btnAtrasObservacion').disabled=true;
$("#txtObservacionP").val("");
observacionEditando = "";
editandoObservacion = 0;
observacionEdit = 0;

}



/*

Seccion Usuario Proyecto: Colaborador


*/

function UsuarioObjetivo(encargado_plan_proyecto_id, user_id, name, objetivo_plan_proyecto_id, plan_proyecto_id) {

  this.encargado_plan_proyecto_id = encargado_plan_proyecto_id;
  this.user_id = user_id;
  this.name = name;
  this.objetivo_plan_proyecto_id = objetivo_plan_proyecto_id;
  this.plan_proyecto_id = plan_proyecto_id;

}


    function cargarUsuarioCol()
                {



                var idUserADD = $('#encargado').val().split("-")[0];
                var nameUserADD = $('#encargado option:selected').text();
                var plan_proyecto_id = <?php echo $proyecto->plan_proyecto_id; ?>;



                if (idUserADD==0){
                  alert("No se puede agregar un usuario sin Seleccionar!")
                }else{



                var obj = [];




                $('#tblColaborador').empty();
                $('#tblColaborador').append('<thead>' +
                  '<th></th>' +
                    '<th>Colaborador</th>' +
                '</thead>');



          colaboradorArray2.push(new UsuarioObjetivo($('#encargado').val().split("-")[1], idUserADD, nameUserADD, 0, plan_proyecto_id));




                for(i=0; i<=colaboradorArray2.length-1; i++){


                $('#tblColaborador').append("<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                  "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                  "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                  "<li>"+
                  "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                  "<button class='btn btn-danger'  type='button' onClick=eliminarUsuarioCol('"+i+"')><span class='fa fa-trash-alt'></span></button>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+
                    "<td>"+ colaboradorArray2[i].name +"</td>"+
                "<td>"+

                "</tr>");


                $("#btnAtrasModal").click();


              }

          }

                }


function eliminarUsuarioCol(desObj)
                {


                  var colaboradorArrayTemp = [];


                  if (colaboradorArray2.length<=1) {

                        $('#tblColaborador').empty();
                $('#tblColaborador').append('<thead>' +
                  '<th></th>' +
                    '<th>Encargado</th>' +
                '</thead>');

                $('#tblColaborador').append("<tr>"+
                  "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' disabled><span class='fa fa-trash-alt'></span></button>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+
                    "<td> Sin Encargado Agregado</td>"+
                "<td>"+

                "</tr>");

                      for(i=0; i<=colaboradorArray2.length-1; i++){

                          if (i==desObj) {

                          }else{

                              colaboradorArrayTemp.push(new UsuarioObjetivo(colaboradorArray2[i].encargado_plan_proyecto_id, colaboradorArray2[i].user_id, colaboradorArray2[i].name, colaboradorArray2[i].objetivo_plan_proyecto_id, colaboradorArray2[i].plan_proyecto_id));

                          }

                      }

                      colaboradorArray2 = [];

                      for(i=0; i<=colaboradorArrayTemp.length-1; i++){


                              colaboradorArray2.push(new UsuarioObjetivo(colaboradorArrayTemp[i].encargado_plan_proyecto_id, colaboradorArrayTemp[i].user_id, colaboradorArrayTemp[i].name, colaboradorArrayTemp[i].objetivo_plan_proyecto_id, colaboradorArrayTemp[i].plan_proyecto_id));


                      }


                      colaboradorArrayTemp = [];


                  }else{


                      for(i=0; i<=colaboradorArray2.length-1; i++){

                          if (i==desObj) {

                          }else{

                              colaboradorArrayTemp.push(new UsuarioObjetivo(colaboradorArray2[i].encargado_plan_proyecto_id, colaboradorArray2[i].user_id, colaboradorArray2[i].name, colaboradorArray2[i].objetivo_plan_proyecto_id, colaboradorArray2[i].plan_proyecto_id));

                          }

                      }

                      colaboradorArray2 = [];

                      for(i=0; i<=colaboradorArrayTemp.length-1; i++){


                              colaboradorArray2.push(new UsuarioObjetivo(colaboradorArrayTemp[i].encargado_plan_proyecto_id, colaboradorArrayTemp[i].user_id, colaboradorArrayTemp[i].name, colaboradorArrayTemp[i].objetivo_plan_proyecto_id, colaboradorArrayTemp[i].plan_proyecto_id));


                      }


                      colaboradorArrayTemp = [];


                       $('#tblColaborador').empty();
                $('#tblColaborador').append('<thead>' +
                  '<th></th>' +
                    '<th>Encargado</th>' +
                '</thead>');


                for(i=0; i<=colaboradorArray2.length-1; i++){



                $('#tblColaborador').append("<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' onClick=eliminarUsuarioCol('"+i+"')><span class='fa fa-trash-alt'></span></button>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+
                    "<td>"+ colaboradorArray2[i].name +"</td>"+

                "</tr>");



          }

                  }




                }






function goBack() {
    window.history.back();
}



function registrarPlanTrabajo() {



var objetivoEspId = $('#objEP').val();
var estadoObjetivo = $('#estadoObj').val();
var fechaInicio = $('#FECHA_INICIO').val();
var fechaFin = $('#FECHA_FIN').val();
var indicadores = $('#indicadores').val();
var resultadosEsperados = $('#RESULTADOS').val();
var recursos = $('#RECURSOS').val();
var planTrabajoId = '<?php echo $proyecto->plan_proyecto_id; ?>';
var proyectoInvestigacionId = '<?php echo $proyecto->proyecto_investigacion_id; ?>';
var objetivoPlanProyectoId = 0;
var encargadoId = 0;




              if(parseInt(objetivoEspId)==0){
                alert("Seleccionar un objetivo especifico del proyecto!");
              }else if(parseInt(estadoObjetivo)==0){
                alert("Seleccionar un estado del objetivo!");
              }else if(indicadores===""){
                alert("Ingrese los indicadores del objetivo!");
              }else if(resultadosEsperados===""){
                alert("Ingrese los resultados esperados del objetivo!");
              }else if(recursos===""){
                alert("Ingrese los recursos del objetivo!");
              }else if(fechaInicio===""){
                alert("Seleccionar fecha de inicio del objetivo!");
              }else if(fechaFin===""){
                alert("Seleccionar fecha fin del objetivo!");
              }else{





                $.ajax({



                type:'get',
                url:'{{URL::to('guardarObjetivoPlan/')}}',

                data:{'objetivo_proyecto_id': objetivoEspId, 'fecha_inicio': fechaInicio, 'fecha_final': fechaFin, 'indicadores': indicadores,
                      'resultado_esperado': resultadosEsperados, 'recursos': recursos, 'estado_objetivo_id': estadoObjetivo, 'plan_proyecto_id': planTrabajoId},
                success:function(data){


                      objetivoPlanProyectoId = data.objetivoInfo[0].objetivo_plan_proyecto_id;


               if (Object.keys(colaboradorArray2).length==0){

                }else{


                 //for each para guardar todos los colaboradores
                //colaboradorArray2
                $.each(colaboradorArray2, function(index, colaboradorADD){


                $.ajax({


                type:'get',
                url:'{{URL::to('guardarEncargadoAsignado/')}}',

                data:{'encargado_plan_proyecto_id': colaboradorADD.encargado_plan_proyecto_id, 'objetivo_plan_proyecto_id': objetivoPlanProyectoId},
                success:function(data){

                    //proceso de insercesion de datos





                },
                error:function(){

                }

               });







              });






              }





                if (Object.keys(observacionesArray2).length==0){

                }else{


                //for each para guardar todos los observaciones
                //observacionesArray
                $.each(observacionesArray2, function(index, observacionADD){





                $.ajax({


                type:'get',
                url:'{{URL::to('guardarObservacionesObjetivo/')}}',

                data:{'observacion_objetivo_plan_descripcion': observacionADD.observacion_objetivo_plan_descripcion, 'user_id': observacionADD.user_id, 'fecha': observacionADD.fecha, 'objetivo_plan_proyecto_id': objetivoPlanProyectoId},
                success:function(data){

                    //proceso de insercesion de datos





                },
                error:function(){

                }

               });


              });


              }

         $.ajax();
         $.ajax();
         $.ajax();

          $.ajax(window.location = getURLFromBrowser()+"ModuloIE/Proyecto/"+proyectoInvestigacionId+"/PlanTrabajo/"+planTrabajoId+"/ObjetivosPlanTrabajo");


                },
                error:function(){

                }

            });

}



}





</script>



@endsection
