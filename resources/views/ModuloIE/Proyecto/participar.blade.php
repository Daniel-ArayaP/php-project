@extends('layouts.app')

@section('content')

<?php

$objetivos=array("Sin Objetivos");
//array_push($objetivos, "Objetivo 2");
$clientes[]=array("nombre" => "Norma", "edad" => "20");
$clientes[]=array("nombre" => "Martha", "edad" => "18");
$clientes[]=array("nombre" => "Juan", "edad" => "23");
$clientes[]=array("nombre" => "Mateo", "edad" => "22");
$clientes[]=array("nombre" => "Marcos", "edad" => "26");
array_push($clientes, ["nombre" => "Teresa", "edad" => "36"]);
$objJason=json_encode($clientes);

 ?>


      <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <h3>Informacion del Proyecto</h3>
                  @if (count($errors)>0)
                  <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                              <li>{{$error}}</li>
                        @endforeach
                        </ul>
                  </div>
                  @endif

               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">



           <div class="form-group">
                  <label>Sede</label>
                  <br>
                <select name="sedeProyecto" id="sedeProyecto" class="form-control" readonly="true">

                <option value="0">Seleccionar Sede</option>

                 @foreach($sedes as $sede)

                <option value="{{$sede->id_sedes}}" selected>{{$sede->nombre_sedes}}</option>

				<option value="{{$sede->id_sedes}}">{{$sede->nombre_sedes}}</option>

                @endforeach

                </select>


                </div>


                <div class="form-group">


                  <label>Carrera</label>
                  <br>

                  <select name="carreraProyecto" id="carreraProyecto" class="form-control" readonly="true">

                  <option value="0">Seleccionar Carrera</option>

                  @foreach($carreras as $carrera)
                  <option value="{{$carrera->id_carreras_ulatina}}" selected>{{$carrera->nombre_carreras_ulatina}}</option>

                  <option value="{{$carrera->id_carreras_ulatina}}">{{$carrera->nombre_carreras_ulatina}}</option>
                  @endforeach

                 </select>


                </div>

                <div class="form-group">
                  <?php
                        $idUser = Auth::user()->id;
                        $name = Auth::user()->name;

                        ?>
                  <label>Propuesto</label>
                  <br>
              <input type="text" id="propuesto" name="propuesto" class="form-control" required="true" readonly="true">
                </div>


                <div class="form-group">
                  <label>Tipo De Proyecto</label>
                  <br>
                <select name="tipoProyecto" id="tipoProyecto" class="form-control" readonly="true">

                <option value="0">Seleccionar Tipo De Proyecto</option>

                 @foreach($tipo as $tp)


                <option value="{{$tp->tipo_proyecto_id}}" selected>{{$tp->tipo_proyecto_descripcion}}</option>

                <option value="{{$tp->tipo_proyecto_id}}">{{$tp->tipo_proyecto_descripcion}}</option>


                @endforeach


                </select>


                </div>


                <div class="form-group">
                  <label>Nombre del Proyecto</label>
                  <br>
              <input type="text" id="nombreProyecto" name="nombreProyecto" class="form-control" placeholder="Nombre del Proyecto. . . " value="{{$Proyecto->nombre_proyecto}}" required="true" readonly="true">
                </div>


                <div class="form-group">
                  <label>Beneficiario del Proyecto</label>
                  <br>
              <input type="text" id="beneficiario" name="beneficiario" class="form-control" placeholder="Beneficiario del Proyecto. . . " value="{{$Proyecto->beneficiario}}" required="true" readonly="true">
                </div>


                <div class="form-group">
                  <label>Metodologia</label>
                  <br>
              <input type="text" id="metodologia" name="metodologia" class="form-control" placeholder="Metodologia del Proyecto. . . " value="{{$Proyecto->metodologia}}" required="true" readonly="true">
                </div>

                <div class="form-group">
                  <label>Presupuesto</label>
                  <br>
              <input type="text" id="presupuesto" name="presupuesto" class="form-control" placeholder="Presupuesto del Proyecto. . . " value="{{$Proyecto->presupuesto}}" required="true" readonly="true">
                </div>

                  <div class="form-group">
              <label for="JUSTIFICACION" >Justificacion</label>
              <br>
              <TEXTAREA class="form-group" NAME="JUSTIFICACION" id="JUSTIFICACION" readonly="true">{{$Proyecto->justificacion}} </TEXTAREA>
            </div>

                </div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">





            <div class="form-group">
              <label for="GENERAL">Objetivo General</label>
              <br>
              <TEXTAREA class="form-group" NAME="GENERAL" id="GENERAL" readonly="true"> </TEXTAREA>
            </div>

            <div class="form-group">
                  <div class="form-group">
                  <label>Objetivo Especifico</label>

                    <!--<button type="button" class="btn btn-default" onClick="cargarObjetivo()"> Agregar</button>-->

                </div>
              <div class="table-responsive"; style="width:auto; height:150px; overflow:auto;">
            <table id="tblObjetivoEspecifico" class="table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Objetivo Especifico</th>
                </thead>

                <tr>

                    <td> Sin Objetivos Agregados</td>
                </tr>


            </table>
             </div>
                </div>

