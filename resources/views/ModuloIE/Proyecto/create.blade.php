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
                  <h3>Proponer Proyecto</h3>
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
                <option value="{{$sede->id_sedes}}">{{$sede->nombre_sedes}}</option>
                @endforeach

                </select>


                </div>


                <div class="form-group">


                  <label>Carrera</label>
                  <br>

                  <select name="carreraProyecto" id="carreraProyecto" class="form-control">

                  <option value="0">Seleccionar Carrera</option>

                  @foreach($carreras as $carrera)
                  <option value="{{$carrera->id_carreras_ulatina}}">{{$carrera->nombre_carreras_ulatina}}</option>
                  @endforeach

                 </select>


                </div>

                <div class="form-group">
                  <?php
                        $idUser = Auth::user()->id;
                        $name = Auth::user()->email;

                        ?>
                  <label>Propuesto</label>
                  <br>
              <input type="text" id="propuesto" name="propuesto" class="form-control" readonly="true">
                </div>


                <div class="form-group">
                  <label>Tipo De Proyecto</label>
                  <br>
                <select name="tipoProyecto" id="tipoProyecto" class="form-control">

                <option value="0">Seleccionar Tipo De Proyecto</option>

                 @foreach($tipo as $tp)
                <option value="{{$tp->tipo_proyecto_id}}">{{$tp->tipo_proyecto_descripcion}}</option>
                @endforeach


                </select>


                </div>


                <div class="form-group">
                  <label>Nombre del Proyecto</label>
                  <br>
              <input type="text" id="nombreProyecto" name="nombreProyecto" class="form-control" placeholder="Nombre del Proyecto. . . ">
                </div>


                <div class="form-group">
                  <label>Beneficiario del Proyecto</label>
                  <br>
              <input type="text" id="beneficiario" name="beneficiario" class="form-control" placeholder="Beneficiario del Proyecto. . . " >
                </div>


                <div class="form-group">
                  <label>Metodologia</label>
                  <br>
              <input type="text" id="metodologia" name="metodologia" class="form-control" placeholder="Metodologia del Proyecto. . . " >
                </div>

                <div class="form-group">
                  <label>Presupuesto</label>
                  <br>
              <input type="text" id="presupuesto" name="presupuesto" class="form-control" onkeypress="return soloNumeros(event)" placeholder="Presupuesto del Proyecto. . . " >
                </div>

                  <div class="form-group">
              <label for="JUSTIFICACION">Justificacion</label>
              <br>
              <TEXTAREA class="form-control" NAME="JUSTIFICACION" id="JUSTIFICACION" placeholder="Ingrese una justificacion para Proyecto. . . "> </TEXTAREA>
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
              <p><input type="text" id="objetivoEsp" name="objetivoEsp" class="form-control" placeholder="Ingrese Objetivo Especifico. . . ">
                    <a><button type="button" id="btnAgregarObjetivo" class="btn btn-primary" onClick=cargarObjetivo() hidden="true"><span class="fa fa-plus"></span></button></a>
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

                @if(isset($objetivos))
                    @foreach($objetivos as $objetivo)
                <tr>
 <td>
             <div class="dropdown table-actions-dropdown">
              <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></button>
              <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Editar">
                    <a href="#"><button class="btn btn-success" disabled="true"><span class='fa fa-edit' disabled="true"></span></button></a>
                  </span>

                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
                    <a href="" data-target="#modal-delete-" data-toggle="modal" disabled="true"><button class="btn btn-danger" disabled="true"><span class='fa fa-trash-alt'></span></button></a>
                  </span>
              </ul>
         </div>

    </td>
                    <td> <?php echo $objetivo ?></td>
                </tr>
                    @endforeach
                @else

                <tr>
                  <td>
             <div class="dropdown table-actions-dropdown">
              <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></button>
              <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Editar">
                    <a href="#"><button class="btn btn-success" disabled="true"><span class='fa fa-edit' disabled="true"></span></button></a>
                  </span>

                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Eliminar">
                    <a href="" data-target="#modal-delete-" data-toggle="modal" disabled="true"><button class="btn btn-danger" disabled="true"><span class='fa fa-trash-alt'></span></button></a>
                  </span>
              </ul>
         </div>

    </td>
                    <td> Sin Objetivos Agregados</td>
                </tr>


                @endif
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
                    <td> Sin Colaborador Agregado</td>
                </tr>

                @endif
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




                <div class="form-group" id="condicionP" name="condicionP">
              <label>Condicion del Proyecto</label>
              <br>
                <input type="radio" id="condicionP1" name="condicionP1" value="1"  onclick="privadoRB()" checked> PRIVADO
          &nbsp;&nbsp;&nbsp;<input type="radio" id="condicionP2" name="condicionP2" value="2" onclick="publicoRB()"> PUBLICO<br>
            </div>

            <div class="form-group">
                  <label>Estado Del Proyecto</label>
                  <br>
                <select name="estadoP" id="estadoP" class="form-control">

                <option value="0">Estado Del Proyecto</option>

                 @foreach($estado as $std)
                <option value="{{$std->estado_proyecto_id}}">{{$std->estado_proyecto_descripcion}}</option>
                @endforeach


                </select>


                </div>


