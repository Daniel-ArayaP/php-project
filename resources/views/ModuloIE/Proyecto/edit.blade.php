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
$prueba1=0;

 ?>


      <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <h3>Modificar Proyecto</h3>
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
                <select name="sedeProyecto" id="sedeProyecto" class="form-control">

                <option value="0">Seleccionar Sede</option>

                 @foreach($sedes as $sede)
                 @if($sede->id_sedes==$Proyecto->sede_id)
                <option value="{{$sede->id_sedes}}" selected>{{$sede->nombre_sedes}}</option>
                @else
				<option value="{{$sede->id_sedes}}">{{$sede->nombre_sedes}}</option>
                @endif
                @endforeach

                </select>


                </div>


                <div class="form-group">


                  <label>Carrera</label>
                  <br>

                  <select name="carreraProyecto" id="carreraProyecto" class="form-control">

                  <option value="0">Seleccionar Carrera</option>

                  @foreach($carreras as $carrera)
                  @if($carrera->id_carreras_ulatina==$Proyecto->id_carreras_ulatina)
                  <option value="{{$carrera->id_carreras_ulatina}}" selected>{{$carrera->nombre_carreras_ulatina}}</option>
                  @else
                  <option value="{{$carrera->id_carreras_ulatina}}">{{$carrera->nombre_carreras_ulatina}}</option>
                  @endif
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
                <select name="tipoProyecto" id="tipoProyecto" class="form-control">

                <option value="0">Seleccionar Tipo De Proyecto</option>

                 @foreach($tipo as $tp)

                 @if($tp->tipo_proyecto_id==$Proyecto->tipo_proyecto_id)
                <option value="{{$tp->tipo_proyecto_id}}" selected>{{$tp->tipo_proyecto_descripcion}}</option>
                @else
                <option value="{{$tp->tipo_proyecto_id}}">{{$tp->tipo_proyecto_descripcion}}</option>
                @endif

                @endforeach


                </select>


                </div>


                <div class="form-group">
                  <label>Nombre del Proyecto</label>
                  <br>
              <input type="text" id="nombreProyecto" name="nombreProyecto" class="form-control" placeholder="Nombre del Proyecto. . . " value="{{$Proyecto->nombre_proyecto}}" required="true">
                </div>


                <div class="form-group">
                  <label>Beneficiario del Proyecto</label>
                  <br>
              <input type="text" id="beneficiario" name="beneficiario" class="form-control" placeholder="Beneficiario del Proyecto. . . " value="{{$Proyecto->beneficiario}}" required="true">
                </div>


                <div class="form-group">
                  <label>Metodologia</label>
                  <br>
              <input type="text" id="metodologia" name="metodologia" class="form-control" placeholder="Metodologia del Proyecto. . . " value="{{$Proyecto->metodologia}}" required="true">
                </div>

                <div class="form-group">
                  <label>Presupuesto</label>
                  <br>
              <input type="text" id="presupuesto" name="presupuesto" class="form-control" onkeypress="return soloNumeros(event)" placeholder="Presupuesto del Proyecto. . . " value="{{$Proyecto->presupuesto}}" required="true">
                </div>

                  <div class="form-group">
              <label for="JUSTIFICACION">Justificacion</label>
              <br>
              <TEXTAREA class="form-control" NAME="JUSTIFICACION" id="JUSTIFICACION">{{$Proyecto->justificacion}} </TEXTAREA>
            </div>

                </div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">





            <div class="form-group">
              <label for="GENERAL">Objetivo General</label>
              <br>
              <TEXTAREA class="form-control" NAME="GENERAL" id="GENERAL"> </TEXTAREA>
            </div>

            <div class="form-group">
                  <div class="form-group">
                  <label>Objetivo Especifico</label>
              <p><input type="text" id="objetivoEsp" name="objetivoEsp" class="form-control" placeholder="Ingrese Objetivo Especifico. . . " required="true">
                    <a><button id="btnAgregarObjetivo" class="btn btn-primary" onClick=cargarObjetivo() hidden="true"><span class="fa fa-plus"></span></button></a>
                    <a><button id="btnModificar" class="btn btn-success" onClick=modificarObjetivo()><span class="fa fa-edit"></span></button></a>
                    <a><button id="btnAtras" class="btn btn-danger" onClick=atrasObjetivo()><span class="fa fa-arrow-left"></span></button></a></p>
                    <!--<button type="button" class="btn btn-default" onClick="cargarObjetivo()"> Agregar</button>-->

                </div>
              <div class="table-responsive"; style="width:auto; height:150px; overflow:auto;">
            <table id="tblObjetivoEspecifico" class="table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th></th>
                    <th>Objetivo Especifico</th>
                </thead>

                <tr>
                                        <td>
             <div class="dropdown table-actions-dropdown">
	            <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></button>
	            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
	                <a href="" data-target="#" data-toggle="modal"><button class="btn btn-danger" disabled="true">X</button></a>
	            </ul>
		     </div>

		</td>
                    <td> Sin Objetivos Agregados</td>
                </tr>


            </table>
             </div>
                </div>

<div class="form-group">
                  <div class="form-group">
                  <label>Colaborador</label>
              <P>

                <a href="" data-target="#modal-delete" data-toggle="modal"><button id="btnBuscarColaborador" name="btnBuscarColaborador" class="btn btn-primary btn-block"><span class="fa fa-search"></span></button></a>
                @include('ModuloIE.Proyecto.modalBuscarColaborador')
              </p>
                </div>
              <div class="table-responsive"; style="width:auto; height:150px; overflow:auto;">
            <table id="tblColaborador" class="table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th></th>
                    <th>Colaborador</th>
                </thead>
