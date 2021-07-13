@extends('layouts.app')

@section('content')
      <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                  <h3>Informacion del Objetivo</h3>
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
                <select name="objEP" id="objEP" class="form-control" disabled="true">

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
              <TEXTAREA class="form-control" ID="indicadores" NAME="indicadores" disabled="true"> {{$planEdit[0]->indicadores}}</TEXTAREA>
                </div>

           <div class="form-group">
              <label for="RESULTADOS">Resultados Esperados</label>
              <br>
              <TEXTAREA class="form-control" ID="RESULTADOS" NAME="RESULTADOS" disabled="true"> {{$planEdit[0]->resultado_esperado}}</TEXTAREA> 
              </div>

             <div class="form-group">
                  <label>Recursos</label>
                  <br>
              <TEXTAREA class="form-control" ID="RECURSOS" NAME="RECURSOS" disabled="true"> {{$planEdit[0]->recursos}}</TEXTAREA>
                </div>

                <div class="form-group">
                  <label>Encargado</label>
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
              <input id="FECHA_INICIO" name="FECHA_INICIO" type="date" readonly="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
              <br><br>
              <label for="FECHA_FIN">Fecha De Fin  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;</label>
              <input id="FECHA_FIN" name="FECHA_FIN" type="date" readonly="true">
            </div>
            <br>
            <div class="form-group">
                  <label>Estado Del Objetivo</label>
                  <br>
                <select name="estadoObj" id="estadoObj" class="form-control" disabled="true">

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

                                  <div class="table-responsive"; style="width:auto; height:150px; overflow:auto;">
            <table id="tblObservacion" class="table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Observaciones</th>
                </thead>
                @if(isset($objetivosEspecificos))
                    @foreach($objetivosEspecificos as $objetivo)
                <tr>

                    <td> {{$objetivo->descripcion}}</td>
                </tr>
                    @endforeach
                @else
                    
                <tr>
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
                  &nbsp;&nbsp;&nbsp;<button class="btn btn-danger" type="reset" align="right" onclick="goBack()">CANCELAR</button>
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

var planEditLista = [];

var tipoUsuario = 1;