<div class="form-group">
                  <label>Responsable</label>
                  <br>
                <select name="responsable" id="responsable" class="form-control">

                <option value="0" selected="true">Seleccionar Responsable</option>

                @foreach($profesores as $profe)
                <option value="{{$profe->id}}">{{$profe->name}}</option>
                @endforeach


                </select>


                </div>


            <div class="form-group">
                  <div class="form-group">
                  <label>Observaciones</label>
                  <br>
              <P><TEXTAREA class="form-control" id="txtObservacionP" name="txtObservacionP" placeholder="Ingrese Observacion. . . "> </TEXTAREA><br>
                <a><button id="btnAgregarObservacion" name="btnAgregarObservacion" class="btn btn-primary" onClick=cargarObservacion() hidden="true"><span class="fa fa-plus"></span></button></a>
                    <a><button id="btnModificarObservacion" name="btnModificarObservacion" class="btn btn-success" onClick=modificarObservacion()><span class="fa fa-edit"></span></button></a>
                    <a><button id="btnAtrasObservacion" name="btnAtrasObservacion" class="btn btn-danger" onClick=atrasObservacion()><span class="fa fa-arrow-left"></span></button></a></p>
                </div>
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


            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <br><br><br><br><br><br><br><br><br><br>
                     <div class="form-group" align="center">
                  &nbsp;&nbsp;&nbsp;<button class="btn btn-primary btn-lg btn-block" align="center" onclick="validarParaGuardar()">PROPONER</button>&nbsp;&nbsp;&nbsp;
                  <br><br><br>
                  <button class="btn btn-danger btn-lg btn-block" type="reset" align="center" onclick="goBack()">CANCELAR</button>
            </div>
            </div>

            </div>




@endsection

@section('scripts')



<script type="text/javascript">


   function goParticipar2(){

      alert("FUMELA RASTA");

   }

  var idU = 0;

  window.onload = function() {

    idUser = {!! json_encode((array)auth()->user()->id) !!};
    consultarUsuario();


    cargarDePropiedades();

         idU = {!! json_encode((array)auth()->user()->role_id) !!};
        if( idU == 2){

          cargarInterfazEstudiante();

        }else{

          cargarInterfazProfesor();
        }






  }