<tr>

                    <td>
             <div class="dropdown table-actions-dropdown">
	            <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></button>
	            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
	                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Editar">
                    <a><button class="btn btn-success" disabled="true"><span class='fa fa-edit' disabled="true"></span></button></a>
                  </span>

                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
                    <a href="" data-target="#modal-delete-" data-toggle="modal" disabled="true"><button class="btn btn-danger" disabled="true"><span class='fa fa-trash-alt'></span></button></a>
                  </span>
	            </ul>
		     </div>

		</td>
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
                <input type="radio" id="condicionP1" name="condicionP1" value="1" checked onclick="privadoRB()"> PRIVADO
          &nbsp;&nbsp;&nbsp;<input type="radio" id="condicionP2" name="condicionP2" value="2" onclick="publicoRB()"> PUBLICO<br>
          @else
          <input type="radio" id="condicionP1" name="condicionP1" value="1" onclick="privadoRB()"> PRIVADO
          &nbsp;&nbsp;&nbsp;<input type="radio" id="condicionP2" name="condicionP2" value="2" checked onclick="publicoRB()"> PUBLICO<br>
          @endif
            </div>

            <div class="form-group">
                  <label>Estado Del Proyecto</label>
                  <br>
                <select name="estadoP" id="estadoP" class="form-control">

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
                <select name="responsable" id="responsable" class="form-control">

                <option value="0">Seleccionar Responsable</option>

                 <option value="Jose Remon">Jose Remon</option>
                 <option value="Esteban Arroyo">Esteban Arroyo</option>


                </select>


                </div>


            <div class="form-group">
                  <div class="form-group">
                  <label>Observaciones</label>
                  <br>
              <P><TEXTAREA class="form-control" id="txtObservacionP" name="txtObservacionP" placeholder="Ingrese Observacion. . . "> </TEXTAREA>
                <a><button id="btnAgregarObservacion" name="btnAgregarObservacion" class="btn btn-primary" onClick=cargarObservacion() hidden="true"><span class="fa fa-plus"></span></button></a>
                    <a><button id="btnModificarObservacion" name="btnModificarObservacion" class="btn btn-success" onClick=modificarObservacion()><span class="fa fa-edit"></span></button></a>
                    <a><button id="btnAtrasObservacion" name="btnAtrasObservacion" class="btn btn-danger" onClick=atrasObservacion()><span class="fa fa-arrow-left"></span></button></a></p>
                </div>
              <div class="table-responsive"; style="width:auto; height:150px; overflow:auto;">
            <table id="tblObservaciones" class="table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th></th>
                    <th>Observaciones</th>
                </thead>


                <tr>
        <td>
             <div class="dropdown table-actions-dropdown">
	            <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></button>
	            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
	              <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Editar">
                    <a href="#"><button class="btn btn-success" disabled="true"><span class='fa fa-edit'></span></button></a>
                  </span>

                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
                    <a href="" data-target="#modal-delete-" data-toggle="modal"><button class="btn btn-danger" disabled="true"><span class='fa fa-trash-alt'></span></button></a>
                  </span>
	            </ul>
		     </div>

		</td>
                    <td> Sin Observaciones Agregadas</td>
                </tr>

            </table>
             </div>
                </div>

            </div>


            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <br><br><br><br><br><br><br><br><br><br>
                     <div class="form-group" align="center">
                  &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary btn-lg btn-block" align="center" onclick="validarParaModificar()">MODIFICAR PROYECTO</button>&nbsp;&nbsp;&nbsp;
                  <br><br><br>
                  <button class="btn btn-danger btn-lg btn-block" type="reset" align="center" onclick="goBack()">CANCELAR</button>
            </div>
            </div>

            </div>



@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">


var objetivoEditando = "";

var bPreguntar = false;


var tipoUsuario = 0;
var objetivoEditando = "";
var observacionEditando = "";
var idColADD = 0;
var nameColADD = "";

var objetivosArray = [];

var objetivosArray2 = [];

var observacionesArray = [];

var observacionesArray2 = [];

var colaboradorArray = [];

var colaboradorArray2 = [];

var proyectoEditarId = 0;

var responsableID=0;


    window.onbeforeunload = preguntarAntesDeSalir;



    function preguntarAntesDeSalir()

    {

      if (bPreguntar)

        return "¿Seguro que quieres salir?";

    }


        function privadoRB()
    {
      document.getElementById('condicionP2').checked=false;
    }


    function publicoRB()
    {
      document.getElementById('condicionP1').checked=false;
    }


    function validarParaModificar(){

      if (tipoUsuario==0){
          modificarProyectoEstudiante();

      }else{
          modificarProyectoProfesorAdmin();

      }



    }

    function buscarColaborador()

    {

      if (document.getElementById('idColOp').checked==true){

          //console.log("EERR");
        buscarID();

      }else if (document.getElementById('emailColOp').checked==true){

        buscarEmail();

      }else if (document.getElementById('nameColOp').checked==true){

        buscarName();

      }



    }

    function idClick(){

      document.getElementById('idColOp').checked = true;
      document.getElementById('emailColOp').checked = false;
      document.getElementById('nameColOp').checked = false;

    }

    function emailClick(){

      document.getElementById('idColOp').checked = false;
      document.getElementById('emailColOp').checked = true;
      document.getElementById('nameColOp').checked = false;

    }

    function nameClick(){

      document.getElementById('idColOp').checked = false;
      document.getElementById('emailColOp').checked = false;
      document.getElementById('nameColOp').checked = true;

    }



    function buscarID(){

      var idCol = document.getElementById('idCol').value;
      console.log("TTMM");

         $.ajax({


                type:'get',
                url:'{{URL::to('buscarID/')}}',

                data:{'idCol': idCol},
                success:function(data){

                    console.log('success');

                        console.log(data);

                    console.log(Object.keys(data).length);
                      $.each(data, function(index, regenciesObj){

                            idColADD = regenciesObj[0].id;
                            nameColADD = regenciesObj[0].name;
                              document.getElementById('nameColADD').value = nameColADD;
                              console.log(nameColADD);

                      });


                },
                error:function(){

                }
            });

    }

        function buscarEmail(){

      var emailCol = document.getElementById('emailCol').value;

              console.log("TTMM");

         $.ajax({


                type:'get',
                url:'{{URL::to('buscarEmail/')}}',

                data:{'emailCol': emailCol},
                success:function(data){

                    console.log('success');

                        console.log(data);

                    console.log(Object.keys(data).length);
                      $.each(data, function(index, regenciesObj){

                            idColADD = regenciesObj[0].id;
                            nameColADD = regenciesObj[0].name;
                              document.getElementById('nameColADD').value = nameColADD;
                              console.log(nameColADD);

                      });


                },
                error:function(){

                }
            });

    }


        function buscarName(){

      var nameCol = document.getElementById('nameCol').value;

         console.log("TTMM");

         $.ajax({


                type:'get',
                url:'{{URL::to('buscarName/')}}',

                data:{},
                success:function(data){

                    console.log('success');

                        console.log(data.data);

                    console.log(Object.keys(data).length);
                      $.each(data.data, function(index, regenciesObj){

                            var compareA = nameCol.toUpperCase();
                            var compareB = regenciesObj.name.toUpperCase();


                            if ( compareA.match(compareB) ) {

                            idColADD = regenciesObj.id;
                            nameColADD = regenciesObj.name;
                              document.getElementById('nameColADD').value = nameColADD;
                              console.log(nameColADD);

                            }else{


                            }


                      });


                },
                error:function(){

                }
            });


    }


