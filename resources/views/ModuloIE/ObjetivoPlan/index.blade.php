@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <h2>Listado de Objetivos </h2>
        <br>

            <h3> Proyecto:   &nbsp;&nbsp;&nbsp;&nbsp; {{ $proyecto->nombre_proyecto}}</h3>

            <br>
          @include('ModuloIE.ObjetivoPlan.modalBuscarObjetivo')
            &nbsp;&nbsp;</a>&nbsp;&nbsp;<a id="linkBack" name="linkBack"  href="/ModuloIE/Proyecto/{{ $proyecto->proyecto_investigacion_id}}/PlanTrabajo/"  ><button id="exportButton" class="btn btn-danger"><span class="fa fa-arrow-left"></span></button></a>
            &nbsp;&nbsp;<a data-target="#modal-BuscarObjetivo" data-toggle="modal"><button class="btn btn-primary"> <span class="fa fa-search"></span>  Buscar</button></a>
            &nbsp;&nbsp;</a>&nbsp;&nbsp;<a id="linkTo" name="linkTo"  href="/ModuloIE/Proyecto/{{ $proyecto->proyecto_investigacion_id}}/PlanTrabajo/{{ $proyecto->plan_proyecto_id}}/ObjetivosPlanTrabajo/create/"  ><button id="btnGenerarObjetivo" class="btn btn-warning"><span class="fa fa-plus-square"></span>  Nuevo</button></a>
            <br>

    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

        <br><br><br><br>

            <h3> Plan de Trabajo:   &nbsp;&nbsp;&nbsp;&nbsp; {{ $proyecto->plan_proyecto_nombre}}</h3>

            <br>

    </div>


</div>
<br>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

      <div id="customers">
        <div class="table-responsive">
            <table id="tblObjetivosPlan" name="tblObjetivosPlan" class="table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th></th>
                    <th> Encargad@(s)</th>
                    <th> Objetivo Especifico</th>
                    <th> Fecha Inicio</th>
                    <th> Fecha Fin</th>
                    <th> Resultados Esperados</th>
                    <th> Recursos</th>
                    <th> Indicadores</th>
                </thead>



            </table>
        </div>
    </div>
@include('ModuloIE.ObjetivoPlan.modal')


        <br>
    </div>
</div>

<script type="text/javascript">

    var bPreguntar = false;
    var idU = 0;
    var planTrabajoEnlistado = [];


     window.onload = function() {


        document.getElementById('linkBack').href = changeBackButtonLink();
        document.getElementById('linkTo').href = changeNewButtonLink();

        idU = <?php  echo Auth::user()->role_id; ?>;
        if( idU == 2){

          document.getElementById('btnGenerarObjetivo').disabled=true;

        }
     cargarObjetivosPlan();
};


    window.onbeforeunload = preguntarAntesDeSalir;


function test()

    {

      bPreguntar = true;
      alert('test');
      bPreguntar = false;

    }