<div class="form-group">
                  <div class="form-group">
                  <label>Colaborador</label>

                </div>
              <div class="table-responsive"; style="width:auto; height:150px; overflow:auto;">
            <table id="tblColaborador" class="table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Colaborador</th>
                </thead>
<tr>


                    <td> Sin Colaborador Agregado</td>
                </tr>

            </table>
             </div>
                </div>


            </div>



            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <br><br><br>
                  @if (count($errors)>0)
                  <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                              <li>{{$error}}</li>
                        @endforeach
                        </ul>
                  </div>
                  @endif
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">




                <div class="form-group" >
              <label>Condicion del Proyecto</label>
              <br>
              @if($Proyecto->condicion_proyecto_id==1)
                <input type="radio" id="condicionP" name="condicionP1" value="1" checked disabled="true"> PRIVADO
          &nbsp;&nbsp;&nbsp;<input type="radio" id="condicionP2" name="condicionP" value="2" disabled="true"> PUBLICO<br>
          @else
          <input type="radio" id="condicionP" name="condicionP1" value="1"  disabled="true"> PRIVADO
          &nbsp;&nbsp;&nbsp;<input type="radio" id="condicionP2" name="condicionP" value="2" checked disabled="true"> PUBLICO<br>
          @endif
            </div>

            <div class="form-group">
                  <label>Estado Del Proyecto</label>
                  <br>
                <select name="campus" id="campus" class="form-control" disabled="true">

                <option value="0">Estado Del Proyecto</option>

                 @foreach($estado as $std)
                 @if($std->estado_proyecto_id==$Proyecto->estado_proyecto_id)
                <option value="{{$std->estado_proyecto_id}}" selected>{{$std->estado_proyecto_descripcion}}</option>
                @else
                <option value="{{$std->estado_proyecto_id}}">{{$std->estado_proyecto_descripcion}}</option>
                @endif
                @endforeach


                </select>


                </div>


<div class="form-group">
                  <label>Responsable</label>
                  <br>
                <select name="responsable" id="responsable" class="form-control" disabled="true">

                <option value="0">Seleccionar Responsable</option>

                 <option value="Jose Remon">Jose Remon</option>
                 <option value="Esteban Arroyo">Esteban Arroyo</option>


                </select>


                </div>


            <div class="form-group">
                  <div class="form-group">
                  <label>Observaciones</label>
                  <br>

                </div>
              <div class="table-responsive"; style="width:auto; height:150px; overflow:auto;">
            <table id="tblObservaciones" class="table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Observaciones</th>
                </thead>


                <tr>

                    <td> Sin Observaciones Agregadas</td>
                </tr>

            </table>
             </div>
                </div>



            </div>

            <?php


              $pId = $Proyecto->proyecto_investigacion_id;



             ?>



            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <br><br><br><br><br><br><br><br><br><br>
                     <div class="form-group" align="center">
                  &nbsp;&nbsp;&nbsp;<button id="btnParticipar" name="btnParticipar" class="btn btn-primary btn-lg btn-block" align="center" onclick="validarParticipacion()">PARTICIPAR PROYECTO</button>&nbsp;&nbsp;&nbsp;
                  <br><br><br>
                  <button id="btnPlanT" name="btnPlanT" class="btn btn-warning btn-lg btn-block" type="reset" align="center" onclick="abrirPlanTrabajo()">PLAN DE TRABAJO</button>&nbsp;&nbsp;&nbsp;
                  <br><br><br>
                  <button class="btn btn-danger btn-lg btn-block" type="reset" align="center" onclick="goBack()">CANCELAR</button>
            </div>
            </div>

            </div>




@endsection

@section('scripts')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">


var objetivoEditando = "";

var bPreguntar = false;

var objetivosArray = [];

var objetivosArray2 = [];

var objetivosArray = [];

var objetivosArray2 = [];

var observacionesArray = [];

var observacionesArray2 = [];

var colaboradorArray = [];

var colaboradorArray2 = [];

var systemUsers = new Array();

var userOwnerId = 0;


var idU = 0;

    window.onbeforeunload = preguntarAntesDeSalir;



    function preguntarAntesDeSalir()

    {

      if (bPreguntar)

        return "¿Seguro que quieres salir?";

    }


var contR= 0;

function Proyecto(objetivo_proyecto_id, objetivo_proyecto_descripcion, objetivo_general, estado_objetivo_id, proyecto_investigacion_id) {
  this.objetivo_proyecto_id = objetivo_proyecto_id;
  this.objetivo_proyecto_descripcion = objetivo_proyecto_descripcion;
  this.objetivo_general = objetivo_general;
  this.estado_objetivo_id = estado_objetivo_id;
  this.proyecto_investigacion_id = proyecto_investigacion_id;
}


