@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <h2>Listado de Planes de Trabajo </h2>
        <br>

            <h3> Proyecto:   &nbsp;&nbsp;&nbsp;&nbsp; {{ $proyecto->nombre_proyecto}}</h3>

            <br>
          @include('ModuloIE.PlanDeTrabajo.modalBuscarPlanTrabajo')
            &nbsp;&nbsp;<a data-target="#modal-BuscarProyecto" data-toggle="modal"><button class="btn btn-primary"> <span class="fa fa-search"></span>  Buscar</button></a>&nbsp;&nbsp;<a href="" id="linkTo" name="linkTo" ><button id="btnGenerarPlan" class="btn btn-warning"><span class="fa fa-plus-square"></span>  Nuevo</button></a>
            <br>

    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div id="customers">
            <div class="table-responsive">
                <table id="tblPlan" class="table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th></th>
                        <th> Nombre Del Plan De Trabajo</th>
                        <th> Periodo</th>
                        <th> #  Estudiantes</th>
                        <th> Responsable</th>
                    </thead>



                </table>
            </div>
        </div>

        @include('ModuloIE.PlanDeTrabajo.modal')



        <br>
    </div>
</div>

<script type="text/javascript">

    var bPreguntar = false;
    var idU = 0;

     window.onload = function() {

      document.getElementById('linkTo').href = changeNeButtonLink();

     cargarPlanTrabajo();
     idU = <?php  echo Auth::user()->role_id; ?>;
        if( idU == 2){

          document.getElementById('btnGenerarPlan').disabled=true;

        }


};


    window.onbeforeunload = preguntarAntesDeSalir;


function test()

    {

      bPreguntar = true;
      alert('test');
      bPreguntar = false;

    }

    var planTrabajoEnlistado = [];