function PlanTrabajo(plan_proyecto_id, plan_proyecto_nombre) {
  this.plan_proyecto_id = plan_proyecto_id;
  this.plan_proyecto_nombre = plan_proyecto_nombre;
}


    function preguntarAntesDeSalir()

    {

      if (bPreguntar)

        return "¿Seguro que quieres salir?";

    }


                function cargarObjetivosPlan(){

                            var pId  = <?php echo $proyecto->plan_proyecto_id; ?>;

                                console.log(pId);

                           $.ajax({


                                  type:'get',
                                  url:'{{URL::to('cargarObjetivosPlan/')}}',

                                  data:{'plan_proyecto_id': pId},
                                  success:function(data){

                                      console.log('success');

                                      console.log(data);

                                      console.log(Object.keys(data).length);

                                      $('#tblObjetivosPlan').empty();
                                      $('#tblObjetivosPlan').append('<thead>' +
                                        '<th></th>' +
                                        '<th> Encargad@(s)</th>'+
                                        '<th> Objetivo Especifico</th>'+
                                        '<th> Fecha Inicio</th>'+
                                        '<th> Fecha Fin</th>'+
                                        '<th> Resultados Esperados</th>'+
                                        '<th> Recursos</th>'+
                                        '<th> Indicadores</th>'+
                                        '</thead>');

                                      var rowP4 = "";
                                      planTrabajoEnlistado = [];
                                      var encargadosName = "";
                                      var userIdFounded = 0;


                                      $.each(data.data, function(index, ObjetivoPlanFind){
                                          planTrabajoEnlistado.push(new PlanTrabajo(ObjetivoPlanFind.plan_proyecto_id, ObjetivoPlanFind.recursos));

                                          $.each(data.data2, function(index, userFIND){

                                            if (ObjetivoPlanFind.objetivo_plan_proyecto_id==userFIND.objetivo_plan_proyecto_id){

                                              if(encargadosName==""){
                                                encargadosName = userFIND.name + "; ";
                                              }else{
                                                encargadosName = encargadosName + userFIND.name + "; ";
                                              }

                                              if(<?php  echo Auth::user()->id; ?>==userFIND.id){


                                                userIdFounded=1;
                                              }


                                            }

                                          });

                                          if(encargadosName==""){

                                            encargadosName = "Sin Asignar";

                                          }

                                           if( idU == 2){


                                            if(userIdFounded==1){
                                              userIdFounded=0;
                                          var rowP = "<tr>"+
                                          "<td>"+
                                          "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goVer('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' onClick=goEditar('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-deleteObjetivoPlan' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"')  type='button' disabled='true'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                          "</div>"+
                                          "</td>"+
                                          "<td>"+ encargadosName +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.objetivo_proyecto_descripcion +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.fecha_inicio.toString().split(" ")[0] +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.fecha_final.toString().split(" ")[0] +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.resultado_esperado +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.recursos +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.indicadores +"</td>";
                                           rowP4 += rowP;

                                            }else{

                                          var rowP = "<tr>"+
                                          "<td>"+
                                          "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goVer('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' disabled='true' onClick=goEditar('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-deleteObjetivoPlan' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"')  type='button' disabled='true'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                          "</div>"+
                                          "</td>"+
                                          "<td>"+ encargadosName +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.objetivo_proyecto_descripcion +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.fecha_inicio.toString().split(" ")[0] +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.fecha_final.toString().split(" ")[0] +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.resultado_esperado +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.recursos +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.indicadores +"</td>";
                                           rowP4 += rowP;

                                            }




                                           }else{

                                            var rowP = "<tr>"+
                                          "<td>"+
                                          "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goVer('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' onClick=goEditar('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-deleteObjetivoPlan' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"')  type='button'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                          "</div>"+
                                          "</td>"+
                                          "<td>"+ encargadosName +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.objetivo_proyecto_descripcion +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.fecha_inicio.toString().split(" ")[0] +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.fecha_final.toString().split(" ")[0] +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.resultado_esperado +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.recursos +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.indicadores +"</td>";
                                           rowP4 += rowP;

                                           }





                                            $('#tblObjetivosPlan').append(rowP4 +
                                              "</tr>");


                                             rowP4="";
                                             encargadosName="";

                                      });


                                  },
                                  error:function(){

                                  }
                              });

                }


          function getURLFromBrowser() {

          var URLactual = window.location;
          var str = URLactual.toString();
          var n = str.search("ModuloIE");
          var imp = str.substring(0, n);
          return imp;

          }


          function changeNewButtonLink(){

          var pId  = <?php echo $proyecto->proyecto_investigacion_id; ?>;

          var ptId  = <?php echo $proyecto->plan_proyecto_id; ?>;

          return getURLFromBrowser()+"ModuloIE/Proyecto/"+pId+"/PlanTrabajo/"+ptId+"/ObjetivosPlanTrabajo/create";


          }


          function changeBackButtonLink(){

          var pId  = <?php echo $proyecto->proyecto_investigacion_id; ?>;

          var ptId  = <?php echo $proyecto->plan_proyecto_id; ?>;

          return getURLFromBrowser()+"ModuloIE/Proyecto/"+pId+"/PlanTrabajo";


          }


          function goVer(varT){


          var pId  = <?php echo $proyecto->proyecto_investigacion_id; ?>;
          var planTrabajoId  = <?php echo $proyecto->plan_proyecto_id; ?>;
          //alert(varT);
          window.location = getURLFromBrowser()+"ModuloIE/Proyecto/"+pId+"/PlanTrabajo/"+planTrabajoId+"/ObjetivosPlanTrabajo/"+varT+"/ver";

          }

          function goEditar(varT){

          var pId  = <?php echo $proyecto->proyecto_investigacion_id; ?>;
          var planTrabajoId  = <?php echo $proyecto->plan_proyecto_id; ?>;
          //alert(varT);
          window.location = getURLFromBrowser()+'ModuloIE/Proyecto/'+pId+'/PlanTrabajo/'+planTrabajoId+'/ObjetivosPlanTrabajo/'+varT+'/edit'

          }