function observacionProyecto(observacion_proyecto_id, observacion_proyecto_descripcion, proyecto_investigacion_id) {
  this.observacion_proyecto_id = observacion_proyecto_id;
  this.observacion_proyecto_descripcion = observacion_proyecto_descripcion;
  this.proyecto_investigacion_id = proyecto_investigacion_id;
}


function UsuarioProCol(usuario_proyecto_id, users_id, name, tipo_usuario_proyecto_id, proyecto_investigacion_id) {

  this.usuario_proyecto_id = usuario_proyecto_id;
  this.users_id = users_id;
  this.name = name;
  this.tipo_usuario_proyecto_id = tipo_usuario_proyecto_id;
  this.proyecto_investigacion_id = proyecto_investigacion_id;

}

    function cargarObjetivo()
                {



                var objetivoDescripcion = $('#objetivoEsp').val();

                if (objetivoDescripcion==""){
                	alert("No se puede agregar un objetivo en blanco!")
                }else{



                var obj = [];

                // var miHonda = {color: "rojo", ruedas: 4, motor: {cilindros: 4, tamanio: 2.2}};
                // var miHonda1 = {color: "rojo2", ruedas: 4, motor: {cilindros: 8, tamanio: 2.2}};
                // var miHonda2 = {color: "rojo3", ruedas: 4, motor: {cilindros: 12, tamanio: 2.2}};

                // obj.push(miHonda);
                // obj.push(miHonda1);
                // obj.push(miHonda2);

                // console.log(obj);


 			    // var miAuto = new Proyecto(0, "objetivoDescripcion", 0, 0, 1);
 			    // var miAuto2 = new Proyecto(0, "objetivoDescripcion", 0, 0, 2);
 			    // var miAuto3 = new Proyecto(0, "objetivoDescripcion", 0, 0, 3);

 			    // obj.push(miAuto);
        //         obj.push(miAuto2);
        //         obj.push(miAuto3);

        //         console.log(obj);






                var proyectoEditarId = <?php echo $Proyecto->proyecto_investigacion_id; ?>;

                $('#tblObjetivoEspecifico').empty();
                $('#tblObjetivoEspecifico').append('<thead>' +
                  '<th></th>' +
                    '<th>Objetivo Especifico</th>' +
                '</thead>');

                var objetivoDescripcion = $('#objetivoEsp').val();

     			var objetivoProyecto = new Proyecto(0, objetivoDescripcion, 0, 2, proyectoEditarId);
     			//var objP = {"objetivo_proyecto_id": 0, "objetivo_proyecto_descripcion": "mpo", "objetivo_genera": 0, "estado_objetivo_id": 2, "proyecto_investigacion_id": 1};

     			objetivosArray2.push(new Proyecto(0, objetivoDescripcion, 0, 2, proyectoEditarId));
     			//objetivosArray.push(objP);
     			console.log(objetivosArray2[0].objetivo_proyecto_descripcion);
     			console.log(objetivosArray2);
                //console.log(objetivosArray);
                $("#objetivoEsp").val("");


                for(i=0; i<=objetivosArray2.length-1; i++){



                		if (objetivosArray2[i].objetivo_general==0){

                $('#tblObjetivoEspecifico').append("<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-gear'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<button class='btn btn-success' type='button' onClick=editarObjetivo('"+objetivosArray2[i].objetivo_proyecto_descripcion+"')><span class='fa fa-edit'></span></button>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' onClick=eliminarObjetivo('"+objetivosArray2[i].objetivo_proyecto_descripcion+"')><span class='fa fa-remove'></span></button>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+
                    "<td>"+ objetivosArray2[i].objetivo_proyecto_descripcion +"</td>"+
                "<td>"+

                "</tr>");
            		}



              }

          }

                }


