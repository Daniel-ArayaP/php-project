@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <h3>Listado de Proyectos </h3>

            <br>
        <input type="radio" id="condicionP1" name="condicionP1" value="1" onclick="lookMyProjects()"> Mis Proyectos
          &nbsp;&nbsp<input type="radio" id="condicionP2" name="condicionP2" value="0" checked onclick="lookAllProjects()"> Todos los Proyectos<br>
          <br>
          @include('ModuloIE.Proyecto.modalBuscarProyecto')
            &nbsp;&nbsp;<a data-target="#modal-BuscarProyecto" data-toggle="modal"><button class="btn btn-primary"> <span class="fa fa-search"></span>  Buscar</button></a>&nbsp;&nbsp;<a href="Proyecto/create"  ><button id="exportButton" class="btn btn-warning"><span class="fa fa-plus-square"></span>  Nuevo</button></a>
            <br><br>

    </div>
</div>


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div id="customers">
        <div class="table-responsive"; style="width:auto; height:575px; overflow:auto;">
            <table id="tblData" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                  <th></th>
                    <th> Nombre del Proyecto</th>
                    <th> Tipo de Proyecto</th>
                    <th> Carrera Universitaria</th>
                    <th> Condicion</th>
                    <th> Estado</th>
                    <th> Propuesto</th>
                    <th> Responsable</th>
                </thead>

                <?php

                $busqueda1="";
                $busqueda2="";

                 ?>
                <tr>

                </tr>
            </table>
        </div>
      </div>
      @include('ModuloIE.Proyecto.modal')

    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">

    var bPreguntar = false;



     window.onload = function() {
     $('#condicionP1').prop("checked", false);
     $('#condicionP2').prop("checked", true);
     $('#condicionP3').prop("checked", false);
     $('#condicionP4').prop("checked", true);
     lookAllProjects();
};

    window.onbeforeunload = preguntarAntesDeSalir;


function test()

    {

      bPreguntar = true;
      alert('test');
      bPreguntar = false;

    }


    function preguntarAntesDeSalir()

    {

      if (bPreguntar)

        return "¿Seguro que quieres salir?";

    }

    function doOpen(url){
        var rt = $('#searchText').val();

            if (rt==""){
            document.location.target = "_blank";
            document.location.href=url + '/' + "*";

            }else{
                document.location.target = "_blank";
            document.location.href=url + '/' + rt;
            }




        }

                       var proyectoEnlistado = [];
                        var idU = <?php
                echo Auth::user()->role_id;

                ?>;

