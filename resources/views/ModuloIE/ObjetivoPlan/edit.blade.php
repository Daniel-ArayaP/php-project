@extends('layouts.app')

@section('content')
      <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                  <h3>Modificar Objetivo</h3>
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
                  <label>Objetivo Especifico</label>
                  <br>
                <select name="objEP" id="objEP" class="form-control">

                <option value="0">Seleccionar Objetivo</option>

                 @foreach($objetivosP as $objP)


                @if($objP->objetivo_proyecto_id==$planEdit[0]->objetivo_proyecto_id)
                <option value="{{$objP->objetivo_proyecto_id}}" selected="true">{{$objP->objetivo_proyecto_descripcion}}</option>
                @else
                <option value="{{$objP->objetivo_proyecto_id}}">{{$objP->objetivo_proyecto_descripcion}}</option>
                @endif

                @endforeach

                </select>


                </div>


                            <br>
              <div class="form-group">

                  <label>Indicadores</label>
                  <br>
              <TEXTAREA class="form-control" ID="indicadores" NAME="indicadores"> {{$planEdit[0]->indicadores}}</TEXTAREA>
                </div>

           <div class="form-group">
              <label for="RESULTADOS">Resultados Esperados</label>
              <br>
              <TEXTAREA class="form-control" ID="RESULTADOS" NAME="RESULTADOS"> {{$planEdit[0]->resultado_esperado}}</TEXTAREA>
              </div>

             <div class="form-group">
                  <label>Recursos</label>
                  <br>
              <TEXTAREA class="form-control" ID="RECURSOS" NAME="RECURSOS"> {{$planEdit[0]->recursos}}</TEXTAREA>
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
                @if($std->estado_objetivo_id==$planEdit[0]->estado_objetivo_id)
                <option value="{{$std->estado_objetivo_id}}" selected="true">{{$std->estado_objetivo_nombre}}</option>
                @else
                <option value="{{$std->estado_objetivo_id}}">{{$std->estado_objetivo_nombre}}</option>
                @endif
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
                  &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" align="right" onclick="validarParaModificar()">MODIFICAR OBJETIVO</button>




                  &nbsp;&nbsp;&nbsp;



                  <button class="btn btn-danger" type="reset" align="right" onclick="goBack()">CANCELAR</button>
             </div>


          </div>

<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

</div>

  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">

var bPreguntar = false;

var idU = 0;

var observacionesArray = [];

var observacionesArray2 = [];

var colaboradorArray = [];

var colaboradorArray2 = [];

var colaboradorArray3 = [];

var encargadosArray = [];


var planesLista = [];

var encargadosLista = [];

var planEditLista = [];

var tipoUsuario = 1;