function eliminarObjetivo(desObj)
                {

                  //console.log(desObj);
                  var objetivosArrayTemp = [];
                  console.log("=============*********//////////////////");
                  console.log(objetivosArray2.length);
                  console.log("=============*********//////////////////");

                  if (objetivosArray2.length<=2) {

                            console.log(objetivosArray2);
                        $('#tblObjetivoEspecifico').empty();
                $('#tblObjetivoEspecifico').append('<thead>' +
                  '<th></th>' +
                    '<th>Objetivo Especifico</th>' +
                '</thead>');

                $('#tblObjetivoEspecifico').append("<tr>"+
                  "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-gear'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<button class='btn btn-success' type='button' disabled><span class='fa fa-edit'></span></button>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' disabled><span class='fa fa-remove'></span></button>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+
                    "<td> Sin Objetivos</td>"+
                "<td>"+

                "</tr>");
					console.log(objetivosArray2);
                      for(i=0; i<=objetivosArray2.length-1; i++){

                          if (objetivosArray2[i].objetivo_proyecto_descripcion==desObj) {

                          }else{

                          		objetivosArrayTemp.push(new Proyecto(objetivosArray2[i].objetivo_proyecto_id, objetivosArray2[i].objetivo_proyecto_descripcion, objetivosArray2[i].objetivo_general, objetivosArray2[i].estado_objetivo_id, objetivosArray2[i].proyecto_investigacion_id));

                          }

                      }

                      objetivosArray2 = [];

                      for(i=0; i<=objetivosArrayTemp.length-1; i++){


                              objetivosArray2.push(new Proyecto(objetivosArrayTemp[i].objetivo_proyecto_id, objetivosArrayTemp[i].objetivo_proyecto_descripcion, objetivosArrayTemp[i].objetivo_general, objetivosArrayTemp[i].estado_objetivo_id, objetivosArrayTemp[i].proyecto_investigacion_id));


                      }


                      objetivosArrayTemp = [];
                      console.log(objetivosArray2);

                  }else{


                      console.log(objetivosArray2);
                      for(i=0; i<=objetivosArray2.length-1; i++){

                          if (objetivosArray2[i].objetivo_proyecto_descripcion==desObj) {

                          }else{

                          		objetivosArrayTemp.push(new Proyecto(objetivosArray2[i].objetivo_proyecto_id, objetivosArray2[i].objetivo_proyecto_descripcion, objetivosArray2[i].objetivo_general, objetivosArray2[i].estado_objetivo_id, objetivosArray2[i].proyecto_investigacion_id));

                          }

                      }

                      objetivosArray2 = [];

                      for(i=0; i<=objetivosArrayTemp.length-1; i++){


                              objetivosArray2.push(new Proyecto(objetivosArrayTemp[i].objetivo_proyecto_id, objetivosArrayTemp[i].objetivo_proyecto_descripcion, objetivosArrayTemp[i].objetivo_general, objetivosArrayTemp[i].estado_objetivo_id, objetivosArrayTemp[i].proyecto_investigacion_id));


                      }


                      objetivosArrayTemp = [];
                      console.log("MMMMMMMMMMMMMMMMMMM");
                      console.log(objetivosArray2);

                       $('#tblObjetivoEspecifico').empty();
                $('#tblObjetivoEspecifico').append('<thead>' +
                  '<th></th>' +
                    '<th>Objetivo Especifico</th>' +
                '</thead>');


                for(i=0; i<=objetivosArray2.length-1; i++){

                	if (objetivosArray2[i].objetivo_general==0) {

                $('#tblObjetivoEspecifico').append("<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-gear'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<button class='btn btn-success' type='button' onClick=editarObjetivo('"+objetivosArray2[i].objetivo_proyecto_descripcion+"')><span class='fa fa-edit'></span></button>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' onClick=eliminarObjetivo('"+objetivosArray2[i].objetivo_proyecto_descripcion+"')><span class='fa fa-remove'></span></button>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+
                    "<td>"+ objetivosArray2[i].objetivo_proyecto_descripcion +"</td>"+

                "</tr>");

              }

          }

                  }




                }


                window.onload = function() {

  var list = <?php echo json_encode($usuariosP,JSON_FORCE_OBJECT); ?>;
      console.log(list);

      objetivosArray = <?php echo json_encode($objetivosP,JSON_FORCE_OBJECT); ?>;


      colaboradorArray = <?php echo json_encode($usuariosP,JSON_FORCE_OBJECT); ?>;

      systemUsers = <?php echo json_encode($systemUsers,JSON_FORCE_OBJECT); ?>;


      observacionesArray = <?php echo json_encode($observaciones,JSON_FORCE_OBJECT); ?>;


// document.getElementById('btnModificar').disabled=true;
// document.getElementById('btnAtras').disabled=true;


     // cargarInterfazEstudiante();

     cargarObjetivosProyecto();
      cargarColaboradoresProyecto();
      cargarObservacionesProyecto();
          cargarDePropiedades();

          idU = <?php  echo Auth::user()->role_id; ?>;
        if( idU != 2){

          document.getElementById('btnParticipar').disabled=true;

        }

        validarUsuarioPro();




}