function goEliminar(varT){




      var pId  = <?php echo $proyecto->plan_proyecto_id; ?>;

                                console.log(pId);

                           $.ajax({


                                  type:'get',
                                  url:'{{URL::to('cargarObjetivosPlan/')}}',

                                  data:{'plan_proyecto_id': pId},
                                  success:function(data){



                                      console.log(data);

                                      console.log(Object.keys(data).length);

                                      var rowP4 = "";
                                      planTrabajoEnlistado = [];
                                      var encargadosName = "";


                                      $.each(data.data, function(index, ObjetivoPlanFind){

                                        if (ObjetivoPlanFind.objetivo_plan_proyecto_id==varT){


                                          $.each(data.data2, function(index, userFIND){

                                            if (ObjetivoPlanFind.objetivo_plan_proyecto_id==userFIND.objetivo_plan_proyecto_id){

                                              if(encargadosName==""){
                                                encargadosName = userFIND.name + "; ";
                                              }else{
                                                encargadosName = encargadosName + userFIND.name + "; ";
                                              }

                                            }

                                          });


                                          console.log('success888'+encargadosName);

                                          if(encargadosName==""){

                                            encargadosName = "Sin Asignar";

                                          }

                                          $('#body1').empty();
                                          $('#body1').append("<p>Confirme si desea Eliminar Objetivo del Plan de Trabajo</p>");
                                          $('#body1').append("<p>Encargad@(s): "+ encargadosName +"</p>");
                                          $('#body1').append("<p>Objetivo Especifico: "+ ObjetivoPlanFind.objetivo_proyecto_descripcion +"</p>");
                                          $('#body1').append("<p>Fecha Inicio: "+ ObjetivoPlanFind.fecha_inicio.toString().split(" ")[0] +"</p>");
                                          $('#body1').append("<p>Fecha Fin: "+ ObjetivoPlanFind.fecha_final.toString().split(" ")[0] +"</p>");
                                          $('#body1').append("<p>Resultados Esperados: "+ ObjetivoPlanFind.resultado_esperado +"</p>");
                                          $('#body1').append("<p>Recursos: "+ ObjetivoPlanFind.recursos +"</p>");
                                          $('#body1').append("<p>Indicadores: "+ ObjetivoPlanFind.indicadores +"</p>");
                                          $("#btnConfirmar").attr("onclick", "eliminarObjetivoPlan("+varT+")");
                                          //$("#btnConfirmar").attr("onclick", "goParticipar2()");

                                             rowP4="";
                                             encargadosName="";

                                           }

                                      });


                                  },
                                  error:function(){

                                  }
                              });





}


   function goParticipar2(){

      alert("FUMELA RASTA");

   }


      function eliminarObjetivoPlan(varT){

      //alert("FUMELA RASTA "+varT);

                                 $.ajax({


                                  type:'get',
                                  url:'{{URL::to('eliminarObjetivosPlan/')}}',

                                  data:{'objetivo_plan_proyecto_id': varT},
                                  success:function(data){

                                      console.log('successCMON');

                                 cargarObjetivosPlan();
                                 $("#btnCerrarModal").click();


                                  },
                                  error:function(){

                                  }
                              });



   }




                   function cargarObjetivosPlanSearch(){

                            var objetivoEncontrar = "";
                            var pId  = <?php echo $proyecto->plan_proyecto_id; ?>;
                            objetivoEncontrar = $('#searchTextObjetivo').val();

                                console.log(pId);

                           $.ajax({


                                  type:'get',
                                  url:'{{URL::to('cargarObjetivosPlan/')}}',

                                  data:{'plan_proyecto_id': pId},
                                  success:function(data){

                                      console.log('success');

                                      console.log(data);

                                      console.log(Object.keys(data).length);

                                      $('#tblObjetivosPlan').empty();
                                      $('#tblObjetivosPlan').append('<thead>' +
                                        '<th></th>' +
                                        '<th> Encargad@(s)</th>'+
                                        '<th> Objetivo Especifico</th>'+
                                        '<th> Fecha Inicio</th>'+
                                        '<th> Fecha Fin</th>'+
                                        '<th> Resultados Esperados</th>'+
                                        '<th> Recursos</th>'+
                                        '<th> Indicadores</th>'+
                                        '</thead>');

                                      var rowP4 = "";
                                      planTrabajoEnlistado = [];
                                      var encargadosName = "";


                                      $.each(data.data, function(index, ObjetivoPlanFind){
                                          planTrabajoEnlistado.push(new PlanTrabajo(ObjetivoPlanFind.plan_proyecto_id, ObjetivoPlanFind.recursos));

                                          $.each(data.data2, function(index, userFIND){

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

                                           if( idU == 2){

                                            var rowP = "<tr>"+
                                          "<td>"+
                                          "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goVer('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' onClick=goEditar('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-deleteObjetivoPlan' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"')  type='button' disabled='true'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                          "</div>"+
                                          "</td>"+
                                          "<td>"+ encargadosName +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.objetivo_proyecto_descripcion +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.fecha_inicio.toString().split(" ")[0] +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.fecha_final.toString().split(" ")[0] +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.resultado_esperado +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.recursos +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.indicadores +"</td>";
                                           rowP4 += rowP;


                                           }else{

                                            var rowP = "<tr>"+
                                          "<td>"+
                                          "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goVer('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' onClick=goEditar('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-deleteObjetivoPlan' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+ObjetivoPlanFind.objetivo_plan_proyecto_id+"')  type='button'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                          "</div>"+
                                          "</td>"+
                                          "<td>"+ encargadosName +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.objetivo_proyecto_descripcion +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.fecha_inicio.toString().split(" ")[0] +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.fecha_final.toString().split(" ")[0] +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.resultado_esperado +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.recursos +"</td>"+
                                          "<td>"+ ObjetivoPlanFind.indicadores +"</td>";
                                           rowP4 += rowP;

                                           }


                                          if(objetivoEncontrar==""){

                                            $('#tblObjetivosPlan').append(rowP4 +
                                              "</tr>");

                                          }else{

                                            if (ObjetivoPlanFind.objetivo_proyecto_descripcion.toUpperCase().match(objetivoEncontrar.toUpperCase())){

                                            $('#tblObjetivosPlan').append(rowP4 +
                                              "</tr>");

                                           }

                                          }

                                             rowP4="";
                                             encargadosName="";

                                      });


                                  },
                                  error:function(){

                                  }
                              });

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
})()


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


var nameStrP = 'Proyecto: '+'<?php echo "$proyecto->nombre_proyecto"; ?>';

var nameStrOP = 'Plan de Trabajo: '+'<?php echo "$proyecto->plan_proyecto_nombre"; ?>';


function demoFromHTML() {


    var pdf = new jsPDF('l', 'pt', 'letter');
    var strName = 'Hello world!';


    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#customers')[0];
    pdf.text(20, 20, "Lista de Objetivos");
    pdf.text(20, 40, nameStrP);
    pdf.text(20, 60, nameStrOP);
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
        pdf.save('Objetivos.pdf');
    }, margins);
}



</script>


@endsection