window.onload = function() {



      encargadosArray = <?php echo json_encode($profesores,JSON_FORCE_OBJECT); ?>;
      planesLista = <?php echo json_encode($planes,JSON_FORCE_OBJECT); ?>;
      encargadosLista = <?php echo json_encode($encargadosObj,JSON_FORCE_OBJECT); ?>;
      planEditLista = <?php echo json_encode($planEdit,JSON_FORCE_OBJECT); ?>;
      colaboradorArray = <?php echo json_encode($encargadosObj,JSON_FORCE_OBJECT); ?>;
      observacionesArray = <?php echo json_encode($observacionesPlan,JSON_FORCE_OBJECT); ?>;
      colaboradorArray3 = <?php echo json_encode($encargadosObj2,JSON_FORCE_OBJECT); ?>;

      document.getElementById('btnModificarObservacion').disabled=true;
      document.getElementById('btnAtrasObservacion').disabled=true;

      cargarObjetivosPlan();

      document.getElementById('FECHA_INICIO').value=planEditLista[0].fecha_inicio.toString().split(" ")[0];
      document.getElementById('FECHA_FIN').value=planEditLista[0].fecha_final.toString().split(" ")[0];


    // cargarInterfazProfesor();

    // proyectoEditarId = <?php //echo $Proyecto->proyecto_investigacion_id; ?>;
    //  cargarObjetivosProyecto();
    cargarColaboradoresProyecto();
    cargarObservacionesProyecto();
    //       cargarDePropiedades();



        idU = <?php  echo Auth::user()->role_id; ?>;
        if( idU == 2){

          document.getElementById('objEP').disabled=true;
          document.getElementById('indicadores').disabled=true;
          document.getElementById('RECURSOS').disabled=true;
          document.getElementById('RESULTADOS').disabled=true;
          document.getElementById('btnBuscarColaborador').disabled=true;

          document.getElementById('FECHA_INICIO').disabled=true;
          document.getElementById('FECHA_FIN').disabled=true;
          document.getElementById('estadoObj').disabled=true;

        }



}



    window.onbeforeunload = preguntarAntesDeSalir;



    function preguntarAntesDeSalir()

    {

      if (bPreguntar)

        return "¿Seguro que quieres salir?";

    }


    function cargarColaboradoresProyecto(){

  var testVar = "";
  var numObj = Object.keys(colaboradorArray).length;
  var objetivoPlanProyectoId = '<?php echo $planEdit[0]->objetivo_plan_proyecto_id; ?>';



  if(numObj==0){



}else{



  for(MP=0; MP<=numObj-1; MP++){

    if (colaboradorArray[MP].objetivo_plan_proyecto_id==objetivoPlanProyectoId){

            colaboradorArray2.push(new UsuarioObjetivo(colaboradorArray[MP].objetivo_asignado_id, colaboradorArray[MP].encargado_plan_proyecto_id, colaboradorArray[MP].id, colaboradorArray[MP].name, colaboradorArray[MP].objetivo_plan_proyecto_id, colaboradorArray[MP].plan_proyecto_id, 0));


          }



      }


      // document.getElementById('GENERAL').value = testVar;

  }


        var numP = Object.keys(colaboradorArray2).length;

  if(numP==0){


}else{



     $('#tblColaborador').empty();
                $('#tblColaborador').append('<thead>' +
                    '<th></th>' +
                    '<th>Encargado</th>' +
                '</thead>');

  for(MP=0; MP<=numP-1; MP++){

                  if( colaboradorArray2[MP].toDelete == 0){

                               if( <?php  echo Auth::user()->role_id; ?> == 2){

                  $('#tblColaborador').append("<tr>"+
                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                  "<button disabled='true' class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                  "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                      "<li>"+
                      "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                          "<button type='button' class='btn btn-danger' onClick=eliminarUsuarioCol('"+MP+"')><span class='fa fa-trash-alt'></span></button>"+
                          "</span>"+
                      "</li>"+
                  "</ul>"+
              "</div>"+
                   "</td>"+
                   "<td>"+ colaboradorArray2[MP].name +"</td>"+

                "</tr>");
                }else{


                $('#tblColaborador').append("<tr>"+
                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                  "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                  "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                      "<li>"+
                      "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                          "<button type='button' class='btn btn-danger' onClick=eliminarUsuarioCol('"+MP+"')><span class='fa fa-trash-alt'></span></button>"+
                          "</span>"+
                      "</li>"+
                  "</ul>"+
              "</div>"+
                   "</td>"+
                   "<td>"+ colaboradorArray2[MP].name +"</td>"+

                "</tr>");


            }

          }







            }

}


}