function cargarDePropiedades(){



    }


    function cargarInterfazEstudiante(){

      document.getElementById('estadoP').disabled=true;
      document.getElementById('responsable').disabled=true;
      document.getElementById('condicionP1').disabled=true;
      document.getElementById('condicionP2').disabled=true;
      document.getElementById('txtObservacionP').disabled=true;
      document.getElementById('txtAgregarColaborador').disabled=true;
      document.getElementById('btnAgregarColaborador').disabled=true;
      document.getElementById('btnObservacionP').disabled=true;


    }

    function cargarInterfazProfesor(){

      document.getElementById('txtAgregarColaborador').disabled=false;
      document.getElementById('btnAgregarColaborador').disabled=false;
      document.getElementById('condicionP1').disabled=false;
      document.getElementById('condicionP2').disabled=false;
      document.getElementById('estadoP').disabled=false;
      document.getElementById('responsable').disabled=false;
      document.getElementById('btnObservacionP').disabled=false;


    }


        function validarParticipacion(){

            var currentDate = new Date();

          var varMonth = currentDate.getMonth();
          var varYear = currentDate.getUTCFullYear();
          var varLastYear = currentDate.getUTCFullYear()-1;
          var varNextYear = currentDate.getUTCFullYear()+1;
          var periodoActual = "";
          var periodoMatricular = "";
          var inicio1 = new Date();
          var inicio2 = new Date();
          var fin1 = new Date();
          var fin2 = new Date();


          var numCuatri = 0;


            if (varMonth>=1&&varMonth<=4){

            periodoActual = varYear + "-1";

          }else if (varMonth>=5&&varMonth<=8){

            periodoActual = varYear + "-2";

          }else if (varMonth>=9&&varMonth<=12){

            periodoActual = varYear + "-3";

          }



          if (varMonth<=2){

            numCuatri = 1;

            periodoMatricular = varYear + "-" + numCuatri;
            inicio1 = new Date(varLastYear,11,1);
            inicio2 = new Date(varLastYear,10,1);
            fin1 = new Date(varYear,2,1);
            fin2 = new Date(varYear,3,1);

          }else if (varMonth>=3&&varMonth<=6){

            numCuatri = 2;
            periodoMatricular = varYear + "-" + numCuatri;
            inicio1 = new Date(varYear,3,1);
            inicio2 = new Date(varYear,2,1);
            fin1 = new Date(varYear,6,1);
            fin2 = new Date(varYear,7,1);

          }else if (varMonth>=7&&varMonth<=10){

            numCuatri = 3;
            periodoMatricular = varYear + "-" + numCuatri;
            inicio1 = new Date(varYear,7,1);
            inicio2 = new Date(varYear,6,1);
            fin1 = new Date(varYear,10,1);
            fin2 = new Date(varYear,11,1);

          }else if (varMonth>=11){

            numCuatri = 1;
            periodoMatricular = varNextYear + "-" + numCuatri;
            inicio1 = new Date(varYear,11,1);
            inicio2 = new Date(varYear,10,1);
            fin1 = new Date(varNextYear,2,1);
            fin2 = new Date(varNextYear,3,1);

          }

          if (currentDate >= inicio1 && currentDate < fin1 ){
            // alert("This year= "+ varYear +", the last year= " + varLastYear +", the next year= " + varNextYear+", the current month= " + varMonth +", the current period= " + periodoActual+", the enroll period= " + periodoMatricular);





          var pId  = <?php echo $Proyecto->proyecto_investigacion_id; ?>;

                   $.ajax({


                type:'get',
                url:'{{URL::to('consultarPlan/')}}',

                data:{'proyecto_investigacion_id': pId},
                success:function(data){


                  if (data.data.length<1){

                    alert("En este momento la participacion a este proyecto no es posible, \n debido a que no existen planes de trabajo disponibles");

                  }else{

                    console.log('success1');
                    var arrayQTY = [];

                    console.log(data.data);
                    var numeroEstudiantes = 0;
                    var yaParticipando = 0;

                      $.each(data.data, function(index, planFIND){


                            if(planFIND.periodo == periodoMatricular){
                                    numeroEstudiantes = numeroEstudiantes + planFIND.cantidad_encargados;
                                    arrayQTY.push([planFIND.plan_proyecto_id, planFIND.cantidad_encargados]);
                            }

                      });


                      if(numeroEstudiantes==0){

                        alert("En este momento la participacion a este proyecto no es posible, debido a que no existen planes de trabajo disponibles en el periodo a participar: "+periodoMatricular);
                      }else{


                            yaParticipando = buscarEncargadosPlan(pId, numeroEstudiantes, inicio1, fin1);


                        if(yaParticipando==2){

                            alert("En este momento la participacion a este proyecto no es posible, debido a que no existen campos disponibles");

                        }else if(yaParticipando==1){

                              if (confirm('Estas seguro de querer participar en este proyecto ? ')) {



                                                 $.ajax({


                                              type:'get',
                                              url:'{{URL::to('guardarEncargado/')}}',

                                              data:{'proyecto_invetigacion_id': pId},
                                              success:function(data){


                                                  window.location.href = "/ModuloIE/Proyecto/"+pId+"/participar/";

                                              },
                                              error:function(){

                                              }
                                          });





                              } else {
                                // Do nothing!
                              }

                        }


                      }





                  }






                },
                error:function(){

                }
            });












          }else if (currentDate >= fin1 && currentDate < fin2 ){
            alert("En este momento la participacion a proyectos no es permitida");
          }else if (currentDate >= inicio2 && currentDate < inicio1 ){
            alert("En este momento la participacion a proyectos no es permitida");
          }



          // var pId  = <?php //echo $Proyecto->proyecto_investigacion_id; ?>;

          //          $.ajax({


          //       type:'get',
          //       url:'{{URL::to('validarParticipacion/')}}',

          //       data:{'proyecto_investigacion_id': pId},
          //       success:function(data){


          //         if (data.data.length<1){

          //           console.log('NO PERTENECE');

          //           document.getElementById('btnPlanT').disabled=true;

          //         }else{

          //           console.log('success');

          //           console.log(data.data);
          //         }






          //       },
          //       error:function(){

          //       }
          //   });

        }


        function buscarEncargadosPlan(proyecto_id, qtyEncargados, fechaInicio, fechaFin){


          console.log(fechaInicio.getd);
          console.log(fechaFin.toString());


              var varReturn = 0;
              var arrayReturn = [];


                           $.ajax({


                            type:'get',
                            url:'{{URL::to('consultarCantidadEstudiantes/')}}',
                            async:false,
                            data:{'proyecto_id': proyecto_id, 'fechaInicio': fechaInicio.getFullYear()+'-'+fechaInicio.getMonth()+'-'+fechaInicio.getDay(), 'fechaFin': fechaFin.getFullYear()+'-'+fechaFin.getMonth()+'-'+fechaFin.getDay()},
                            success:function(data){


                              if (data.data.length<1){

                                  varReturn = 1;


                              }else{

              console.log("mptdas");
              console.log(data.data[0].qtyEstudiantes);
                                if (data.data[0].qtyEstudiantes == qtyEncargados){

                                  varReturn = 2;


                                }else if (data.data[0].qtyEstudiantes < qtyEncargados){

                                    varReturn = 1;


                                }




                              }






                            },
                            error:function(){

                            }
                        });



                           return varReturn;




        }


        function validarUsuarioPro(){

           var pId  = <?php echo $Proyecto->proyecto_investigacion_id; ?>;

         $.ajax({


                type:'get',
                url:'{{URL::to('validarUsuarioPro/')}}',

                data:{'proyecto_invetigacion_id': pId},
                success:function(data){


                  if (data.data.length<1){





                    if (<?php  echo Auth::user()->role_id; ?>==1){
                        document.getElementById('btnPlanT').disabled=false;
                    }else{
                      document.getElementById('btnPlanT').disabled=true;
                      console.log('NO PERTENECE');
                    }


                  }else{

                    console.log('success'+userOwnerId);

                    console.log(data.data);



                    if(userOwnerId == <?php  echo Auth::user()->id; ?> && <?php  echo Auth::user()->role_id; ?>==2){

                      document.getElementById('btnParticipar').disabled=false;
                    }else{
                      document.getElementById('btnParticipar').disabled=true;
                    }



                  }






                },
                error:function(){

                }
            });

    }