window.onload = function() {



      encargadosArray = <?php echo json_encode($profesores,JSON_FORCE_OBJECT); ?>;
      planesLista = <?php echo json_encode($planes,JSON_FORCE_OBJECT); ?>;
      encargadosLista = <?php echo json_encode($encargadosObj,JSON_FORCE_OBJECT); ?>;
      planEditLista = <?php echo json_encode($planEdit,JSON_FORCE_OBJECT); ?>;
      colaboradorArray = <?php echo json_encode($encargadosObj,JSON_FORCE_OBJECT); ?>;
      observacionesArray = <?php echo json_encode($observacionesPlan,JSON_FORCE_OBJECT); ?>;


      console.log(planEditLista[0].fecha_inicio.toString().split(" ")[0]);
      cargarObjetivosPlan();

      document.getElementById('FECHA_INICIO').value=planEditLista[0].fecha_inicio.toString().split(" ")[0];
      document.getElementById('FECHA_FIN').value=planEditLista[0].fecha_final.toString().split(" ")[0];


    // cargarInterfazProfesor();

    // proyectoEditarId = <?php //echo $Proyecto->proyecto_investigacion_id; ?>;
    //  cargarObjetivosProyecto();
    cargarColaboradoresProyecto();
    cargarObservacionesProyecto();
    //       cargarDePropiedades();
      


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

            colaboradorArray2.push(new UsuarioObjetivo(colaboradorArray[MP].encargado_plan_proyecto_id, colaboradorArray[MP].id, colaboradorArray[MP].name, colaboradorArray[MP].objetivo_plan_proyecto_id, colaboradorArray[MP].plan_proyecto_id));
}


      }


      // document.getElementById('GENERAL').value = testVar;

  }


        var numP = Object.keys(colaboradorArray2).length;

  if(numP==0){


}else{

console.log(numP);
var objetivoPlanProyectoId = '<?php echo $planEdit[0]->objetivo_plan_proyecto_id; ?>';

     $('#tblColaborador').empty();
                $('#tblColaborador').append('<thead>' +
                    '<th>Encargado</th>' +
                '</thead>');

  for(MP=0; MP<=numP-1; MP++){

    if (colaboradorArray2[MP].objetivo_plan_proyecto_id==objetivoPlanProyectoId){

                      if (tipoUsuario==0){
                  //console.log(tipoUsuario);
                  //console.log("==**--")
                  $('#tblColaborador').append("<tr>"+
                   "<td>"+ colaboradorArray2[MP].name +"</td>"+
                
                "</tr>");
                }else{


                $('#tblColaborador').append("<tr>"+
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

  //console.log(numP);


  if(numP==0){


}else{

  
    $('#tblObservacion').empty();
        $('#tblObservacion').append('<thead>' +
            '<th>Observaciones</th>' +
        '</thead>');

  for(MP=0; MP<=numP-1; MP++){


    if(tipoUsuario==0){


      $('#tblObservacion').append("<tr>"+
                   "<td>"+ observacionesArray2[MP].observacion_objetivo_plan_descripcion +"</td>"+
                
                 "</tr>");


    }else{
        

        $('#tblObservacion').append("<tr>"+
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
                                      console.log(planesLista);
                                      console.log(encargadosLista);


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


function showPoblacion() {
bPreguntar = true;
var ID_SEDE=$('#sede').val();
var GRADO_CURSO=$('#gradoCarrera').val();
console.log(ID_SEDE);

   $.ajax({


                type:'get',
                url:'{{URL::to('showPobla/')}}',

                data:{'ID_SEDE': ID_SEDE, 'GRADO_CURSO': GRADO_CURSO},
                success:function(data){
                    console.log('success');

                    console.log(data[1]);

                    console.log(data.length);


           
                $('#tblData').empty();
                $('#tblData').append('<thead>' +
                    '<th>CURSO</th>' +
                    '<th>GRUPO</th>' +
                    '<th>DOCENTE</th>' +
                    '<th>ESTUDIANTE</th>' +
                    '<th>EMAIL ESTUDIANTE</th>' +

                '</thead>');

                 $.each(data, function(index, regenciesObj){
                  $('#tblData').append("<tr>"+
                    "<td>"+ regenciesObj.CURSO +"</td>"+
                    "<td>"+ regenciesObj.GRUPO +"</td>"+
                    "<td>"+ regenciesObj.DOCENTE +"</td>"+
                    "<td>"+ regenciesObj.ESTUDIANTE +"</td>"+
                    "<td>"+ regenciesObj.EMAIL_ESTUDIANTE +"</td>"+
                    "<td>"+
                         "<a href='"+ regenciesObj.idRegistroPoblacion +"/showE'><button class='btn btn-primary'>Mostrar</button></a>"+
                    "</td>"+
                "<td>"+
                
                "</tr>");
                 })

                },
                error:function(){

                }
            });

bPreguntar = false;
}


$("#ENCUESTA").on("change keyup", function() {
    isValid = isValidLicenseNo(this.value);
    if (isValid) {
        $(this).css( "border-color", "green" );
    } else {
        $(this).val($(this).val().slice(0,-1));
        $(this).css( "border-color", "red" );
    }
});


function isValidLicenseNo(text) {
    if(text.length < 2) return text.match(/(^[0-9]{0,1})$/);
    return text.match(/(^[0-9]{2}\d{0,6}$)/);
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

                console.log($('#txtObservacionP').val());

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

          console.log(plan_proyecto_id);
          console.log(observacionesArray2);

                $("#txtObservacionP").val("");

                var observacionParaGuardar = "";

          
                for(i=0; i<=observacionesArray2.length-1; i++){


                  observacionParaGuardar.trim();
                  observacionParaGuardar=observacionesArray2[i].observacion_objetivo_plan_descripcion;

                  console.log("<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                  "<button class='btn btn-success' type='button' onClick=editarObservacion('"+i+"')><span class='fa fa-edit'></span></button>"+
                  "</span>");
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

                  //console.log(desObj);
                  var observacionesArrayTemp = [];
                  console.log("===observacionesArray2==========*********//////////////////");
                  console.log(observacionesArray2.length);
                  console.log("=============*********//////////////////");

                  if (observacionesArray2.length<=1) {

                            console.log(observacionesArray2);
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
          console.log(observacionesArray2);
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
                      console.log(observacionesArray2);

                  }else{


                      console.log(observacionesArray2);
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
                      console.log("MMMMMMMMMMMMMMMMMMM");
                      console.log(observacionesArray2);

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



  console.log(observacionesArray2[observacionEditar].observacion_objetivo_plan_descripcion);
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

        console.log("========================");
        console.log(observacionesArray2[t].observacion_objetivo_plan_descripcion);


      if (observacionEdit==t) {


            console.log(observacionesArray2[t].observacion_objetivo_plan_descripcion);
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

          
          console.log("========================22");
          console.log(observacionesArray2[t].observacion_objetivo_plan_descripcion);

    



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



                var idUserADD = $('#encargado').val();
                var nameUserADD = $('#encargado option:selected').text();
                var plan_proyecto_id = <?php echo $proyecto->plan_proyecto_id; ?>;

                console.log(idUserADD);

                if (idUserADD==0){
                  alert("No se puede agregar un usuario sin Seleccionar!")
                }else{



                var obj = [];


            

                $('#tblColaborador').empty();
                $('#tblColaborador').append('<thead>' +
                  '<th></th>' +
                    '<th>Encargado</th>' +
                '</thead>');



          colaboradorArray2.push(new UsuarioObjetivo(0, idUserADD, nameUserADD, 0, plan_proyecto_id));

          console.log(colaboradorArray2[0].name);
          console.log(colaboradorArray2);



          
                for(i=0; i<=colaboradorArray2.length-1; i++){


                  console.log("<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                  "<button class='btn btn-success' type='button' onClick=editarObservacion('"+i+"')><span class='fa fa-edit'></span></button>"+
                  "</span>");
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

                  //console.log(desObj);
                  var colaboradorArrayTemp = [];
                  console.log("===colaboradorArray2==========*********//////////////////");
                  console.log(colaboradorArray2.length);
                  console.log("=============*********//////////////////");

                  if (colaboradorArray2.length<=1) {

                            console.log(colaboradorArray2);
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
          console.log(colaboradorArray2);
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
                      console.log(colaboradorArray2);

                  }else{


                      console.log(colaboradorArray2);
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
                      console.log("MMMMMMMMMMMMMMMMMMM");
                      console.log(colaboradorArray2);

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

console.log(objetivoEspId);
console.log(fechaInicio);
console.log(fechaFin);
console.log(indicadores);
console.log(resultadosEsperados);
console.log(recursos);
console.log(planTrabajoId);





                $.ajax({



                type:'get',
                url:'{{URL::to('modificarObjetivoPlan/')}}',

                data:{'objetivo_plan_proyecto_id': objetivoPlanProyectoId,'objetivo_proyecto_id': objetivoEspId, 'fecha_inicio': fechaInicio, 'fecha_final': fechaFin, 'indicadores': indicadores,
                      'resultado_esperado': resultadosEsperados, 'recursos': recursos, 'estado_objetivo_id': estadoObjetivo, 'plan_proyecto_id': planTrabajoId},
                success:function(data){

                                   
                      console.log('success420');


                              },
                error:function(){
                  
                }

            });



                if (Object.keys(colaboradorArray2).length==0){

                }else{


                 //for each para guardar todos los colaboradores
                //colaboradorArray2
                $.each(colaboradorArray2, function(index, colaboradorADD){


         

                $.ajax({


                type:'get',
                url:'{{URL::to('guardarEncargadoAsignado/')}}',

                data:{'encargado_plan_proyecto_id': encargadoId, 'objetivo_plan_proyecto_id': objetivoPlanProyectoId},
                success:function(data){
                    
                    //proceso de insercesion de datos
                    console.log("tt2");
                    
                    


                },
                error:function(){
                    
                }

               });

            




              });


              


                console.log(colaboradorArray);
                //console.log(observacionesArray2);

                var colaboradorDeleted = [];
                var colaboradorEncontrado=0;



            $.each(colaboradorArray, function(index, colaboradorSAVED){


              if (colaboradorSAVED.tipo_usuario_proyecto_id==2){


                $.each(colaboradorArray2, function(index, colaboradorSAVED2){

                  if (colaboradorSAVED2.usuario_proyecto_id!=0){

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

              }


            });

            console.log(colaboradorDeleted);


          $.each(colaboradorDeleted, function(index, colaboradorDEL){


                  $.ajax({


                      type:'get',
                      url:'{{URL::to('eliminarUsuarioAsignado/')}}',

                      data:{'encargado_plan_proyecto_id': colaboradorDEL, 'objetivo_plan_proyecto_id': objetivoPlanProyectoId},
                      success:function(data){
                          
                          //proceso de insercesion de datos
                          //console.log(data);
                          
                          


                      },
                      error:function(){
                          
                      }
                    });


            });




        }





                if (Object.keys(observacionesArray2).length==0){
                    console.log("MOP1");
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
                    console.log("tt3");
                    
                    


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
                    console.log("tt88");
                    
                    


                },
                error:function(){
                    
                }

               });


            }




              });



              


                //console.log(observacionesArray);
                //console.log(observacionesArray2);

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

            console.log(observacionDeleted);


          $.each(observacionDeleted, function(index, observacionDEL){


                $.ajax({


                  type:'get',
                  url:'{{URL::to('eliminarObservacionObjetivo/')}}',

                  data:{'observacion_objetivo_plan_id': observacionDEL},
                  success:function(data){
                      
                      //proceso de insercesion de datos
                      //console.log(data);
                      
                      


                  },
                  error:function(){
                      
                  }
                  });


            });




        }












         $.ajax();
         $.ajax();
         $.ajax();

          $.ajax(window.location.href = "/ModuloInvestigacionExtension/ModuloIE/Proyecto/"+proyectoInvestigacionId+"/PlanTrabajo/"+planTrabajoId+"/ObjetivosPlanTrabajo/");
                







}





</script>

      

@endsection


    