var contR= 0;


                window.onload = function() {

  var list = <?php echo json_encode($usuariosP,JSON_FORCE_OBJECT); ?>;
      //console.log(list);

      objetivosArray = <?php echo json_encode($objetivosP,JSON_FORCE_OBJECT); ?>;


      colaboradorArray = <?php echo json_encode($usuariosP,JSON_FORCE_OBJECT); ?>;

      systemUsers = <?php echo json_encode($systemUsers,JSON_FORCE_OBJECT); ?>;


      observacionesArray = <?php echo json_encode($observaciones,JSON_FORCE_OBJECT); ?>;






    cargarInterfazProfesor();

    proyectoEditarId = <?php echo $Proyecto->proyecto_investigacion_id; ?>;
     cargarObjetivosProyecto();
      cargarColaboradoresProyecto();
      cargarObservacionesProyecto();
          cargarDePropiedades();



}



    function cargarDePropiedades(){

    document.getElementById('btnModificar').disabled=true;
    document.getElementById('btnAtras').disabled=true;
    document.getElementById('btnModificarObservacion').disabled=true;
    document.getElementById('btnAtrasObservacion').disabled=true;

    }


    function cargarInterfazEstudiante(){

      document.getElementById('btnBuscarColaborador').disabled=true;
      document.getElementById('btnAgregarObservacion').disabled=true;
      document.getElementById('condicionP1').disabled=true;
      document.getElementById('condicionP2').disabled=true;
      document.getElementById('responsable').disabled=true;
      document.getElementById('estadoP').disabled=true;
      tipoUsuario = 0;
    }

    function cargarInterfazProfesor(){

      document.getElementById('condicionP1').disabled=false;
      document.getElementById('condicionP2').disabled=false;
      document.getElementById('estadoP').disabled=false;
      document.getElementById('responsable').disabled=false;
      document.getElementById('btnBuscarColaborador').disabled=false;
      document.getElementById('btnAgregarObservacion').disabled=false;
      tipoUsuario = 1;

    }