function cargarObjetivosProyecto(){

	var testVar = "";
	var numObj = Object.keys(objetivosArray).length;

	for(i=0; i<=numObj-1; i++){

			objetivosArray2.push(new Proyecto(objetivosArray[i].objetivo_proyecto_id, objetivosArray[i].objetivo_proyecto_descripcion, objetivosArray[i].objetivo_general, objetivosArray[i].estado_objetivo_id, objetivosArray[i].proyecto_investigacion_id));

	}


	var numP = objetivosArray2.length;
	console.log("===========333");
	console.log(numP);


	if(numP==0){


	}else{

	$('#tblObjetivoEspecifico').empty();
	     $('#tblObjetivoEspecifico').append('<thead>' +
                    '<th>Objetivo Especifico</th>' +
                '</thead>');

	for(MP=0; MP<=numP-1; MP++){

			console.log("===========MMMM");
			console.log(objetivosArray2[MP].objetivo_general);

      	if (objetivosArray2[MP].objetivo_general>=1) {


      		testVar = objetivosArray2[MP].objetivo_proyecto_descripcion;


      	}else {

      		console.log("===========333888");

      		console.log(objetivosArray2[MP].objetivo_proyecto_id);






                $('#tblObjetivoEspecifico').append("<tr>"+
                   "<td>"+ objetivosArray2[MP].objetivo_proyecto_descripcion +"</td>"+
                "</tr>");

      	}



      }


       document.getElementById('GENERAL').value = testVar;

  }


}