function cargarObservacionesProyecto(){

  var testVar = "";
  var numObj = Object.keys(observacionesArray).length;

  if(numObj==0){

  }else{

    for(i=0; i<=numObj-1; i++){

        observacionesArray2.push(new observacionObjetivo(observacionesArray[i].observacion_objetivo_plan_id, observacionesArray[i].observacion_objetivo_plan_descripcion, observacionesArray[i].id, observacionesArray[i].name, observacionesArray[i].objetivo_plan_proyecto_id));

        }
  }


  var numP = Object.keys(observacionesArray2).length;


  if(numP==0){


}else{


    $('#tblObservacion').empty();
        $('#tblObservacion').append('<thead>' +
          '<th></th>' +
            '<th>Observaciones</th>' +
        '</thead>');

  for(MP=0; MP<=numP-1; MP++){


    if( <?php  echo Auth::user()->role_id; ?> == 2 && observacionesArray2[MP].observacion_objetivo_plan_id!=0){


      $('#tblObservacion').append("<tr>"+
                   "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                  "<button disabled='true' class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                  "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                      "<li>"+
                      "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                          "<button class='btn btn-success' onClick=editarObservacion('"+MP+"')><span class='fa fa-edit'></span></button>"+
                          "</span>"+
                          "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                          "<button class='btn btn-danger' onClick=eliminarObservacion('"+MP+"')><span class='fa fa-trash-alt'></span></button>"+
                          "</span>"+
                      "</li>"+
                  "</ul>"+
              "</div>"+
                   "</td>"+
                   "<td>"+ observacionesArray2[MP].observacion_objetivo_plan_descripcion +"</td>"+

                 "</tr>");


    }else{


        $('#tblObservacion').append("<tr>"+
                   "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                  "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                  "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                      "<li>"+
                      "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                          "<button class='btn btn-success' onClick=editarObservacion('"+MP+"')><span class='fa fa-edit'></span></button>"+
                          "</span>"+
                          "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                          "<button class='btn btn-danger' onClick=eliminarObservacion('"+MP+"')><span class='fa fa-trash-alt'></span></button>"+
                          "</span>"+
                      "</li>"+
                  "</ul>"+
              "</div>"+
                   "</td>"+
                   "<td>"+ observacionesArray2[MP].observacion_objetivo_plan_descripcion +"</td>"+

                 "</tr>");

    }




      }


      // document.getElementById('GENERAL').value = testVar;

  }


}


                   function cargarObjetivosPlan(){






                                      $('#tblObjetivosShow').empty();
                                      $('#tblObjetivosShow').append('<thead>' +
                                        '<th> Encargad@(s)</th>'+
                                        '<th> Objetivo Especifico</th>'+
                                        '<th> Fecha Inicio</th>'+
                                        '<th> Fecha Fin</th>'+
                                        '</thead>');

                                      var rowP4 = "";
                                      planTrabajoEnlistado = [];
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
                  alert("No se puede agregar una observacion vacia!")
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



                  if (observacionesArray2[i].observacion_objetivo_plan_id==0){



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


              }else{



                $('#tblObservacion').append("<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                  "<button disabled='true' class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
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



                  if (observacionesArray2[i].observacion_objetivo_plan_id==0){



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

              }else{


                $('#tblObservacion').append("<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button disabled='true' class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
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

      if (observacionesArray2[t].observacion_objetivo_plan_id==0){

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

      }else{

         $('#tblObservacion').append("<tr>"+
      "<td>"+
      "<div class='dropdown table-actions-dropdown'>"+
                                "<button disabled='true' class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
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

function UsuarioObjetivo(objetivo_asignado_id, encargado_plan_proyecto_id, user_id, name, objetivo_plan_proyecto_id, plan_proyecto_id, toDelete) {

  this.objetivo_asignado_id = objetivo_asignado_id;
  this.encargado_plan_proyecto_id = encargado_plan_proyecto_id;
  this.user_id = user_id;
  this.name = name;
  this.objetivo_plan_proyecto_id = objetivo_plan_proyecto_id;
  this.plan_proyecto_id = plan_proyecto_id;
  this.toDelete = toDelete;

}


var qtyEncargados = <?php echo $proyecto->cantidad_encargados; ?>;
var conQtyEncargados = Object.keys(colaboradorArray3).length;


    function cargarUsuarioCol()
                {



                var idUserADD = $('#encargado').val().split("-")[0];
                var nameUserADD = $('#encargado option:selected').text();
                var plan_proyecto_id = <?php echo $proyecto->plan_proyecto_id; ?>;
                var userFounded = 0;
                var userFounded2 = 0;
                var usuarioPermitido = 0;
                var loadData = 0;

              //  alert(idUserADD);
                if(Object.keys(colaboradorArray2).length==0){

                  userFounded = 2;
                }else{

                  $.each(colaboradorArray2, function(index, colaboradorADD){

                        alert(colaboradorADD.user_id);
                          if(colaboradorADD.toDelete==1 && colaboradorADD.user_id==idUserADD){
                            colaboradorADD.toDelete=0;
                            userFounded = 1;

                          }else if(colaboradorADD.toDelete==0 && colaboradorADD.user_id==idUserADD){
                            userFounded = 2;
                          }


                  });


                }


                  //alert(qtyEncargados);
                  //alert(Object.keys(colaboradorArray3).length);
                if(qtyEncargados==Object.keys(colaboradorArray3).length && userFounded==2){

                    userFounded=0;
                    usuarioPermitido = 1;

                }


                //alert(qtyEncargados);

                if (idUserADD==0){
                  alert("No se puede agregar un usuario sin Seleccionar!");
                }else if (usuarioPermitido == 0){
                  alert("No se puede agregar mas usuarios!");
                }else{



                var obj = [];



                if(userFounded==1){

                  conQtyEncargados = conQtyEncargados + 1;
                  loadData=1;
                }else if(userFounded==2){

                  alert("No se puede agregar un usuario ya agregado!");

                }else{

                  colaboradorArray2.push(new UsuarioObjetivo(0, $('#encargado').val().split("-")[1], idUserADD, nameUserADD, 0, plan_proyecto_id, 0));
                  conQtyEncargados = conQtyEncargados + 1;
                  loadData=1;
                }






                if(loadData==1){

                  $('#tblColaborador').empty();
                  $('#tblColaborador').append('<thead>' +
                    '<th></th>' +
                      '<th>Encargado</th>' +
                  '</thead>');



                  for(i=0; i<=colaboradorArray2.length-1; i++){


                    if( colaboradorArray2[i].toDelete == 0){


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

          }

                }


function eliminarUsuarioCol(desObj)
                {

                  var colaboradorArrayTemp = [];
                  var contDelete = 0;


                  $.each(colaboradorArray2, function(index, colaboradorADD){


                        if(colaboradorADD.toDelete==1){
                              contDelete = contDelete+1;
                        }


                  });



                  if (colaboradorArray2.length==(contDelete+1)) {




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

                            colaboradorArrayTemp.push(new UsuarioObjetivo(colaboradorArray2[i].objetivo_asignado_id, colaboradorArray2[i].encargado_plan_proyecto_id, colaboradorArray2[i].user_id, colaboradorArray2[i].name, colaboradorArray2[i].objetivo_plan_proyecto_id, colaboradorArray2[i].plan_proyecto_id, 1));
                            conQtyEncargados = conQtyEncargados - 1;

                          }else{

                              colaboradorArrayTemp.push(new UsuarioObjetivo(colaboradorArray2[i].objetivo_asignado_id, colaboradorArray2[i].encargado_plan_proyecto_id, colaboradorArray2[i].user_id, colaboradorArray2[i].name, colaboradorArray2[i].objetivo_plan_proyecto_id, colaboradorArray2[i].plan_proyecto_id, colaboradorArray2[i].toDelete));

                          }

                      }

                      colaboradorArray2 = [];

                      for(i=0; i<=colaboradorArrayTemp.length-1; i++){


                              colaboradorArray2.push(new UsuarioObjetivo(colaboradorArrayTemp[i].objetivo_asignado_id, colaboradorArrayTemp[i].encargado_plan_proyecto_id, colaboradorArrayTemp[i].user_id, colaboradorArrayTemp[i].name, colaboradorArrayTemp[i].objetivo_plan_proyecto_id, colaboradorArrayTemp[i].plan_proyecto_id, colaboradorArrayTemp[i].toDelete));


                      }


                      colaboradorArrayTemp = [];








                  }else{



                      for(i=0; i<=colaboradorArray2.length-1; i++){

                          if (i==desObj) {
colaboradorArrayTemp.push(new UsuarioObjetivo(colaboradorArray2[i].objetivo_asignado_id, colaboradorArray2[i].encargado_plan_proyecto_id, colaboradorArray2[i].user_id, colaboradorArray2[i].name, colaboradorArray2[i].objetivo_plan_proyecto_id, colaboradorArray2[i].plan_proyecto_id, 1));

                            conQtyEncargados = conQtyEncargados - 1;

                          }else{

                              colaboradorArrayTemp.push(new UsuarioObjetivo(colaboradorArray2[i].objetivo_asignado_id, colaboradorArray2[i].encargado_plan_proyecto_id, colaboradorArray2[i].user_id, colaboradorArray2[i].name, colaboradorArray2[i].objetivo_plan_proyecto_id, colaboradorArray2[i].plan_proyecto_id, colaboradorArray2[i].toDelete));

                          }

                      }

                      colaboradorArray2 = [];

                      for(i=0; i<=colaboradorArrayTemp.length-1; i++){


                              colaboradorArray2.push(new UsuarioObjetivo(colaboradorArrayTemp[i].objetivo_asignado_id, colaboradorArrayTemp[i].encargado_plan_proyecto_id, colaboradorArrayTemp[i].user_id, colaboradorArrayTemp[i].name, colaboradorArrayTemp[i].objetivo_plan_proyecto_id, colaboradorArrayTemp[i].plan_proyecto_id, colaboradorArrayTemp[i].toDelete));


                      }


                      colaboradorArrayTemp = [];


                       $('#tblColaborador').empty();
                $('#tblColaborador').append('<thead>' +
                  '<th></th>' +
                    '<th>Encargado</th>' +
                '</thead>');


                for(i=0; i<=colaboradorArray2.length-1; i++){


                      if( colaboradorArray2[i].toDelete == 0){

                $('#tblColaborador').append("<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' onClick=eliminarUsuarioCol("+i+")><span class='fa fa-trash-alt'></span></button>"+
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




                }







function goBack() {
    window.history.back();
}




function validarParaModificar() {


       if( idU == 3){

        modificarPlanTrabajoObservaciones();

      }else{

        modificarPlanTrabajo();

      }



}



function modificarPlanTrabajo() {



var objetivoEspId = $('#objEP').val();
var estadoObjetivo = $('#estadoObj').val();
var fechaInicio = $('#FECHA_INICIO').val();
var fechaFin = $('#FECHA_FIN').val();
var indicadores = $('#indicadores').val();
var resultadosEsperados = $('#RESULTADOS').val();
var recursos = $('#RECURSOS').val();
var planTrabajoId = '<?php echo $proyecto->plan_proyecto_id; ?>';
var proyectoInvestigacionId = '<?php echo $proyecto->proyecto_investigacion_id; ?>';
var objetivoPlanProyectoId = '<?php echo $planEdit[0]->objetivo_plan_proyecto_id; ?>';
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
                url:'{{URL::to('modificarObjetivoPlan/')}}',

                data:{'objetivo_plan_proyecto_id': objetivoPlanProyectoId,'objetivo_proyecto_id': objetivoEspId, 'fecha_inicio': fechaInicio, 'fecha_final': fechaFin, 'indicadores': indicadores,
                      'resultado_esperado': resultadosEsperados, 'recursos': recursos, 'estado_objetivo_id': estadoObjetivo, 'plan_proyecto_id': planTrabajoId},
                success:function(data){




                              },
                error:function(){

                }

            });



                if (Object.keys(colaboradorArray2).length==0){




                  if (Object.keys(colaboradorArray).length!=0){

                $.each(colaboradorArray, function(index, colaboradorADD2){


                $.ajax({


                type:'get',
                url:'{{URL::to('eliminarUsuarioAsignado/')}}',

                data:{'encargado_plan_proyecto_id': colaboradorADD2.encargado_plan_proyecto_id, 'objetivo_plan_proyecto_id': objetivoPlanProyectoId},
                success:function(data){






                },
                error:function(){

                }

               });






              });

              }






                }else{


                 //for each para guardar todos los colaboradores
                //colaboradorArray2
                $.each(colaboradorArray2, function(index, colaboradorADD){


                        if(colaboradorADD.objetivo_asignado_id==0){

                            $.ajax({


                              type:'get',
                              url:'{{URL::to('guardarEncargadoAsignado/')}}',

                              data:{'encargado_plan_proyecto_id': colaboradorADD.encargado_plan_proyecto_id, 'objetivo_plan_proyecto_id': objetivoPlanProyectoId},
                              success:function(data){





                              },
                              error:function(){

                              }

                             });

                        }



              });






                var colaboradorDeleted = [];
                var colaboradorEncontrado=0;



            $.each(colaboradorArray, function(index, colaboradorSAVED){




                $.each(colaboradorArray2, function(index, colaboradorSAVED2){

                  if (colaboradorSAVED2.objetivo_asignado_id!=0){

                    if (colaboradorSAVED2.encargado_plan_proyecto_id==colaboradorSAVED.encargado_plan_proyecto_id){

                    colaboradorEncontrado = 1;

                       }

                  }else{
                    colaboradorEncontrado = 1;
                  }



                });



                    if(colaboradorEncontrado==0){

                    colaboradorDeleted.push(colaboradorSAVED.encargado_plan_proyecto_id);

                  }else{

                    colaboradorEncontrado=0;

                  }




            });



          $.each(colaboradorDeleted, function(index, colaboradorDEL){


                  $.ajax({


                      type:'get',
                      url:'{{URL::to('eliminarUsuarioAsignado/')}}',

                      data:{'encargado_plan_proyecto_id': colaboradorDEL, 'objetivo_plan_proyecto_id': objetivoPlanProyectoId},
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


            if(observacionADD.observacion_objetivo_plan_id==0){

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

            }else{

                $.ajax({


                type:'get',
                url:'{{URL::to('modificarObservacionesObjetivo/')}}',

                data:{'observacion_objetivo_plan_id': observacionADD.observacion_objetivo_plan_id, 'observacion_objetivo_plan_descripcion': observacionADD.observacion_objetivo_plan_descripcion},
                success:function(data){

                    //proceso de insercesion de datos






                },
                error:function(){

                }

               });


            }




              });








                var observacionDeleted = [];
                var obsEncontrada=0;



            $.each(observacionesArray, function(index, observacionSAVED){


              $.each(observacionesArray2, function(index, observacionSAVED2){

                if (observacionSAVED2.observacion_objetivo_plan_id!=0){

                  if (observacionSAVED2.observacion_objetivo_plan_id==observacionSAVED.observacion_objetivo_plan_id){

                  obsEncontrada = 1;

                     }

                }else{
                  obsEncontrada = 1;
                }



              });



                  if(obsEncontrada==0){

                  observacionDeleted.push(observacionSAVED.observacion_objetivo_plan_id);

                }else{

                  obsEncontrada=0;

                }

            });




          $.each(observacionDeleted, function(index, observacionDEL){


                $.ajax({


                  type:'get',
                  url:'{{URL::to('eliminarObservacionObjetivo/')}}',

                  data:{'observacion_objetivo_plan_id': observacionDEL},
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


}





}




function modificarPlanTrabajoObservaciones() {



var objetivoEspId = $('#objEP').val();
var estadoObjetivo = $('#estadoObj').val();
var fechaInicio = $('#FECHA_INICIO').val();
var fechaFin = $('#FECHA_FIN').val();
var indicadores = $('#indicadores').val();
var resultadosEsperados = $('#RESULTADOS').val();
var recursos = $('#RECURSOS').val();
var planTrabajoId = '<?php echo $proyecto->plan_proyecto_id; ?>';
var proyectoInvestigacionId = '<?php echo $proyecto->proyecto_investigacion_id; ?>';
var objetivoPlanProyectoId = '<?php echo $planEdit[0]->objetivo_plan_proyecto_id; ?>';
var encargadoId = 0;





                if (Object.keys(observacionesArray2).length==0){


                }else{


                //for each para guardar todos los observaciones
                //observacionesArray
                $.each(observacionesArray2, function(index, observacionADD){


            if(observacionADD.observacion_objetivo_plan_id==0){

                $.ajax({


                type:'get',
                url:'{{URL::to('guardarObservacionesObjetivo/')}}',

                data:{'observacion_objetivo_plan_descripcion': observacionADD.observacion_objetivo_plan_descripcion, 'user_id': observacionADD.user_id, 'fecha': observacionADD.fecha, 'objetivo_plan_proyecto_id': objetivoPlanProyectoId},
                success:function(data){






                },
                error:function(){

                }

               });

            }else{

                $.ajax({


                type:'get',
                url:'{{URL::to('modificarObservacionesObjetivo/')}}',

                data:{'observacion_objetivo_plan_id': observacionADD.observacion_objetivo_plan_id, 'observacion_objetivo_plan_descripcion': observacionADD.observacion_objetivo_plan_descripcion},
                success:function(data){






                },
                error:function(){

                }

               });


            }




              });




                var observacionDeleted = [];
                var obsEncontrada=0;



            $.each(observacionesArray, function(index, observacionSAVED){


              $.each(observacionesArray2, function(index, observacionSAVED2){

                if (observacionSAVED2.observacion_objetivo_plan_id!=0){

                  if (observacionSAVED2.observacion_objetivo_plan_id==observacionSAVED.observacion_objetivo_plan_id){

                  obsEncontrada = 1;

                     }

                }else{
                  obsEncontrada = 1;
                }



              });



                  if(obsEncontrada==0){

                  observacionDeleted.push(observacionSAVED.observacion_objetivo_plan_id);

                }else{

                  obsEncontrada=0;

                }

            });


          $.each(observacionDeleted, function(index, observacionDEL){


                $.ajax({


                  type:'get',
                  url:'{{URL::to('eliminarObservacionObjetivo/')}}',

                  data:{'observacion_objetivo_plan_id': observacionDEL},
                  success:function(data){




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








}


function getURLFromBrowser() {

var URLactual = window.location;
var str = URLactual.toString();
var n = str.search("ModuloIE");
var imp = str.substring(0, n);
return imp;

}





</script>



@endsection