function PlanTrabajo(plan_proyecto_id, plan_proyecto_nombre) {
  this.plan_proyecto_id = plan_proyecto_id;
  this.plan_proyecto_nombre = plan_proyecto_nombre;
}


    function preguntarAntesDeSalir()

    {

      if (bPreguntar)

        return "¿Seguro que quieres salir?";

    }



                function cargarPlanTrabajo(){

                            var pId  = <?php echo $proyecto->proyecto_investigacion_id; ?>;


                           $.ajax({


                                  type:'get',
                                  url:'{{URL::to('cargarPlanTrabajo/')}}',

                                  data:{'proyecto_investigacion_id': pId},
                                  success:function(data){


                                      $('#tblPlan').empty();
                                      $('#tblPlan').append('<thead>' +
                                        '<th></th>' +
                                          '<th>Nombre Del Plan Trabajo</th>' +
                                          '<th>Periodo</th>' +
                                          '<th># Estudiantes</th>' +
                                          '<th>Responsable</th>' +

                                      '</thead>');

                                      var rowP4 = "";
                                      planTrabajoEnlistado = [];


                                      $.each(data.data, function(index, PlanTrabajoFind){
                                          planTrabajoEnlistado.push(new PlanTrabajo(PlanTrabajoFind.plan_proyecto_id, PlanTrabajoFind.plan_proyecto_nombre));

                                          if( idU == 2){

                                            var rowP = "<tr>"+
                                          "<td>"+
                                          "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goVer('"+PlanTrabajoFind.plan_proyecto_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' onClick=goEditar('"+PlanTrabajoFind.plan_proyecto_id+"') type='button' disabled='true'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-deletePlan' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+PlanTrabajoFind.plan_proyecto_id+"')  type='button' disabled='true'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                          "</div>"+
                                          "</td>"+

                                          "<td>"+ PlanTrabajoFind.plan_proyecto_nombre +"</td>"+
                                          "<td>"+ PlanTrabajoFind.periodo +"</td>"+
                                          "<td>"+ PlanTrabajoFind.cantidad_encargados +"</td>"+
                                          "<td>"+ PlanTrabajoFind.name +"</td>";
                                           rowP4 += rowP;


                                          }else{

                                            var rowP = "<tr>"+
                                          "<td>"+
                                          "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goVer('"+PlanTrabajoFind.plan_proyecto_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' onClick=goEditar('"+PlanTrabajoFind.plan_proyecto_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-deletePlan' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+PlanTrabajoFind.plan_proyecto_id+"')  type='button'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                          "</div>"+
                                          "</td>"+

                                          "<td>"+ PlanTrabajoFind.plan_proyecto_nombre +"</td>"+
                                          "<td>"+ PlanTrabajoFind.periodo +"</td>"+
                                          "<td>"+ PlanTrabajoFind.cantidad_encargados +"</td>"+
                                          "<td>"+ PlanTrabajoFind.name +"</td>";
                                           rowP4 += rowP;


                                          }




                                            $('#tblPlan').append(rowP4 +
                                              "</tr>");


                                             rowP4="";

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


function changeNeButtonLink(){

var pId  = <?php echo $proyecto->proyecto_investigacion_id; ?>;

return getURLFromBrowser()+"ModuloIE/Proyecto/"+pId+"/PlanTrabajo/create";


}


function goVer(varT){

var pId  = <?php echo $proyecto->proyecto_investigacion_id; ?>;

window.location = getURLFromBrowser()+"ModuloIE/Proyecto/"+pId+"/PlanTrabajo/"+varT+"/ver";


}

function goEditar(varT){

var pId  = <?php echo $proyecto->proyecto_investigacion_id; ?>;

window.location = getURLFromBrowser()+"ModuloIE/Proyecto/"+pId+"/PlanTrabajo/"+varT+"/edit";

}


function goEliminar(varT){


      nameSTR =  varT;


      $.each(planTrabajoEnlistado, function(index, planT){

              if (planT.plan_proyecto_id==nameSTR){

                $('#body1').empty();
                $('#body1').append("<p>Confirme si desea Eliminar Plan de Trabajo : "+planT.plan_proyecto_nombre+" </p>");

              }

      });

      $("#btnConfirmar").attr("onclick", "eliminarPlan("+varT+")");



}


function eliminarPlan(varT){

      //alert("FUMELA RASTA "+varT);

       $.ajax({


        type:'get',
        url:'{{URL::to('eliminarPlan/')}}',

        data:{'plan_id': varT},
        success:function(data){


        },
        error:function(){

        }
    });

       cargarPlanTrabajo();
       $("#btnCerrarModal").click();


   }


   function goParticipar2(){

      alert("YA CASI");

   }


                   function cargarPlanTrabajoSearch(){

                            var objetivoEncontrar = "";
                            var pId  = <?php echo $proyecto->proyecto_investigacion_id; ?>;
                            objetivoEncontrar = $('#searchTextPlan').val();


                           $.ajax({


                                  type:'get',
                                  url:'{{URL::to('cargarPlanTrabajo/')}}',

                                  data:{'proyecto_investigacion_id': pId},
                                  success:function(data){



                                      $('#tblPlan').empty();
                                      $('#tblPlan').append('<thead>' +
                                        '<th></th>' +
                                          '<th>Nombre Del Plan Trabajo</th>' +
                                          '<th>Periodo</th>' +
                                          '<th># Estudiantes</th>' +
                                          '<th>Responsable</th>' +

                                      '</thead>');

                                      var rowP4 = "";
                                      planTrabajoEnlistado = [];


                                      $.each(data.data, function(index, PlanTrabajoFind){
                                          planTrabajoEnlistado.push(new PlanTrabajo(PlanTrabajoFind.plan_proyecto_id, PlanTrabajoFind.plan_proyecto_nombre));

                                          if( idU == 2){

                                            var rowP = "<tr>"+
                                          "<td>"+
                                          "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goVer('"+PlanTrabajoFind.plan_proyecto_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' onClick=goEditar('"+PlanTrabajoFind.plan_proyecto_id+"') type='button' disabled='true'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-deletePlan' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+PlanTrabajoFind.plan_proyecto_id+"')  type='button' disabled='true'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                          "</div>"+
                                          "</td>"+

                                          "<td>"+ PlanTrabajoFind.plan_proyecto_nombre +"</td>"+
                                          "<td>"+ PlanTrabajoFind.periodo +"</td>"+
                                          "<td>"+ PlanTrabajoFind.cantidad_encargados +"</td>"+
                                          "<td>"+ PlanTrabajoFind.name +"</td>";
                                           rowP4 += rowP;


                                          }else{

                                            var rowP = "<tr>"+
                                          "<td>"+
                                          "<div class='dropdown table-actions-dropdown'>"+
                                            "<button class='btn btn-sm btn-info dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='fa fa-cog'></span></button>"+
                                            "<ul class='dropdown-menu table-actions-dropdown-popup' aria-labelledby='dropdownMenu2'>"+
                                                "<li>"+
                                                "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Ver'>"+
                                                    "<a><button class='btn btn-primary' onClick=goVer('"+PlanTrabajoFind.plan_proyecto_id+"') type='button'><span class='fa fa-search'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Editar'>"+
                                                    "<a><button class='btn btn-success' onClick=goEditar('"+PlanTrabajoFind.plan_proyecto_id+"') type='button'><span class='fa fa-edit'></span></button></a>"+
                                                    "</span>"+
                                                    "<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Eliminar'>"+
                                                    "<a href='' data-target='#modal-deletePlan' data-toggle='modal'><button class='btn btn-danger' onClick=goEliminar('"+PlanTrabajoFind.plan_proyecto_id+"')  type='button'><span class='fa fa-trash-alt'></span></button></a>"+
                                                    "</span>"+
                                                "</li>"+
                                            "</ul>"+
                                          "</div>"+
                                          "</td>"+

                                          "<td>"+ PlanTrabajoFind.plan_proyecto_nombre +"</td>"+
                                          "<td>"+ PlanTrabajoFind.periodo +"</td>"+
                                          "<td>"+ PlanTrabajoFind.cantidad_encargados +"</td>"+
                                          "<td>"+ PlanTrabajoFind.name +"</td>";
                                           rowP4 += rowP;


                                          }






                                            if(objetivoEncontrar==""){

                                            $('#tblPlan').append(rowP4 +
                                              "</tr>");

                                            }else{

                                             if (PlanTrabajoFind.plan_proyecto_nombre.toUpperCase().match(objetivoEncontrar.toUpperCase())){

                                              $('#tblPlan').append(rowP4 +
                                                "</tr>");

                                             }else if(PlanTrabajoFind.periodo==objetivoEncontrar){

                                              $('#tblPlan').append(rowP4 +
                                                "</tr>");

                                            }
                                          }


                                             rowP4="";

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
    var tableSelect = document.getElementById("tblPlan");
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



function demoFromHTML() {

    var pdf = new jsPDF('p', 'pt', 'letter');
    var strName = 'Hello world!';


    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#customers')[0];
    pdf.text(20, 20, nameStrP);
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
        pdf.save('<?php echo "$proyecto->nombre_proyecto"; ?>'+'.pdf');
    }, margins);
}


</script>


@endsection