function cargarColaboradoresProyecto(){

  var testVar = "";
  var numObj = Object.keys(colaboradorArray).length;



  if(numObj==0){

    for(sysU=0; sysU<=Object.keys(systemUsers).length-1; sysU++){

              $('#responsable').append('<option value='+systemUsers[sysU].id+'>'+systemUsers[sysU].name+'</option>');
            }

}else{



  for(MP=0; MP<=numObj-1; MP++){



        if (colaboradorArray[MP].tipo_usuario_proyecto_id==1) {

          $('#responsable').empty();
            $('#responsable').append('<option value="0">Seleccionar Responsable</option>');

            for(sysU=0; sysU<=Object.keys(systemUsers).length-1; sysU++){

                if(systemUsers[sysU].id==colaboradorArray[MP].id){

                responsableID = colaboradorArray[MP].id;
                $('#responsable').append('<option value='+systemUsers[sysU].id+' selected>'+systemUsers[sysU].name+'</option>');

                }else{
                  $('#responsable').append('<option value='+systemUsers[sysU].id+'>'+systemUsers[sysU].name+'</option>');
                }

            }


        }else if (colaboradorArray[MP].tipo_usuario_proyecto_id==3) {


          $("#propuesto").attr("value", colaboradorArray[MP].name);
          userOwnerId = colaboradorArray[MP].id;

        }else if (colaboradorArray[MP].tipo_usuario_proyecto_id==2) {


            colaboradorArray2.push(new UsuarioProCol(colaboradorArray[MP].usuario_proyecto_id, colaboradorArray[MP].id, colaboradorArray[MP].name, colaboradorArray[MP].tipo_usuario_proyecto_id, colaboradorArray[MP].proyecto_investigacion_id));

        }



      }


      // document.getElementById('GENERAL').value = testVar;

  }


        var numP = Object.keys(colaboradorArray2).length;

  if(numP==0){


}else{

console.log(numP);

     $('#tblColaborador').empty();
                $('#tblColaborador').append('<thead>' +
                    '<th>Colaborador</th>' +
                '</thead>');

  for(MP=0; MP<=numP-1; MP++){


                  //console.log(tipoUsuario);
                  //console.log("==**--")
                  $('#tblColaborador').append("<tr>"+
                   "<td>"+ colaboradorArray2[MP].name +"</td>"+

                "</tr>");



            }

}


}




function cargarObservacionesProyecto(){

  var testVar = "";
  var numObj = Object.keys(observacionesArray).length;

  if(numObj==0){

  }else{

    for(i=0; i<=numObj-1; i++){

        observacionesArray2.push(new observacionProyecto(observacionesArray[i].observacion_proyecto_id, observacionesArray[i].observacion_proyecto_descripcion, observacionesArray[i].proyecto_investigacion_id));

        }
  }


  var numP = Object.keys(observacionesArray2).length;

  //console.log(numP);


  if(numP==0){


}else{


    $('#tblObservaciones').empty();
        $('#tblObservaciones').append('<thead>' +
            '<th>Observaciones</th>' +
        '</thead>');

  for(MP=0; MP<=numP-1; MP++){





      $('#tblObservaciones').append("<tr>"+
                   "<td>"+ observacionesArray2[MP].observacion_proyecto_descripcion +"</td>"+

                 "</tr>");





      }


      // document.getElementById('GENERAL').value = testVar;

  }


}


function editarObjetivo(objetivoEditar){

document.getElementById('btnAgregarObjetivo').disabled=true;
document.getElementById('btnModificar').disabled=false;
document.getElementById('btnAtras').disabled=false;
$("#objetivoEsp").val(objetivoEditar);


	console.log(objetivoEditar);
	objetivoEditando = objetivoEditar;

}

function modificarObjetivo(){





	var objetivoDescripcion2 = $('#objetivoEsp').val();
    $('#tblObjetivoEspecifico').empty();
    $('#tblObjetivoEspecifico').append('<thead>' +
      '<th></th>' +
        '<th>Objetivo Especifico</th>' +
    '</thead>');

      for(t=0; t<=objetivosArray2.length-1; t++){

      	console.log("========================");
      	console.log(objetivosArray2[t].objetivo_proyecto_descripcion);


      if (objetivoEditando==objetivosArray2[t].objetivo_proyecto_descripcion&&objetivosArray2[t].objetivo_general==0) {


      			console.log(objetivosArray2[t].objetivo_proyecto_descripcion);
      			objetivosArray2[t].objetivo_proyecto_descripcion = objetivoDescripcion2;


      }



      if(objetivosArray2[t].objetivo_general==0) {




         $('#tblObjetivoEspecifico').append("<tr>"+
      "<td>"+
      "<div class='dropdown table-actions-dropdown'>"+
                                "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-gear'></span></button>"+
                                "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                    "<li>"+
                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                        "<button class='btn btn-success' type='button' onClick=editarObjetivo('"+objetivosArray2[t].objetivo_proyecto_descripcion+"')><span class='fa fa-edit'></span></button>"+
                                        "</span>"+
                                        "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                        "<button class='btn btn-danger'  type='button' onClick=eliminarObjetivo('"+objetivosArray2[t].objetivo_proyecto_descripcion+"')><span class='fa fa-remove'></span></button>"+
                                        "</span>"+
                                    "</li>"+
                                "</ul>"+
                            "</div>"+
       "</td>"+
       "<td>"+ objetivosArray2[t].objetivo_proyecto_descripcion +"</td>"+

     "</tr>");


    			console.log("========================22");
    			console.log(objetivosArray2[t].objetivo_proyecto_descripcion);

    		}



  }

	document.getElementById('btnAgregarObjetivo').disabled=false;
	document.getElementById('btnModificar').disabled=true;
	document.getElementById('btnAtras').disabled=true;
	$("#objetivoEsp").val("");
	objetivoEditando = "";

}