function Proyecto(proyecto_investigacion_id, nombre_proyecto) {
  this.proyecto_investigacion_id = proyecto_investigacion_id;
  this.nombre_proyecto = nombre_proyecto;
}



     function changeMyProject()
{

if( $('#condicionP3').prop('checked') ) {
   //console.log("GOOD JOB");

          document.getElementById('condicionP1').checked=true;
          document.getElementById('condicionP2').checked=false;
          document.getElementById('condicionP4').checked=false;
          lookMyProjects();
          $("#btnSearch").attr("onclick", "searchProject()");
}

}


   function changeAllProject()
{

if( $('#condicionP4').prop('checked') ) {
   //console.log("GOOD JOB");

          document.getElementById('condicionP2').checked=true;
          document.getElementById('condicionP1').checked=false;
          document.getElementById('condicionP3').checked=false;
          lookAllProjects();
          $("#btnSearch").attr("onclick", "searchProjectAll()");
}

}




   function lookMyProjects()
{

if( $('#condicionP1').prop('checked')==true ) {
   //console.log("GOOD JOB");

          document.getElementById('condicionP2').checked=false;
          document.getElementById('condicionP3').checked=true;
          document.getElementById('condicionP4').checked=false;
          $("#btnSearch").attr("onclick", "searchProject()");

}
console.log('success345');



          $.ajax({


                type:'get',
                url:'{{URL::to('myProject/')}}',

                data:{},
                success:function(data){
                    console.log('success3456');

                    console.log(data.data3);

                    console.log(data.data2);


                $('#tblData').empty();
                $('#tblData').append('<thead>' +
                  '<th></th>' +
                    '<th>Nombre del Proyecto</th>' +
                    '<th>Tipo de Proyecto</th>' +
                    '<th>Carrera</th>' +
                    '<th>Condicion</th>' +
                    '<th>Estado</th>' +
                    '<th>Propuesto</th>' +
                    '<th>Responsable</th>' +

                '</thead>');
var rowP4 = "";
var encontrado1=0;
var encontrado2=0;
var rowP2 = "";
var rowP3 = "";
proyectoEnlistado = [];

$.each(data.data3, function(index, myProjects){

                      var idP = myProjects;
                      console.log(idP);
                      var stateD = 1;


                 $.each(data.data, function(index, pro){


                      // INICIO DEL LOOP DE VALIDACION
                    if (pro.proyecto_investigacion_id==idP){

                    proyectoEnlistado.push(new Proyecto(pro.proyecto_investigacion_id, pro.nombre_proyecto));


                    if (data.data4.length==0){

                            if( idU==1 ){

                              stateD = 0;

                            }else{


                              stateD = 1;

                            }

                    }else{




                      $.each(data.data4, function(index, projectF){

                        console.log("TP");
                        console.log(projectF);
                        console.log(pro.proyecto_investigacion_id);

                      if(projectF==pro.proyecto_investigacion_id){

                        stateD = 0;

                      }



                     });




                    }

                    console.log(stateD);
                    console.log("**--");
                    console.log(pro.proyecto_investigacion_id);

                    if(stateD==1){

                      var rowP = "<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goParticipar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' disabled onClick=goEditar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-delete' data-toggle='modal'><button class='btn btn-danger' disabled onClick=goEliminar('"+pro.proyecto_investigacion_id+"')  type='button'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+

                    "<td>"+ pro.nombre_proyecto +"</td>"+
                    "<td>"+ pro.tipo_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.nombre_carreras_ulatina +"</td>"+
                    "<td>"+ pro.condicion_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.estado_proyecto_descripcion +"</td>+";
                     rowP4 += rowP;
                     stateD = 1;
                    }else{

                      var rowP = "<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goParticipar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' onClick=goEditar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-delete' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+

                    "<td>"+ pro.nombre_proyecto +"</td>"+
                    "<td>"+ pro.tipo_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.nombre_carreras_ulatina +"</td>"+
                    "<td>"+ pro.condicion_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.estado_proyecto_descripcion +"</td>+";
                     rowP4 += rowP;

                    }



                   $.each(data.data2, function(index, regenciesObj2){



                        if (regenciesObj2.tipo_usuario_proyecto_id==3 && regenciesObj2.proyecto_investigacion_id==pro.proyecto_investigacion_id) {


                                    rowP2 = "<td>"+ regenciesObj2.name +"</td>+";
                                    rowP4 += rowP2;


                         }else{


                         }


                    });




                                        if (rowP2===""){

                        rowP2 = "<td> Error - Sin Registrar</td>+";

                        rowP4 += rowP2;

                     }




                     $.each(data.data2, function(index, regenciesObj3){



                        if (regenciesObj3.tipo_usuario_proyecto_id==1 && regenciesObj3.proyecto_investigacion_id==pro.proyecto_investigacion_id) {


                           rowP3 = "<td>"+ regenciesObj3.name +"</td>+";

                            rowP4 += rowP3;



                        }else{

                        }



                      });



                     if (rowP2!="" && rowP3===""){

                            rowP3 = "<td> Sin Asignar</td>";

                            rowP4 += rowP3;

                     }else if (rowP2==="" && rowP3===""){



                        rowP2 = "<td> Error - Sin Registrar</td>+";

                        rowP4 += rowP2;



                        rowP3 = "<td> Sin Asignar</td>";

                        rowP4 += rowP3;


                     }


                     $('#tblData').append(rowP4 +
                            "</tr>");
                     rowP4="";
                     rowP3 = "";
                     rowP2 = "";
}


});

       });





                },
                error:function(){

                }
            });


}// FIN Opcion "myProject"







   function lookAllProjects()
{

if( $('#condicionP2').prop('checked')==true ) {
   //console.log("GOOD JOB");

          document.getElementById('condicionP1').checked=false;
          document.getElementById('condicionP3').checked=false;
          document.getElementById('condicionP4').checked=true;
          $("#btnSearch").attr("onclick", "searchProjectAll()");

}
console.log('success22');
           var userId=1;


         $.ajax({


                type:'get',
                url:'{{URL::to('allProject/')}}',

                data:{ },
                success:function(data){
                    console.log('success555');

                    //console.log(data.data3);

                    console.log(data.data2);


                $('#tblData').empty();
                $('#tblData').append('<thead>' +
                  '<th></th>' +
                    '<th>Nombre del Proyecto</th>' +
                    '<th>Tipo de Proyecto</th>' +
                    '<th>Carrera</th>' +
                    '<th>Condicion</th>' +
                    '<th>Estado</th>' +
                    '<th>Propuesto</th>' +
                    '<th>Responsable</th>' +

                '</thead>');
var rowP4 = "";
var encontrado1=0;
var encontrado2=0;
var rowP2 = "";
var rowP3 = "";
proyectoEnlistado = [];


$.each(data.data3, function(index, myProjects){

                      var idP = myProjects;
                      //console.log(idP);
                      var stateD = 1;

                 $.each(data.data, function(index, pro){


                      // INICIO DEL LOOP DE VALIDACION
                    if (pro.proyecto_investigacion_id==idP){

                    proyectoEnlistado.push(new Proyecto(pro.proyecto_investigacion_id, pro.nombre_proyecto));
                    if (data.data4.length==0){

                            if( idU==1 ){

                              stateD = 0;

                            }else{


                              stateD = 1;

                            }

                    }else{




                      $.each(data.data4, function(index, projectF){

                        console.log("TP");
                        console.log(projectF);
                        console.log(pro.proyecto_investigacion_id);

                      if(projectF==pro.proyecto_investigacion_id){

                        stateD = 0;

                      }



                     });




                    }

                    console.log(stateD);
                    console.log("**--");
                    console.log(pro.proyecto_investigacion_id);

                    if(stateD==1){

                      var rowP = "<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goParticipar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' disabled onClick='goEditar('"+pro.proyecto_investigacion_id+"')' type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-delete' data-toggle='modal'><button class='btn btn-danger' disabled onClick='goEliminar('"+pro.proyecto_investigacion_id+"')'  type='button'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+

                    "<td>"+ pro.nombre_proyecto +"</td>"+
                    "<td>"+ pro.tipo_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.nombre_carreras_ulatina +"</td>"+
                    "<td>"+ pro.condicion_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.estado_proyecto_descripcion +"</td>+";
                     rowP4 += rowP;
                     stateD = 1;

                    }else{

                      var rowP = "<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goParticipar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' onClick=goEditar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-delete' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+

                    "<td>"+ pro.nombre_proyecto +"</td>"+
                    "<td>"+ pro.tipo_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.nombre_carreras_ulatina +"</td>"+
                    "<td>"+ pro.condicion_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.estado_proyecto_descripcion +"</td>+";
                     rowP4 += rowP;

                    }



                   $.each(data.data2, function(index, regenciesObj2){



                        if (regenciesObj2.tipo_usuario_proyecto_id==3 && regenciesObj2.proyecto_investigacion_id==pro.proyecto_investigacion_id) {


                                    rowP2 = "<td>"+ regenciesObj2.name +"</td>+";
                                    rowP4 += rowP2;


                         }else{


                         }


                    });


                   if (rowP2===""){

                        rowP2 = "<td> Error - Sin Registrar</td>+";

                        rowP4 += rowP2;

                     }




                     $.each(data.data2, function(index, regenciesObj3){



                        if (regenciesObj3.tipo_usuario_proyecto_id==1 && regenciesObj3.proyecto_investigacion_id==pro.proyecto_investigacion_id) {


                           rowP3 = "<td>"+ regenciesObj3.name +"</td>+";

                            rowP4 += rowP3;



                        }else{

                        }



                      });



                     if (rowP2!="" && rowP3===""){

                            rowP3 = "<td> Sin Asignar</td>";

                            rowP4 += rowP3;

                     }else if (rowP2==="" && rowP3===""){



                        rowP2 = "<td> Error - Sin Registrar</td>+";

                        rowP4 += rowP2;



                        rowP3 = "<td> Sin Asignar</td>";

                        rowP4 += rowP3;


                     }


                     $('#tblData').append(rowP4 +"</tr>");
                     rowP4="";
                     rowP3 = "";
                     rowP2 = "";
}


});

       });


                },
                error:function(){

                }
            });
}


 function searchProject()
{


console.log('success789');
           var userId=1;
           var searchText = $('#searchText').val();


         $.ajax({


                type:'get',
                url:'{{URL::to('searchProject/')}}',

                data:{"searchText": searchText},
                success:function(data){
                    console.log('success789');

                    console.log(data.data2);

                    console.log(data.data2.length);


                $('#tblData').empty();
                $('#tblData').append('<thead>' +
                  '<th></th>' +
                    '<th>Nombre del Proyecto</th>' +
                    '<th>Tipo de Proyecto</th>' +
                    '<th>Carrera</th>' +
                    '<th>Condicion</th>' +
                    '<th>Estado</th>' +
                    '<th>Propuesto</th>' +
                    '<th>Responsable</th>' +

                '</thead>');
var rowP4 = "";
var encontrado1=0;
var encontrado2=0;
var rowP2 = "";
var rowP3 = "";
proyectoEnlistado = [];

$.each(data.data3, function(index, myProjects){

                      var idP = myProjects;
                      console.log(idP);
                      var stateD = 1;

                 $.each(data.data, function(index, pro){


                      // INICIO DEL LOOP DE VALIDACION
                    if (pro.proyecto_investigacion_id==idP){

                    proyectoEnlistado.push(new Proyecto(pro.proyecto_investigacion_id, pro.nombre_proyecto));

                      if (data.data4.length==0){

                            if( idU==1 ){

                              stateD = 0;

                            }else{


                              stateD = 1;

                            }

                    }else{




                      $.each(data.data4, function(index, projectF){

                        console.log("TP");
                        console.log(projectF);
                        console.log(pro.proyecto_investigacion_id);

                      if(projectF==pro.proyecto_investigacion_id){

                        stateD = 0;

                      }



                     });




                    }

                    console.log(stateD);
                    console.log("**--");
                    console.log(pro.proyecto_investigacion_id);

                    if(stateD==1){

                      var rowP = "<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goParticipar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' disabled onClick=goEditar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-delete' data-toggle='modal'><button class='btn btn-danger' disabled onClick=goEliminar('"+pro.proyecto_investigacion_id+"')  type='button'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+

                    "<td>"+ pro.nombre_proyecto +"</td>"+
                    "<td>"+ pro.tipo_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.nombre_carreras_ulatina +"</td>"+
                    "<td>"+ pro.condicion_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.estado_proyecto_descripcion +"</td>+";
                     rowP4 += rowP;
                     stateD = 1;
                    }else{

                      var rowP = "<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goParticipar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' onClick=goEditar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-delete' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+pro.proyecto_investigacion_id+"')  type='button'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+

                    "<td>"+ pro.nombre_proyecto +"</td>"+
                    "<td>"+ pro.tipo_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.nombre_carreras_ulatina +"</td>"+
                    "<td>"+ pro.condicion_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.estado_proyecto_descripcion +"</td>+";
                     rowP4 += rowP;

                    }



                   $.each(data.data2, function(index, regenciesObj2){



                        if (regenciesObj2.tipo_usuario_proyecto_id==3 && regenciesObj2.proyecto_investigacion_id==pro.proyecto_investigacion_id) {


                                    rowP2 = "<td>"+ regenciesObj2.name +"</td>+";
                                    rowP4 += rowP2;


                         }else{


                         }


                    });




                     $.each(data.data2, function(index, regenciesObj3){



                        if (regenciesObj3.tipo_usuario_proyecto_id==1 && regenciesObj3.proyecto_investigacion_id==pro.proyecto_investigacion_id) {


                           rowP3 = "<td>"+ regenciesObj3.name +"</td>";

                            rowP4 += rowP3;



                        }else{

                        }



                      });



                     if (rowP2==="" && rowP3 !=""){

                        rowP2 = "<td> Error - Sin Registrar</td>+";

                        rowP4 += rowP2;

                     }else if (rowP2!="" && rowP3===""){

                            rowP3 = "<td> Sin Asignar</td>";

                            rowP4 += rowP3;

                     }else if (rowP2==="" && rowP3===""){



                        rowP2 = "<td> Error - Sin Registrar</td>+";

                        rowP4 += rowP2;



                        rowP3 = "<td> Sin Asignar</td>";

                        rowP4 += rowP3;


                     }


                     $('#tblData').append(rowP4 +  "</tr>");
                     rowP4="";
                     rowP3 = "";
                     rowP2 = "";
}


});

       });


                },
                error:function(){

                }
            });
}