function cargarObjetivosProyecto(){

	var testVar = "";
	var numObj = Object.keys(objetivosArray).length;

	for(i=0; i<=numObj-1; i++){

			objetivosArray2.push(new Proyecto(objetivosArray[i].objetivo_proyecto_id, objetivosArray[i].objetivo_proyecto_descripcion, objetivosArray[i].objetivo_general, objetivosArray[i].estado_objetivo_id, objetivosArray[i].proyecto_investigacion_id));

	}


	var numP = Object.keys(objetivosArray2).length;
	//console.log("===========333");
	//console.log(numP);


	if(numP==0){


	}else{

	$('#tblObjetivoEspecifico').empty();
	     $('#tblObjetivoEspecifico').append('<thead>' +
                  '<th></th>' +
                    '<th>Objetivo Especifico</th>' +
                '</thead>');

	for(MP=0; MP<=numP-1; MP++){

			//console.log("===========MMMM");
			//console.log(objetivosArray2[MP].objetivo_general);

      	if (objetivosArray2[MP].objetivo_general>=1) {


      		testVar = objetivosArray2[MP].objetivo_proyecto_descripcion;


      	}else {

      		//console.log("===========333888");

      		//console.log(objetivosArray2[MP].objetivo_proyecto_id);






                $('#tblObjetivoEspecifico').append("<tr>"+
                  "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<button class='btn btn-success' type='button' onClick=editarObjetivo('"+MP+"')><span class='fa fa-edit'></span></button>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' onClick=eliminarObjetivo('"+MP+"')><span class='fa fa-trash-alt'></span></button>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+
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


  console.log("MMMTTTPPP22333_______________"+colaboradorArray[0].tipo_usuario_proyecto_id);



	if(numObj==1 && colaboradorArray[0].tipo_usuario_proyecto_id!=2){


            if(colaboradorArray[0].tipo_usuario_proyecto_id==1){


            for(sysU=0; sysU<=Object.keys(systemUsers).length-1; sysU++){

                if(systemUsers[sysU].id==colaboradorArray[0].id){

                responsableID = colaboradorArray[MP].id;
                $('#responsable').append('<option value='+systemUsers[sysU].id+' selected>'+systemUsers[sysU].name+'</option>');

                }else{
                  $('#responsable').append('<option value='+systemUsers[sysU].id+'>'+systemUsers[sysU].name+'</option>');
                }

            }

            $("#propuesto").attr("value", "Error - Sin Asignar");


            }else{


            for(sysU=0; sysU<=Object.keys(systemUsers).length-1; sysU++){

              $('#responsable').append('<option value='+systemUsers[sysU].id+'>'+systemUsers[sysU].name+'</option>');
            }

            $("#propuesto").attr("value", colaboradorArray[0].name);



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
                  '<th></th>' +
                    '<th>Colaborador</th>' +
                '</thead>');

	for(MP=0; MP<=numP-1; MP++){


                if (tipoUsuario==0){
                	//console.log(tipoUsuario);
                	//console.log("==**--")
                	$('#tblColaborador').append("<tr>"+
                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
	                "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' disabled='true'><span class='fa fa-cog'></span></button>"+
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
          '<th></th>' +
            '<th>Observaciones</th>' +
        '</thead>');

	for(MP=0; MP<=numP-1; MP++){


		if(tipoUsuario==0){


			$('#tblObservaciones').append("<tr>"+
                   "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
	                "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' disabled='false'><span class='fa fa-cog'></span></button>"+
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
                   "<td>"+ observacionesArray2[MP].observacion_proyecto_descripcion +"</td>"+

                 "</tr>");


		}else{


			  $('#tblObservaciones').append("<tr>"+
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
                   "<td>"+ observacionesArray2[MP].observacion_proyecto_descripcion +"</td>"+

                 "</tr>");

		}




      }


      // document.getElementById('GENERAL').value = testVar;

  }


}



function Proyecto(objetivo_proyecto_id, objetivo_proyecto_descripcion, objetivo_general, estado_objetivo_id, proyecto_investigacion_id) {
  this.objetivo_proyecto_id = objetivo_proyecto_id;
  this.objetivo_proyecto_descripcion = objetivo_proyecto_descripcion;
  this.objetivo_general = objetivo_general;
  this.estado_objetivo_id = estado_objetivo_id;
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

                // //console.log(obj);


 			    // var miAuto = new Proyecto(0, "objetivoDescripcion", 0, 0, 1);
 			    // var miAuto2 = new Proyecto(0, "objetivoDescripcion", 0, 0, 2);
 			    // var miAuto3 = new Proyecto(0, "objetivoDescripcion", 0, 0, 3);

 			    // obj.push(miAuto);
        //         obj.push(miAuto2);
        //         obj.push(miAuto3);

        //         //console.log(obj);








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
     			//console.log(objetivosArray2[0].objetivo_proyecto_descripcion);
     			//console.log(objetivosArray2);
                ////console.log(objetivosArray);
                $("#objetivoEsp").val("");


                for(i=0; i<=objetivosArray2.length-1; i++){



                		if (objetivosArray2[i].objetivo_general==0){

                $('#tblObjetivoEspecifico').append("<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<button class='btn btn-success' type='button' onClick=editarObjetivo('"+i+"')><span class='fa fa-edit'></span></button>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' onClick=eliminarObjetivo('"+i+"')><span class='fa fa-trash-alt'></span></button>"+
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

                  ////console.log(desObj);
                  var objetivosArrayTemp = [];
                  //console.log("=============*********//////////////////");
                  //console.log(objetivosArray2.length);
                  //console.log("=============*********//////////////////");

                  if (objetivosArray2.length<=2) {

                            //console.log(objetivosArray2);
                        $('#tblObjetivoEspecifico').empty();
                $('#tblObjetivoEspecifico').append('<thead>' +
                  '<th></th>' +
                    '<th>Objetivo Especifico</th>' +
                '</thead>');

                $('#tblObjetivoEspecifico').append("<tr>"+
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
                    "<td> Sin Objetivos</td>"+
                "<td>"+

                "</tr>");
					//console.log(objetivosArray2);
                      for(i=0; i<=objetivosArray2.length-1; i++){

                          if (i==desObj) {

                          }else{

                          		objetivosArrayTemp.push(new Proyecto(objetivosArray2[i].objetivo_proyecto_id, objetivosArray2[i].objetivo_proyecto_descripcion, objetivosArray2[i].objetivo_general, objetivosArray2[i].estado_objetivo_id, objetivosArray2[i].proyecto_investigacion_id));

                          }

                      }

                      objetivosArray2 = [];

                      for(i=0; i<=objetivosArrayTemp.length-1; i++){


                              objetivosArray2.push(new Proyecto(objetivosArrayTemp[i].objetivo_proyecto_id, objetivosArrayTemp[i].objetivo_proyecto_descripcion, objetivosArrayTemp[i].objetivo_general, objetivosArrayTemp[i].estado_objetivo_id, objetivosArrayTemp[i].proyecto_investigacion_id));


                      }


                      objetivosArrayTemp = [];
                      //console.log(objetivosArray2);

                  }else{


                      //console.log(objetivosArray2);
                      for(i=0; i<=objetivosArray2.length-1; i++){

                          if (i==desObj) {

                          }else{

                          		objetivosArrayTemp.push(new Proyecto(objetivosArray2[i].objetivo_proyecto_id, objetivosArray2[i].objetivo_proyecto_descripcion, objetivosArray2[i].objetivo_general, objetivosArray2[i].estado_objetivo_id, objetivosArray2[i].proyecto_investigacion_id));

                          }

                      }

                      objetivosArray2 = [];

                      for(i=0; i<=objetivosArrayTemp.length-1; i++){


                              objetivosArray2.push(new Proyecto(objetivosArrayTemp[i].objetivo_proyecto_id, objetivosArrayTemp[i].objetivo_proyecto_descripcion, objetivosArrayTemp[i].objetivo_general, objetivosArrayTemp[i].estado_objetivo_id, objetivosArrayTemp[i].proyecto_investigacion_id));


                      }


                      objetivosArrayTemp = [];
                      //console.log("MMMMMMMMMMMMMMMMMMM");
                      //console.log(objetivosArray2);

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
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<button class='btn btn-success' type='button' onClick=editarObjetivo('"+i+"')><span class='fa fa-edit'></span></button>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' onClick=eliminarObjetivo('"+i+"')><span class='fa fa-trash-alt'></span></button>"+
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



function editarObjetivo(objetivoEditar){

document.getElementById('btnAgregarObjetivo').disabled=true;
document.getElementById('btnModificar').disabled=false;
document.getElementById('btnAtras').disabled=false;
$("#objetivoEsp").val(objetivosArray2[objetivoEditar].objetivo_proyecto_descripcion);


	//console.log(objetivoEditar);
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

      	//console.log("========================");
      	//console.log(objetivosArray2[t].objetivo_proyecto_descripcion);


      if (objetivoEditando==t&&objetivosArray2[t].objetivo_general==0) {


      			//console.log(objetivosArray2[t].objetivo_proyecto_descripcion);
      			objetivosArray2[t].objetivo_proyecto_descripcion = objetivoDescripcion2;


      }



      if(objetivosArray2[t].objetivo_general==0) {




         $('#tblObjetivoEspecifico').append("<tr>"+
      "<td>"+
      "<div class='dropdown table-actions-dropdown'>"+
                                "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                    "<li>"+
                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                        "<button class='btn btn-success' type='button' onClick=editarObjetivo('"+t+"')><span class='fa fa-edit'></span></button>"+
                                        "</span>"+
                                        "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                        "<button class='btn btn-danger'  type='button' onClick=eliminarObjetivo('"+t+"')><span class='fa fa-trash-alt'></span></button>"+
                                        "</span>"+
                                    "</li>"+
                                "</ul>"+
                            "</div>"+
       "</td>"+
       "<td>"+ objetivosArray2[t].objetivo_proyecto_descripcion +"</td>"+

     "</tr>");


    			//console.log("========================22");
    			//console.log(objetivosArray2[t].objetivo_proyecto_descripcion);

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



/*

Seccion Observaciones


*/



function observacionProyecto(observacion_proyecto_id, observacion_proyecto_descripcion, proyecto_investigacion_id) {
  this.observacion_proyecto_id = observacion_proyecto_id;
  this.observacion_proyecto_descripcion = observacion_proyecto_descripcion;
  this.proyecto_investigacion_id = proyecto_investigacion_id;
}

    function cargarObservacion()
                {



                var observacionDescripcion = $('#txtObservacionP').val();
                //console.log($('#txtObservacionP').val());

                if (observacionDescripcion.trim()==""){
                  alert("No se puede agregar una observacion vacia!")
                }else{



                var obj = [];




                $('#tblObservaciones').empty();
                $('#tblObservaciones').append('<thead>' +
                  '<th></th>' +
                    '<th>Observacion</th>' +
                '</thead>');

          var objetivoDescripcion = $('#txtObservacionP').val();

          observacionesArray2.push(new observacionProyecto(0, objetivoDescripcion, 0));

          //console.log(observacionesArray2[0].observacion_proyecto_descripcion);
          //console.log(observacionesArray2);

                $("#txtObservacionP").val("");

                var observacionParaGuardar = "";


                for(i=0; i<=Object.keys(observacionesArray2).length-1; i++){


                  observacionParaGuardar.trim();
                  observacionParaGuardar=observacionesArray2[i].observacion_proyecto_descripcion;

                  //console.log("<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                  // "<button class='btn btn-success' type='button' onClick=editarObservacion('"+i+"')><span class='fa fa-edit'></span></button>"+
                  // "</span>");
                $('#tblObservaciones').append("<tr>"+
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
                    "<td>"+ observacionesArray2[i].observacion_proyecto_descripcion +"</td>"+
                "<td>"+

                "</tr>");




              }

          }


                }


function eliminarObservacion(desObj)
                {

                  ////console.log(desObj);
                  var observacionesArrayTemp = [];
                  //console.log("===observacionesArray2==========*********//////////////////");
                  //console.log(observacionesArray2.length);
                  //console.log("=============*********//////////////////");

                  if (observacionesArray2.length<=1) {

                            //console.log(observacionesArray2);
                        $('#tblObservaciones').empty();
                $('#tblObservaciones').append('<thead>' +
                  '<th></th>' +
                    '<th>Observacion</th>' +
                '</thead>');

                $('#tblObservaciones').append("<tr>"+
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
          //console.log(observacionesArray2);
                      for(i=0; i<=observacionesArray2.length-1; i++){

                          if (i==desObj) {

                          }else{

                              observacionesArrayTemp.push(new observacionProyecto(observacionesArray2[i].observacion_proyecto_id, observacionesArray2[i].observacion_proyecto_descripcion, observacionesArray2[i].proyecto_investigacion_id));

                          }

                      }



                      observacionesArray2 = [];

                      for(i=0; i<=observacionesArrayTemp.length-1; i++){


                              observacionesArray2.push(new observacionProyecto(observacionesArrayTemp[i].observacion_proyecto_id, observacionesArrayTemp[i].observacion_proyecto_descripcion, observacionesArrayTemp[i].proyecto_investigacion_id));


                      }


                      observacionesArrayTemp = [];
                      //console.log(observacionesArray2);

                  }else{


                      //console.log(observacionesArray2);
                      for(i=0; i<=observacionesArray2.length-1; i++){

                          if (i==desObj) {

                          }else{

                              observacionesArrayTemp.push(new observacionProyecto(observacionesArray2[i].observacion_proyecto_id, observacionesArray2[i].observacion_proyecto_descripcion, observacionesArray2[i].proyecto_investigacion_id));

                          }

                      }

                      observacionesArray2 = [];

                      for(i=0; i<=observacionesArrayTemp.length-1; i++){


                              observacionesArray2.push(new observacionProyecto(observacionesArrayTemp[i].observacion_proyecto_id, observacionesArrayTemp[i].observacion_proyecto_descripcion, observacionesArrayTemp[i].proyecto_investigacion_id));


                      }


                      observacionesArrayTemp = [];
                      //console.log("MMMMMMMMMMMMMMMMMMM");
                      //console.log(observacionesArray2);

                       $('#tblObservaciones').empty();
                $('#tblObservaciones').append('<thead>' +
                  '<th></th>' +
                    '<th>Observacion</th>' +
                '</thead>');


                for(i=0; i<=observacionesArray2.length-1; i++){



                $('#tblObservaciones').append("<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<button class='btn btn-success' type='button' onClick=editarObservacion("+i+")><span class='fa fa-edit'></span></button>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' onClick=eliminarObservacion("+i+")><span class='fa fa-trash-alt'></span></button>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+
                    "<td>"+ observacionesArray2[i].observacion_proyecto_descripcion +"</td>"+

                "</tr>");



          }

                  }




                }


                var editandoObservacion = 0;

function editarObservacion(observacionEditar){

  if (editandoObservacion == 0){

document.getElementById('btnAgregarObservacion').disabled=true;
document.getElementById('btnModificarObservacion').disabled=false;
document.getElementById('btnAtrasObservacion').disabled=false;
document.getElementById('tblObservaciones').disabled=true;
         $('tblObservaciones').prop('disabled', true);




  //console.log(observacionesArray2[observacionEditar].observacion_proyecto_descripcion);
  observacionEditando = observacionesArray2[observacionEditar].observacion_proyecto_descripcion;
  $("#txtObservacionP").val(observacionEditando);
    editandoObservacion = 1;

}else{
  alert("No se puede modificar estar observacion hasta que termine de editar la actual!");
}

}

function modificarObservacion(){


  var observacionParaGuardar = "";


  var observacionDescripcion2 = $('#txtObservacionP').val();
    $('#tblObservaciones').empty();
    $('#tblObservaciones').append('<thead>' +
      '<th></th>' +
        '<th>Observacion</th>' +
    '</thead>');

      for(t=0; t<=observacionesArray2.length-1; t++){

        //console.log("========================");
        //console.log(observacionesArray2[t].objetivo_proyecto_descripcion);


      if (observacionEditando==observacionesArray2[t].observacion_proyecto_descripcion) {


            //console.log(observacionesArray2[t].objetivo_proyecto_descripcion);
            observacionesArray2[t].observacion_proyecto_descripcion = observacionDescripcion2;


      }




      observacionParaGuardar = observacionesArray2[t].observacion_proyecto_descripcion;



         $('#tblObservaciones').append("<tr>"+
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
       "<td>"+ observacionesArray2[t].observacion_proyecto_descripcion +"</td>"+

     "</tr>");

          editandoObservacion = 0;
          //console.log("========================22");
          //console.log(observacionesArray2[t].observacion_proyecto_descripcion);





  }

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

}





/*

Seccion Usuario Proyecto: Colaborador


*/

function UsuarioProCol(usuario_proyecto_id, users_id, name, tipo_usuario_proyecto_id, proyecto_investigacion_id) {

  this.usuario_proyecto_id = usuario_proyecto_id;
  this.users_id = users_id;
  this.name = name;
  this.tipo_usuario_proyecto_id = tipo_usuario_proyecto_id;
  this.proyecto_investigacion_id = proyecto_investigacion_id;

}


    function cargarUsuarioCol()
                {



                var nameUserADD = $('#nameColADD').val();
                //console.log($('#nameColADD').val());

                if (nameUserADD==""){
                  alert("No se puede agregar un usuario sin buscarlo!")
                }else{



                var obj = [];




                $('#tblColaborador').empty();
                $('#tblColaborador').append('<thead>' +
                  '<th></th>' +
                    '<th>Colaborador</th>' +
                '</thead>');



          colaboradorArray2.push(new UsuarioProCol(0, idColADD, nameColADD, 2, 0));

          //console.log(colaboradorArray2[0].name);
          //console.log(colaboradorArray2);




                for(i=0; i<=colaboradorArray2.length-1; i++){


                  //console.log("<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                  //"<button class='btn btn-success' type='button' onClick=editarObservacion('"+i+"')><span class='fa fa-edit'></span></button>"+
                  //"</span>");
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

                  ////console.log(desObj);
                  var colaboradorArrayTemp = [];
                  //console.log("===colaboradorArray2==========*********//////////////////");
                  //console.log(colaboradorArray2.length);
                  //console.log("=============*********//////////////////");

                  if (colaboradorArray2.length<=1) {

                            //console.log(colaboradorArray2);
                        $('#tblColaborador').empty();
                $('#tblColaborador').append('<thead>' +
                  '<th></th>' +
                    '<th>Colaborador</th>' +
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
                    "<td> Sin Colaborador Agregado</td>"+
                "<td>"+

                "</tr>");
          console.log(desObj);
                      for(i=0; i<=colaboradorArray2.length-1; i++){

                          if (i==desObj) {

                          }else{

                              colaboradorArrayTemp.push(new UsuarioProCol(colaboradorArray2[i].usuario_proyecto_id, colaboradorArray2[i].users_id, colaboradorArray2[i].name, colaboradorArray2[i].tipo_usuario_proyecto_id, colaboradorArray2[i].proyecto_investigacion_id));

                          }

                      }

                      colaboradorArray2 = [];

                      for(i=0; i<=colaboradorArrayTemp.length-1; i++){


                              colaboradorArray2.push(new UsuarioProCol(colaboradorArrayTemp[i].usuario_proyecto_id, colaboradorArrayTemp[i].users_id, colaboradorArrayTemp[i].name, colaboradorArrayTemp[i].tipo_usuario_proyecto_id, colaboradorArrayTemp[i].proyecto_investigacion_id));


                      }


                      colaboradorArrayTemp = [];
                      //console.log(colaboradorArray2);

                  }else{


                      //console.log(colaboradorArray2);
                      for(i=0; i<=colaboradorArray2.length-1; i++){

                          if (i==desObj) {

                          }else{

                              colaboradorArrayTemp.push(new UsuarioProCol(colaboradorArray2[i].usuario_proyecto_id, colaboradorArray2[i].users_id, colaboradorArray2[i].name, colaboradorArray2[i].tipo_usuario_proyecto_id, colaboradorArray2[i].proyecto_investigacion_id));

                          }

                      }

                      colaboradorArray2 = [];

                      for(i=0; i<=colaboradorArrayTemp.length-1; i++){


                              colaboradorArray2.push(new UsuarioProCol(colaboradorArrayTemp[i].usuario_proyecto_id, colaboradorArrayTemp[i].users_id, colaboradorArrayTemp[i].name, colaboradorArrayTemp[i].tipo_usuario_proyecto_id, colaboradorArrayTemp[i].proyecto_investigacion_id));


                      }


                      colaboradorArrayTemp = [];
                      //console.log("MMMMMMMMMMMMMMMMMMM");
                      //console.log(colaboradorArray2);

                       $('#tblColaborador').empty();
                $('#tblColaborador').append('<thead>' +
                  '<th></th>' +
                    '<th>Colaborador</th>' +
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



function isValidLicenseNo(text) {
    if(text.length < 2) return text.match(/(^[0-9]{0,1})$/);
    return text.match(/(^[0-9]{2}\d{0,6}$)/);
}



function probarReDirec(){
  window.location.href = "redirectUser/";
}


function modificarProyectoProfesorAdminMM() {



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
var condicionPro = 0;
var estado = $('#estadoP').val();
var proyectoId = 0;
var responsable = $('#responsable').val();

if (document.getElementById('condicionP1').checked==true){
          condicionPro = document.getElementById('condicionP1').value;
}else if (document.getElementById('condicionP2').checked==true){
          condicionPro = document.getElementById('condicionP2').value;
}




//console.log(sedeProyecto);
//console.log('====');
//console.log(nombreProyecto);




                if (Object.keys(observacionesArray2).length==0){
                		console.log("MOP1");
                }else{


                //for each para guardar todos los observaciones
                //observacionesArray
                $.each(observacionesArray2, function(index, observacionADD){


            if(observacionADD.observacion_proyecto_id==0){

            	$.ajax({


                type:'get',
                url:'{{URL::to('guardarObservaciones/')}}',

                data:{'observacion_proyecto_descripcion': observacionADD.observacion_proyecto_descripcion, 'proyecto_investigacion_id': proyectoEditarId},
                success:function(data){

                    //proceso de insercesion de datos
                    //console.log(data);
                    console.log("MOP2");



                },
                error:function(){

                }
               });

            }else{

                $.ajax({


                type:'get',
                url:'{{URL::to('modificarObservaciones/')}}',

                data:{'observacion_proyecto_id': observacionADD.observacion_proyecto_id, 'observacion_proyecto_descripcion': observacionADD.observacion_proyecto_descripcion},
                success:function(data){

                    //proceso de insercesion de datos
                    //console.log(data);
                    console.log("MOP3");



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

        				if (observacionSAVED2.observacion_proyecto_id!=0){

        					if (observacionSAVED2.observacion_proyecto_id==observacionSAVED.observacion_proyecto_id){

        					obsEncontrada = 1;

        				     }

        				}else{
        					obsEncontrada = 1;
        				}



	        		});



	        		    if(obsEncontrada==0){

			        		observacionDeleted.push(observacionSAVED.observacion_proyecto_id);

	        			}else{

	        				obsEncontrada=0;

	        			}

        		});

        		console.log(observacionDeleted);


    			$.each(observacionDeleted, function(index, observacionDEL){


        				$.ajax({


			            type:'get',
			            url:'{{URL::to('eliminarObservacion/')}}',

			            data:{'observacion_proyecto_id': observacionDEL},
			            success:function(data){

			                //proceso de insercesion de datos
			                //console.log(data);




			            },
			            error:function(){

			            }
			           	});


        		});




    		}


}


function modificarProyectoProfesorAdmin() {



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
var condicionPro = 0;
var estado = $('#estadoP').val();
var proyectoId = 0;
var responsable = $('#responsable').val();

if (document.getElementById('condicionP1').checked==true){
          condicionPro = document.getElementById('condicionP1').value;
}else if (document.getElementById('condicionP2').checked==true){
          condicionPro = document.getElementById('condicionP2').value;
}




//console.log(sedeProyecto);
//console.log('====');
//console.log(nombreProyecto);


  if(parseInt(sedeProyecto)==0){
    alert("Debe seleccionar la sede del proyecto!");
  }else if(parseInt(carreraProyecto)=="0"){
    alert("Debe seleccionar la carrera del proyecto!");
  }else if(parseInt(tipoProyecto)==0){
    alert("Debe seleccionar el tipo de proyecto!");
  }else if(parseInt(estado)==0){
    alert("Debe seleccionar el estado del proyecto!");
  }else if(parseInt(responsable)==0){
    alert("Debe seleccionar un responsable para el proyecto!");
  }else if(presupuesto===""){
    alert("Debe ingresar el presupuesto del proyecto o ingresar 0 si no lo requiere!");
  }else if(nombreProyecto===""){
    alert("Debe ingresar el nombre del proyecto!");
  }else if(beneficiario===""){
    alert("Debe ingresar el beneficiario del proyecto!");
  }else if(metodologia===""){
    alert("Debe ingresar la metodologia del proyecto!");
  }else if(JUSTIFICACION.trim()==""){
    alert("Debe ingresar la justificacion del proyecto!");
  }else if(GENERAL.trim()==""){
    alert("Debe ingresar el objetivo general del proyecto!");
  }else if(Object.keys(objetivosArray2).length==0){
    alert("Debe ingresar objetivos especificos al proyecto!");
  }else{


                $.ajax({



                type:'get',
                url:'{{URL::to('modificarProyecto/')}}',

                data:{'proyecto_investigacion_id': proyectoEditarId, 'sede_id': sedeProyecto, 'id_carreras_ulatina': carreraProyecto, 'llaveAlmacenamiento': propuestoid, 'nombre_proyecto': nombreProyecto, 'beneficiario': beneficiario, 'metodologia': metodologia, 'presupuesto': presupuesto, 'justificacion': JUSTIFICACION, 'estado_proyecto_id': estado, 'tipo_proyecto_id': tipoProyecto, 'condicion_proyecto_id': condicionPro},
                success:function(data){


                      //console.log('success420');
                      //console.log(propuestoid);
                      //proyectoId = data[0].proyecto_investigacion_id;
                      //console.log(data[0].proyecto_investigacion_id);
                	  //window.location.href = "redirectUser/";

                },
                error:function(){

                }
            	});





                if (Object.keys(objetivosArray2).length==0){

                }else{


                //for each para guardar todos los objetivos
                //objetivosArray
                $.each(objetivosArray2, function(index, objetivoEspFIND){


                if(objetivoEspFIND.objetivo_proyecto_id == 0){

                	$.ajax({


                type:'get',
                url:'{{URL::to('guardarObjetivoEspecifico/')}}',

                data:{'objetivo_proyecto_descripcion': objetivoEspFIND.objetivo_proyecto_descripcion, 'objetivo_general': objetivoEspFIND.objetivo_general, 'estado_objetivo_id': objetivoEspFIND.estado_objetivo_id, 'proyecto_investigacion_id': proyectoEditarId},
                success:function(data){

                    //proceso de insercesion de datos
                    //console.log(data);




                },
                error:function(){

                }
               });

                }else{


                $.ajax({


                type:'get',
                url:'{{URL::to('modificarObjetivoEspecifico/')}}',

                data:{'objetivo_proyecto_id': objetivoEspFIND.objetivo_proyecto_id, 'objetivo_proyecto_descripcion': objetivoEspFIND.objetivo_proyecto_descripcion},
                success:function(data){

                    //proceso de insercesion de datos
                    //console.log(data);


                },
                error:function(){

                }
               });

            }




              });




            	console.log(objetivosArray);
              	console.log(objetivosArray2);

                var objetivoDeleted = [];
                var objetivoEncontrado=0;



        		$.each(objetivosArray, function(index, objetivoSAVED){





	        			$.each(objetivosArray2, function(index, objetivoSAVED2){

	        				if (objetivoSAVED2.objetivo_proyecto_id!=0){

	        					if (objetivoSAVED2.objetivo_proyecto_id==objetivoSAVED.objetivo_proyecto_id){

	        					objetivoEncontrado = 1;

	        				     }

	        				}else{
	        					objetivoEncontrado = 1;
	        				}



		        		});



		        		    if(objetivoEncontrado==0){

				        		objetivoDeleted.push(objetivoSAVED.objetivo_proyecto_id);

		        			}else{

		        				objetivoEncontrado=0;

		        			}




        		});

        		console.log(objetivoDeleted);


    			$.each(objetivoDeleted, function(index, objetivoDEL){


            			$.ajax({


			                type:'get',
			                url:'{{URL::to('eliminarObjetivoEspecifico/')}}',

			                data:{'objetivo_proyecto_id': objetivoDEL},
			                success:function(data){

			                    //proceso de insercesion de datos
			                    //console.log(data);




			                },
			                error:function(){

			                }
		               	});


        		});



    		}




            	if (Object.keys(colaboradorArray2).length==0){



                console.log("LDA 666");
                $.each(colaboradorArray, function(index, colaboradorDELL){


                if(colaboradorDELL.tipo_usuario_proyecto_id==2){

                      console.log(colaboradorDELL.users_id);

                  $.ajax({


                      type:'get',
                      url:'{{URL::to('eliminarColaborador/')}}',

                      data:{'usuario_proyecto_id': colaboradorDELL.usuario_proyecto_id},
                      success:function(data){

                          //proceso de insercesion de datos
                          //console.log(data);




                      },
                      error:function(){

                      }
                    });


                }

                });

                console.log("LDA 666");



                }else{


                 //for each para guardar todos los colaboradores
                //colaboradorArray2
                $.each(colaboradorArray2, function(index, colaboradorADD){


                if(colaboradorADD.usuario_proyecto_id==0 && colaboradorADD.tipo_usuario_proyecto_id==2){

                $.ajax({


                type:'get',
                url:'{{URL::to('guardarColaborador/')}}',

                data:{'users_id': colaboradorADD.users_id, 'tipo_usuario_proyecto_id': colaboradorADD.tipo_usuario_proyecto_id, 'proyecto_investigacion_id': proyectoEditarId},
                success:function(data){

                    //proceso de insercesion de datos
                    //console.log(data);




                },
                error:function(){

                }

               });

            }




              });





              	console.log(colaboradorArray);

              	//console.log(observacionesArray2);

                var colaboradorDeleted = [];
                var colaboradorEncontrado=0;



        		$.each(colaboradorArray, function(index, colaboradorSAVED){


        			if (colaboradorSAVED.tipo_usuario_proyecto_id==2){


	        			$.each(colaboradorArray2, function(index, colaboradorSAVED2){

	        				if (colaboradorSAVED2.usuario_proyecto_id!=0){

	        					if (colaboradorSAVED2.usuario_proyecto_id==colaboradorSAVED.usuario_proyecto_id){

	        					colaboradorEncontrado = 1;

	        				     }

	        				}else{
	        					colaboradorEncontrado = 1;
	        				}



		        		});



		        		    if(colaboradorEncontrado==0){

				        		colaboradorDeleted.push(colaboradorSAVED.usuario_proyecto_id);

		        			}else{

		        				colaboradorEncontrado=0;

		        			}

	        		}


        		});

        		console.log(colaboradorDeleted);
            console.log("LDA");


    			$.each(colaboradorDeleted, function(index, colaboradorDEL){


            			$.ajax({


			                type:'get',
			                url:'{{URL::to('eliminarColaborador/')}}',

			                data:{'usuario_proyecto_id': colaboradorDEL},
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


            if(observacionADD.observacion_proyecto_id==0){

            	$.ajax({


                type:'get',
                url:'{{URL::to('guardarObservaciones/')}}',

                data:{'observacion_proyecto_descripcion': observacionADD.observacion_proyecto_descripcion, 'proyecto_investigacion_id': proyectoEditarId},
                success:function(data){

                    //proceso de insercesion de datos
                    //console.log(data);
                    console.log("MOP2");



                },
                error:function(){

                }
               });

            }else{

                $.ajax({


                type:'get',
                url:'{{URL::to('modificarObservaciones/')}}',

                data:{'observacion_proyecto_id': observacionADD.observacion_proyecto_id, 'observacion_proyecto_descripcion': observacionADD.observacion_proyecto_descripcion},
                success:function(data){

                    //proceso de insercesion de datos
                    //console.log(data);
                    console.log("MOP3");



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

        				if (observacionSAVED2.observacion_proyecto_id!=0){

        					if (observacionSAVED2.observacion_proyecto_id==observacionSAVED.observacion_proyecto_id){

        					obsEncontrada = 1;

        				     }

        				}else{
        					obsEncontrada = 1;
        				}



	        		});



	        		    if(obsEncontrada==0){

			        		observacionDeleted.push(observacionSAVED.observacion_proyecto_id);

	        			}else{

	        				obsEncontrada=0;

	        			}

        		});

        		console.log(observacionDeleted);


    			$.each(observacionDeleted, function(index, observacionDEL){


        				$.ajax({


			            type:'get',
			            url:'{{URL::to('eliminarObservacion/')}}',

			            data:{'observacion_proyecto_id': observacionDEL},
			            success:function(data){

			                //proceso de insercesion de datos
			                //console.log(data);




			            },
			            error:function(){

			            }
			           	});


        		});




    		}


              if (responsableID==responsable){

              		//window.location.href = "redirectUser/";

              }else{


              	$.ajax({


                type:'get',
                url:'{{URL::to('modificarResponsableProyectoProfeAdmin/')}}',

                data:{'responsable': responsable, 'proyecto_investigacion_id': proyectoEditarId},
                success:function(data){

                    //proceso de insercesion de datos
                    alert(data);

                    //window.location.href = "redirectUser/";
                    //window.location.href = "/ModuloIE/Proyecto/redirectUser/";


                },
                error:function(){

                }
               });


              }


                             $.ajax({


                type:'get',
                url:'{{URL::to('modificarObjetivoGeneral/')}}',

                data:{'objetivo_proyecto_descripcion': GENERAL, 'proyecto_investigacion_id': proyectoEditarId},
                success:function(data){

                    //proceso de insercesion de datos
                    //console.log(data);
                    //window.location.href = "redirectUser/";



                },
                error:function(){

                }
                });

                $.ajax();
               $.ajax(window.location.href = getURLFromBrowser()+"ModuloIE/Proyecto/redirectUser");

              }



}



function modificarProyectoEstudiante() {



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
var condicionPro = 0;
var estado = $('#estadoP').val();
var proyectoId = 0;
var responsable = $('#responsable').val();

if (document.getElementById('condicionP1').checked==true){
          condicionPro = document.getElementById('condicionP1').value;
}else if (document.getElementById('condicionP2').checked==true){
          condicionPro = document.getElementById('condicionP2').value;
}




//console.log(sedeProyecto);
//console.log('====');
//console.log(nombreProyecto);


  if(parseInt(sedeProyecto)==0){
    alert("Debe seleccionar la sede del proyecto!");
  }else if(parseInt(carreraProyecto)==0){
    alert("Debe seleccionar la carrera del proyecto!");
  }else if(parseInt(tipoProyecto)==0){
    alert("Debe seleccionar el tipo de proyecto!");
  }else if(presupuesto===""){
    alert("Debe ingresar el presupuesto del proyecto o ingresar 0 si no lo requiere!");
  }else if(nombreProyecto===""){
    alert("Debe ingresar el nombre del proyecto!");
  }else if(beneficiario===""){
    alert("Debe ingresar el beneficiario del proyecto!");
  }else if(metodologia===""){
    alert("Debe ingresar la metodologia del proyecto!");
  }else if(JUSTIFICACION.trim()==""){
    alert("Debe ingresar la justificacion del proyecto!");
  }else if(GENERAL.trim()==""){
    alert("Debe ingresar el objetivo general del proyecto!");
  }else if(Object.keys(objetivosArray2).length==0){
    alert("Debe ingresar objetivos especificos al proyecto!");
  }else{


                $.ajax({



                type:'get',
                url:'{{URL::to('modificarProyecto/')}}',

                data:{'proyecto_investigacion_id': proyectoEditarId, 'sede_id': sedeProyecto, 'id_carreras_ulatina': carreraProyecto, 'llaveAlmacenamiento': propuestoid, 'nombre_proyecto': nombreProyecto, 'beneficiario': beneficiario, 'metodologia': metodologia, 'presupuesto': presupuesto, 'justificacion': JUSTIFICACION, 'estado_proyecto_id': estado, 'tipo_proyecto_id': tipoProyecto, 'condicion_proyecto_id': condicionPro},
                success:function(data){


                      //console.log('success420');
                      //console.log(propuestoid);
                      //proyectoId = data[0].proyecto_investigacion_id;
                      //console.log(data[0].proyecto_investigacion_id);
                	  //window.location.href = "redirectUser/";

                },
                error:function(){

                }
            	});




                              if (Object.keys(objetivosArray2).length==0){

                }else{


                //for each para guardar todos los objetivos
                //objetivosArray
                $.each(objetivosArray2, function(index, objetivoEspFIND){


                if(objetivoEspFIND.objetivo_proyecto_id == 0){

                	$.ajax({


                type:'get',
                url:'{{URL::to('guardarObjetivoEspecifico/')}}',

                data:{'objetivo_proyecto_descripcion': objetivoEspFIND.objetivo_proyecto_descripcion, 'objetivo_general': objetivoEspFIND.objetivo_general, 'estado_objetivo_id': objetivoEspFIND.estado_objetivo_id, 'proyecto_investigacion_id': proyectoEditarId},
                success:function(data){

                    //proceso de insercesion de datos
                    //console.log(data);




                },
                error:function(){

                }
               });

                }else{


                $.ajax({


                type:'get',
                url:'{{URL::to('modificarObjetivoEspecifico/')}}',

                data:{'objetivo_proyecto_id': objetivoEspFIND.objetivo_proyecto_id, 'objetivo_proyecto_descripcion': objetivoEspFIND.objetivo_proyecto_descripcion},
                success:function(data){

                    //proceso de insercesion de datos
                    //console.log(data);


                },
                error:function(){

                }
               });

            }




              });




            	console.log(objetivosArray);
              	console.log(objetivosArray2);

                var objetivoDeleted = [];
                var objetivoEncontrado=0;



        		$.each(objetivosArray, function(index, objetivoSAVED){





	        			$.each(objetivosArray2, function(index, objetivoSAVED2){

	        				if (objetivoSAVED2.objetivo_proyecto_id!=0){

	        					if (objetivoSAVED2.objetivo_proyecto_id==objetivoSAVED.objetivo_proyecto_id){

	        					objetivoEncontrado = 1;

	        				     }

	        				}else{
	        					objetivoEncontrado = 1;
	        				}



		        		});



		        		    if(objetivoEncontrado==0){

				        		objetivoDeleted.push(objetivoSAVED.objetivo_proyecto_id);

		        			}else{

		        				objetivoEncontrado=0;

		        			}




        		});

        		console.log(objetivoDeleted);


    			$.each(objetivoDeleted, function(index, objetivoDEL){


            			$.ajax({


			                type:'get',
			                url:'{{URL::to('eliminarObjetivoEspecifico/')}}',

			                data:{'objetivo_proyecto_id': objetivoDEL},
			                success:function(data){

			                    //proceso de insercesion de datos
			                    //console.log(data);




			                },
			                error:function(){

			                }
		               	});


        		});



    		}


    		               $.ajax({


                type:'get',
                url:'{{URL::to('modificarObjetivoGeneral/')}}',

                data:{'objetivo_proyecto_descripcion': GENERAL, 'proyecto_investigacion_id': proyectoEditarId},
                success:function(data){

                    //proceso de insercesion de datos
                    //console.log(data);
                    //window.location.href = "redirectUser/";



                },
                error:function(){

                }
                });


    		    $.ajax();
    		    $.ajax(window.location.href = getURLFromBrowser()+"ModuloIE/Proyecto/redirectUser");

          }

}


function getURLFromBrowser() {

var URLactual = window.location;
var str = URLactual.toString();
var n = str.search("ModuloIE");
var imp = str.substring(0, n);
return imp;

}


function goBack() {

      window.location = getURLFromBrowser()+'ModuloIE/Proyecto/redirectUser';
}






</script>