function atrasObjetivo(){
document.getElementById('btnAgregarObjetivo').disabled=false;
document.getElementById('btnModificar').disabled=true;
document.getElementById('btnAtras').disabled=true;
$("#objetivoEsp").val("");
objetivoEditando = "";
}



function isValidLicenseNo(text) {
    if(text.length < 2) return text.match(/(^[0-9]{0,1})$/);
    return text.match(/(^[0-9]{2}\d{0,6}$)/);
}



function registrarProyecto() {



var sedeProyecto = $('#sedeProyecto').val();
var carreraProyecto = $('#carreraProyecto').val();
var propuestoid = '<?php echo $idUser; ?>';
var nombreProyecto = $('#nombreProyecto').val();
var beneficiario = $('#beneficiario').val();
var metodologia = $('#metodologia').val();
var presupuesto = $('#presupuesto').val();
var JUSTIFICACION = $('#JUSTIFICACION').val();
var GENERAL = $('#GENERAL').val();
var tipoProyecto = $('#tipoProyecto').val();
var estado = $('#condicionP').val();
var proyectoId = 0;




console.log(sedeProyecto);
console.log('====');
console.log(nombreProyecto);



                $.ajax({



                type:'get',
                url:'{{URL::to('guardarProyecto/')}}',

                data:{'sede_id': sedeProyecto, 'id_carreras_ulatina': carreraProyecto, 'llaveAlmacenamiento': propuestoid, 'nombre_proyecto': nombreProyecto,
                      'beneficiario': beneficiario, 'metodologia': metodologia, 'presupuesto': presupuesto, 'justificacion': JUSTIFICACION,
                       'estado_proyecto_id': 1, 'tipo_proyecto_id': tipoProyecto, 'condicion_proyecto_id': estado},
                success:function(data){


                      console.log('success420');
                      console.log(propuestoid);
                      proyectoId = data[0].proyecto_investigacion_id;
                      console.log(data[0].proyecto_investigacion_id);

                $.ajax({


                type:'get',
                url:'{{URL::to('guardarUsuarioProyecto/')}}',

                data:{'users_id': propuestoid, 'tipo_usuario_proyecto_id': 3, 'proyecto_investigacion_id': proyectoId},
                success:function(data){

                    //proceso de insercesion de datos
                    console.log(data);




                },
                error:function(){

                }
               });


                $.ajax({


                type:'get',
                url:'{{URL::to('guardarObjetivoGeneral/')}}',

                data:{'objetivo_proyecto_descripcion': GENERAL, 'objetivo_general': 1, 'estado_objetivo_id': 2, 'proyecto_investigacion_id': proyectoId},
                success:function(data){

                    //proceso de insercesion de datos
                    console.log(data);




                },
                error:function(){

                }
               });



                //for each para guardar todos los objetivos
                //objetivosArray
                $.each(objetivosArray, function(index, objetivoEsp){



                $.ajax({


                type:'get',
                url:'{{URL::to('guardarObjetivoEspecifico/')}}',

                data:{'objetivo_proyecto_descripcion': objetivoEsp, 'objetivo_general': 0, 'estado_objetivo_id': 2, 'proyecto_investigacion_id': proyectoId},
                success:function(data){

                    //proceso de insercesion de datos
                    console.log(data);




                },
                error:function(){

                }
               });




              });



                },
                error:function(){

                }

            });



}






function goBack() {

var URLactual = window.location;
var str = URLactual.toString();
var n = str.search("ModuloIE");
var imp = str.substring(0, n);
window.location =imp+'ModuloIE/Proyecto/redirectUser';

}



function abrirPlanTrabajo() {
    //window.location.href = "/ModuloInvestigacionExtension/ModuloIE/Proyecto/PlanTrabajo/";


        var pId  = <?php echo $Proyecto->proyecto_investigacion_id; ?>;
        var URLactual = window.location;
        var str = URLactual.toString();
        var n = str.search("ModuloIE");
        var imp = str.substring(0, n);
        window.location =imp+'ModuloIE/Proyecto/'+pId+'/PlanTrabajo';
        //alert(imp+'ModuloIE/Proyecto/'+pId+'/PlanTrabajo/');







}





</script>


@endsection