function searchProjectAll()
{


console.log('success3490');
           var userId=1;
           var searchText = $('#searchText').val();



         $.ajax({


                type:'get',
                url:'{{URL::to('searchProjectAll/')}}',

                data:{"userId":
                <?php

                $varID = Auth::user()->id;

                echo  $varID;
                ?>, "searchText": searchText},
                success:function(data, data2, data3){
                    console.log('success3490');

                    console.log(data.data2[0]);

                    console.log(data.data2.length);


                $('#tblData').empty();
                $('#tblData').append('<thead>' +
                    '<th></th>' +
                    '<th>Nombre del Proyecto</th>' +
                    '<th>Tipo de Proyecto</th>' +
                    '<th>Carrera</th>' +
                    '<th>Condicion</th>' +
                    '<th>Estado</th>' +
                    '<th>Propuesto</th>' +
                    '<th>Responsable</th>' +

                '</thead>');
var rowP4 = "";
var encontrado1=0;
var encontrado2=0;
var rowP2 = "";
var rowP3 = "";
proyectoEnlistado = [];

$.each(data.data3, function(index, myProjects){

                      var idP = myProjects;
                      console.log(idP);
                      var stateD = 1;

                 $.each(data.data, function(index, pro){


                      // INICIO DEL LOOP DE VALIDACION
                    if (pro.proyecto_investigacion_id==idP){

                    proyectoEnlistado.push(new Proyecto(pro.proyecto_investigacion_id, pro.nombre_proyecto));

                                                            if (data.data4.length==0){

                            if( idU==1 ){

                              stateD = 0;

                            }else{


                              stateD = 1;

                            }

                    }else{




                      $.each(data.data4, function(index, projectF){

                        console.log("TP");
                        console.log(projectF);
                        console.log(pro.proyecto_investigacion_id);

                      if(projectF==pro.proyecto_investigacion_id){

                        stateD = 0;

                      }



                     });




                    }

                    console.log(stateD);
                    console.log("**--");
                    console.log(pro.proyecto_investigacion_id);

                    if(stateD==1){

                      var rowP = "<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goParticipar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' disabled onClick=goEditar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-delete' data-toggle='modal'><button class='btn btn-danger' disabled onClick=goEliminar('"+pro.proyecto_investigacion_id+"')  type='button'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+

                    "<td>"+ pro.nombre_proyecto +"</td>"+
                    "<td>"+ pro.tipo_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.nombre_carreras_ulatina +"</td>"+
                    "<td>"+ pro.condicion_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.estado_proyecto_descripcion +"</td>+";
                     rowP4 += rowP;
                     stateD = 1;
                    }else{

                      var rowP = "<tr>"+
                                    "<td>"+
                  "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goParticipar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' onClick=goEditar('"+pro.proyecto_investigacion_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-delete' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+pro.proyecto_investigacion_id+"')  type='button'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                        "</div>"+
                   "</td>"+

                    "<td>"+ pro.nombre_proyecto +"</td>"+
                    "<td>"+ pro.tipo_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.nombre_carreras_ulatina +"</td>"+
                    "<td>"+ pro.condicion_proyecto_descripcion +"</td>"+
                    "<td>"+ pro.estado_proyecto_descripcion +"</td>+";
                     rowP4 += rowP;

                    }



                   $.each(data.data2, function(index, regenciesObj2){



                        if (regenciesObj2.tipo_usuario_proyecto_id==3 && regenciesObj2.proyecto_investigacion_id==pro.proyecto_investigacion_id) {


                                    rowP2 = "<td>"+ regenciesObj2.name +"</td>+";
                                    rowP4 += rowP2;


                         }else{


                         }


                    });




                     $.each(data.data2, function(index, regenciesObj3){



                        if (regenciesObj3.tipo_usuario_proyecto_id==1 && regenciesObj3.proyecto_investigacion_id==pro.proyecto_investigacion_id) {


                           rowP3 = "<td>"+ regenciesObj3.name +"</td>";

                            rowP4 += rowP3;



                        }else{

                        }



                      });



                     if (rowP2==="" && rowP3 !=""){

                        rowP2 = "<td> Error - Sin Registrar</td>+";

                        rowP4 += rowP2;

                     }else if (rowP2!="" && rowP3===""){

                            rowP3 = "<td> Sin Asignar</td>";

                            rowP4 += rowP3;

                     }else if (rowP2==="" && rowP3===""){



                        rowP2 = "<td> Error - Sin Registrar</td>+";

                        rowP4 += rowP2;



                        rowP3 = "<td> Sin Asignar</td>";

                        rowP4 += rowP3;


                     }


                     $('#tblData').append(rowP4 + "</tr>");
                     rowP4="";
                     rowP3 = "";
                     rowP2 = "";
}


});

       });


                },
                error:function(){

                }
            });
}



   var nameSTR = "";

   function goParticipar2(){

      alert("No funciona el eliminar, Ver programacion en javascript!!!");

   }