var bPreguntar = false;
var idUser = 0;
var nameUser = "";

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



    function consultarUsuario(){

               $.ajax({


                type:'get',
                url:'{{URL::to('consultarUsuario/')}}',

                data:{'id': 278},
                success:function(data){



                        nameUser = data.data[0].name;

                        $("#propuesto").val(nameUser);


                },
                error:function(){

                }
            });

   }

    window.onbeforeunload = preguntarAntesDeSalir;


    function cargarDePropiedades(){

    document.getElementById('btnModificar').disabled=true;
    document.getElementById('btnAtras').disabled=true;
    document.getElementById('btnModificarObservacion').disabled=true;
    document.getElementById('btnAtrasObservacion').disabled=true;

    }


    function cargarInterfazEstudiante(){

      document.getElementById('btnBuscarColaborador').disabled=true;
      document.getElementById('estadoP').disabled=true;
      document.getElementById('btnAgregarObservacion').disabled=true;
      document.getElementById('responsable').disabled=true;
      document.getElementById('condicionP1').disabled=true;
      document.getElementById('condicionP2').disabled=true;
      document.getElementById('txtObservacionP').disabled=true
      document.getElementById('txtAgregarColaborador').disabled=true;
      document.getElementById('btnAgregarColaborador').disabled=true;
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

    function privadoRB()
    {
      document.getElementById('condicionP2').checked=false;
    }


    function publicoRB()
    {
      document.getElementById('condicionP1').checked=false;
    }


    function preguntarAntesDeSalir()

    {


      if (bPreguntar)

        return "¿Seguro que quieres salir?";

    }

var almacenado = 0;
    function validarParaGuardar(){

      if (tipoUsuario==0){
          registrarProyectoEstudiante();

      }else{
          registrarProyectoProfesorAdmin();

      }

      if (almacenado==1){
        location.href ="/home";
      }

    }

    function buscarColaborador()

    {

      if (document.getElementById('idColOp').checked==true){

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



function soloNumeros(e){
  var key = window.event ? e.which : e.keyCode;

    if (key < 48 || key > 57 ) {
    e.preventDefault();
  }

}



    function buscarID(){

      var idCol = document.getElementById('idCol').value;


         $.ajax({


                type:'get',
                url:'{{URL::to('buscarID/')}}',

                data:{'idCol': idCol},
                success:function(data){

                      $.each(data, function(index, regenciesObj){

                            idColADD = regenciesObj[0].id;
                            nameColADD = regenciesObj[0].name;
                              document.getElementById('nameColADD').value = nameColADD;


                      });

                },
                error:function(){

                }
            });

    }

        function buscarEmail(){

      var emailCol = document.getElementById('emailCol').value;


         $.ajax({


                type:'get',
                url:'{{URL::to('buscarEmail/')}}',

                data:{'emailCol': emailCol},
                success:function(data){

                      $.each(data, function(index, regenciesObj){

                            idColADD = regenciesObj[0].id;
                            nameColADD = regenciesObj[0].name;
                              document.getElementById('nameColADD').value = nameColADD;


                      });


                },
                error:function(){

                }
            });

    }


        function buscarName(){

      var nameCol = document.getElementById('nameCol').value;



         $.ajax({


                type:'get',
                url:'{{URL::to('buscarName/')}}',

                data:{},
                success:function(data){

                      $.each(data.data, function(index, regenciesObj){


                            var compareA = nameCol.toUpperCase();
                            var compareB = regenciesObj.name.toUpperCase();


                            if ( compareA.match(compareB) ) {

                            idColADD = regenciesObj.id;
                            nameColADD = regenciesObj.name;
                              document.getElementById('nameColADD').value = nameColADD;


                            }else{


                            }


                      });


                },
                error:function(){

                }
            });


    }

var contR= 0;

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



                var proyectoEditarId = 0;

                $('#tblObjetivoEspecifico').empty();
                $('#tblObjetivoEspecifico').append('<thead>' +
                  '<th></th>' +
                    '<th>Objetivo Especifico</th>' +
                '</thead>');

                var objetivoDescripcion = $('#objetivoEsp').val();

          var objetivoProyecto = new Proyecto(0, objetivoDescripcion, 0, 2, proyectoEditarId);


          objetivosArray2.push(new Proyecto(0, objetivoDescripcion, 0, 2, proyectoEditarId));

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
                                                    "<button class='btn btn-success' type='button' onClick=editarObjetivo("+i+")><span class='fa fa-edit'></span></button>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' onClick=eliminarObjetivo("+i+")><span class='fa fa-trash-alt'></span></button>"+
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

  if (editandoObjetivo == 0){

                  var objetivosArrayTemp = [];


                  if (objetivosArray2.length<=1) {


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

                      if (objetivosArray2.length<=1) {

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


              }else{


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
                                                    "<button class='btn btn-success' type='button' onClick=editarObjetivo('0')><span class='fa fa-edit'></span></button>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<button class='btn btn-danger'  type='button' onClick=eliminarObjetivo('0')><span class='fa fa-trash-alt'></span></button>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+
                    "<td>"+ objetivosArray2[0].objetivo_proyecto_descripcion +"</td>"+

                "</tr>");



              }

                  }else{


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


                  }else{
  alert("No se puede eliminar este objetivo hasta que termine de editar el actual!");
}

                }

var editandoObjetivo = 0;

function editarObjetivo(objetivoEditar){

  if (editandoObjetivo == 0){


document.getElementById('btnAgregarObjetivo').disabled=true;
document.getElementById('btnModificar').disabled=false;
document.getElementById('btnAtras').disabled=false;
$("#objetivoEsp").val(objetivosArray2[objetivoEditar].objetivo_proyecto_descripcion);



  objetivoEditando = objetivoEditar;
  editandoObjetivo = 1;

  }else{
  alert("No se puede modificar este objetivo hasta que termine de editar el actual!");
}

}

function modificarObjetivo(){





  var objetivoDescripcion2 = $('#objetivoEsp').val();
    $('#tblObjetivoEspecifico').empty();
    $('#tblObjetivoEspecifico').append('<thead>' +
      '<th></th>' +
        '<th>Objetivo Especifico</th>' +
    '</thead>');

      for(t=0; t<=objetivosArray2.length-1; t++){




      if (objetivoEditando==t&&objetivosArray2[t].objetivo_general==0) {


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

          editandoObjetivo = 0;

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
editandoObjetivo = 0;
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

          var objetivoProyecto = new observacionProyecto(0, objetivoDescripcion, 0);


          observacionesArray2.push(new observacionProyecto(0, objetivoDescripcion, 0));



                $("#txtObservacionP").val("");

                var observacionParaGuardar = "";


                for(i=0; i<=observacionesArray2.length-1; i++){


                  observacionParaGuardar.trim();
                  observacionParaGuardar=observacionesArray2[i].observacion_proyecto_descripcion;


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
                    "<td>"+ observacionesArray2[i].observacion_proyecto_descripcion +"</td>"+
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

                              observacionesArrayTemp.push(new observacionProyecto(observacionesArray2[i].observacion_proyecto_id, observacionesArray2[i].observacion_proyecto_descripcion, observacionesArray2[i].proyecto_investigacion_id));

                          }

                      }

                      observacionesArray2 = [];

                      for(i=0; i<=observacionesArrayTemp.length-1; i++){


                              observacionesArray2.push(new observacionProyecto(observacionesArrayTemp[i].observacion_proyecto_id, observacionesArrayTemp[i].observacion_proyecto_descripcion, observacionesArrayTemp[i].proyecto_investigacion_id));


                      }


                      observacionesArrayTemp = [];


                  }else{



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
document.getElementById('tblObservacion').disabled=true;
         $('tblObservacion').prop('disabled', true);





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
    $('#tblObservacion').empty();
    $('#tblObservacion').append('<thead>' +
      '<th></th>' +
        '<th>Observacion</th>' +
    '</thead>');

      for(t=0; t<=observacionesArray2.length-1; t++){




      if (observacionEditando==observacionesArray2[t].observacion_proyecto_descripcion) {





      }




      observacionParaGuardar = observacionesArray2[t].observacion_proyecto_descripcion;



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
       "<td>"+ observacionesArray2[t].observacion_proyecto_descripcion +"</td>"+

     "</tr>");

          editandoObservacion = 0;






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

                  //console.log(desObj);
                  var colaboradorArrayTemp = [];


                  if (colaboradorArray2.length<=1) {


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


                  }else{



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





function showPoblacion() {
bPreguntar = true;
var ID_SEDE=$('#sede').val();
var GRADO_CURSO=$('#gradoCarrera').val();



   $.ajax({


                type:'get',
                url:'{{URL::to('showPobla/')}}',

                data:{'ID_SEDE': ID_SEDE, 'GRADO_CURSO': GRADO_CURSO},
                success:function(data){



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

function probarReDirec(){
  window.location.href = "redirectUser/";
}


function registrarProyectoProfesorAdmin() {



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
                url:'{{URL::to('guardarProyecto/')}}',

                data:{'sede_id': sedeProyecto, 'id_carreras_ulatina': carreraProyecto, 'llaveAlmacenamiento': propuestoid, 'nombre_proyecto': nombreProyecto,
                      'beneficiario': beneficiario, 'metodologia': metodologia, 'presupuesto': presupuesto, 'justificacion': JUSTIFICACION,
                       'estado_proyecto_id': estado, 'tipo_proyecto_id': tipoProyecto, 'condicion_proyecto_id': condicionPro},
                success:function(data){



                      proyectoId = data[0].proyecto_investigacion_id;




                $.ajax({


                type:'get',
                url:'{{URL::to('guardarObjetivoGeneral/')}}',

                data:{'objetivo_proyecto_descripcion': GENERAL, 'objetivo_general': 1, 'estado_objetivo_id': 2, 'proyecto_investigacion_id': proyectoId},
                success:function(data){

                    //proceso de insercesion de datos




                },
                error:function(){

                }
               });



                //for each para guardar todos los objetivos
                //objetivosArray
                $.each(objetivosArray2, function(index, objetivoEspFIND){



                $.ajax({


                type:'get',
                url:'{{URL::to('guardarObjetivoEspecifico/')}}',

                data:{'objetivo_proyecto_descripcion': objetivoEspFIND.objetivo_proyecto_descripcion, 'objetivo_general': 0, 'estado_objetivo_id': 2, 'proyecto_investigacion_id': proyectoId},
                success:function(data){






                },
                error:function(){

                }
               });




              });




               if (Object.keys(colaboradorArray2).length==0){

                }else{


                 //for each para guardar todos los colaboradores
                //colaboradorArray2
                $.each(colaboradorArray2, function(index, colaboradorADD){



                $.ajax({


                type:'get',
                url:'{{URL::to('guardarColaborador/')}}',

                data:{'users_id': colaboradorADD.users_id, 'tipo_usuario_proyecto_id': 2, 'proyecto_investigacion_id': proyectoId},
                success:function(data){




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
                url:'{{URL::to('guardarObservaciones/')}}',

                data:{'observacion_proyecto_descripcion': observacionADD.observacion_proyecto_descripcion, 'proyecto_investigacion_id': proyectoId},
                success:function(data){







                },
                error:function(){

                }
               });




              });


              }


              $.ajax({


                type:'get',
                url:'{{URL::to('guardarUsuarioProyectoProfeAdmin/')}}',

                data:{'propuestoid': propuestoid, 'responsable': responsable, 'proyecto_investigacion_id': proyectoId},
                success:function(data){


                    window.location = getURLFromBrowser()+"ModuloIE/Proyecto/redirectUser";


                },
                error:function(){

                }
               });



                },
                error:function(){

                }

            });


  }

}



function registrarProyectoEstudiante() {



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
var proyectoId = 0;




console.log(sedeProyecto);
console.log('====');
console.log(nombreProyecto);


  if(parseInt(sedeProyecto)==0){
    alert("Debe seleccionar la sede del proyecto!");
  }else if(parseInt(carreraProyecto)=="0"){
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
                url:'{{URL::to('guardarProyecto/')}}',

                data:{'sede_id': sedeProyecto, 'id_carreras_ulatina': carreraProyecto, 'llaveAlmacenamiento': propuestoid, 'nombre_proyecto': nombreProyecto,
                      'beneficiario': beneficiario, 'metodologia': metodologia, 'presupuesto': presupuesto, 'justificacion': JUSTIFICACION,
                       'estado_proyecto_id': 1, 'tipo_proyecto_id': tipoProyecto, 'condicion_proyecto_id': 1},
                success:function(data){


                      console.log('success420');
                      console.log(propuestoid);
                      proyectoId = data[0].proyecto_investigacion_id;
                      console.log(data[0].proyecto_investigacion_id);


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
                $.each(objetivosArray2, function(index, objetivoEsp){



                $.ajax({


                type:'get',
                url:'{{URL::to('guardarObjetivoEspecifico/')}}',

                data:{'objetivo_proyecto_descripcion': objetivoEsp.objetivo_proyecto_descripcion, 'objetivo_general': 0, 'estado_objetivo_id': 2, 'proyecto_investigacion_id': proyectoId},
                success:function(data){

                    //proceso de insercesion de datos
                    console.log(data);




                },
                error:function(){

                }
               });




              });



                $.ajax({


                type:'get',
                url:'{{URL::to('guardarUsuarioProyecto/')}}',

                data:{'users_id': propuestoid, 'tipo_usuario_proyecto_id': 3, 'proyecto_investigacion_id': proyectoId},
                success:function(data){

                    //proceso de insercesion de datos
                    console.log(data);

                    window.location = getURLFromBrowser()+"ModuloIE/Proyecto/redirectUser";


                },
                error:function(){

                }
               });



                },
                error:function(){

                }

            });

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


@endsection