function goParticipar(varT){

      var URLactual = window.location;
      var str = URLactual.toString();
      var n = str.search("ModuloIE");
      var imp = str.substring(0, n);
      window.location =imp+'ModuloIE/Proyecto/'+varT+'/participar';

}

function goEditar(varT){

var URLactual = window.location;
var str = URLactual.toString();
var n = str.search("ModuloIE");
var imp = str.substring(0, n);
window.location =imp+'ModuloIE/Proyecto/'+varT+'/edit';

}


function goEliminar(varT){


      nameSTR =  varT;
      console.log(proyectoEnlistado);

      $.each(proyectoEnlistado, function(index, project){

              if (project.proyecto_investigacion_id==nameSTR){

                $('#body1').empty();
                $('#body1').append("<p>!!!Mae Confirme si desea Eliminar Proyecto : "+project.nombre_proyecto+" </p>");

              }

      });
      //$("#btnConfirmar").attr("onclick", "goParticipar2()");
    $("#btnConfirmar").attr("onclick", "demoFromHTML()")
}
  var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})


function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}


function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");

    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");

        for (var j = 0; j < cols.length; j++)
            row.push(cols[j].innerText);

        csv.push(row.join(","));
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}


function exportTableToExcel(tableID, filename){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById("tblData");
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%30');

    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }
}





function demoFromHTML() {


    var pdf = new jsPDF('p', 'pt', 'letter');
    var strName = 'Hello world!';


    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#customers')[0];
    pdf.text(20, 20, "Lista de Proyectos Prueba Mayo2020");
    // we support special element handlers. Register them with jQuery-style
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 80,
        bottom: 60,
        left: 20,
        width: 700
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        // dispose: object with X, Y of the last line add to the PDF
        //          this allow the insertion of new lines after html
        pdf.save('Proyectos.pdf');
    }, margins);
}



</script>


@endsection
