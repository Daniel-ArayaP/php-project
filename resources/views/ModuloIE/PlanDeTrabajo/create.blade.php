@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<h3 align="center">Nuevo Plan de Trabajo</h3>
			<br>
			<h3> Proyecto:   &nbsp;&nbsp;&nbsp;&nbsp; {{ $proyecto->nombre_proyecto}}</h3>
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


            <div class="form-group">
            	<label for="txtNombrePlanTrabajo">Nombre del Plan de Trabajo</label>
            	<input type="text" id="txtNombrePlanTrabajo" name="txtNombrePlanTrabajo" class="form-control" placeholder="Nombre del Plan De Trabajo...">
            </div>

            <div class="form-group">
            	<label for="txtPeriodo">Periodo</label>
            	<input type="text" id="txtPeriodo" name="txtPeriodo" class="form-control" onkeypress="return periodoN(event)" placeholder="Periodo...">
            </div>

             <div class="form-group">
            	<label for="txtQtyEstudiantes">Cantidad de Estudiantes</label>
            	<input type="text" id="txtQtyEstudiantes" name="txtQtyEstudiantes" class="form-control" onkeypress="return soloNumeros(event)" placeholder="Cantidad de Estudiantes...">
            </div>

				<div class="form-group">
                  <label>Responsable</label>
                  <br>
                <select name="responsable" id="responsable" class="form-control">

                <option value="0">Seleccionar Responsable</option>

                @foreach($profesores as $profe)
                <option value="{{$profe->id}}">{{$profe->name}}</option>
                @endforeach


                </select>


                </div>


            <div class="form-group" align="center">
            	<button class="btn btn-primary" type="button" onclick="registrarPlanTrabajo()">Guardar</button>
            	<button class="btn btn-danger" type="reset" onclick="goBack()">Cancelar</button>
            </div>


		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
		</div>
	</div>

<script>


var periodosArray = [];


     window.onload = function() {
        cargarPeriodos();
};




function soloNumeros(e){
  var key = window.event ? e.which : e.keyCode;

    if (key < 48 || key > 57 ) {
    e.preventDefault();
  }

}


function periodoN(e){
  var key = window.event ? e.which : e.keyCode;
  if (key == 45 ) {

  }else{
    if (key < 48 || key > 57 ) {
    e.preventDefault();
  }
  }
}



        function cargarPeriodos(){

            var currentDate = new Date();

          var varMonth = currentDate.getMonth()+1;
          var varYear = currentDate.getUTCFullYear();
          var varLastYear = currentDate.getUTCFullYear()-1;
          var varNextYear = currentDate.getUTCFullYear()+1;
          var varNextNextYear = currentDate.getUTCFullYear()+2;
          var varNextNextNextYear = currentDate.getUTCFullYear()+3;
          var periodoActual = "";
          var periodoMatricular = "";
          var inicio1 = new Date();
          var inicio2 = new Date();
          var fin1 = new Date();
          var fin2 = new Date();


          var numCuatri = 0;


            if (varMonth>=1&&varMonth<=4){

            periodosArray.push( varLastYear + "-3");
            periodosArray.push( varYear + "-1");
            periodosArray.push( varYear + "-2");
            periodosArray.push( varYear + "-3");
            periodosArray.push( varNextYear + "-2");
            periodosArray.push( varNextYear + "-3");
            periodosArray.push( varNextYear + "-1");
            periodosArray.push( varNextNextYear + "-1");
            periodosArray.push( varNextNextYear + "-2");
            periodosArray.push( varNextNextYear + "-3");

          }else if (varMonth>=5&&varMonth<=8){


            periodosArray.push( varYear + "-1");
            periodosArray.push( varYear + "-2");
            periodosArray.push( varYear + "-3");
            periodosArray.push( varNextYear + "-1");
            periodosArray.push( varNextYear + "-2");
            periodosArray.push( varNextYear + "-3");
            periodosArray.push( varNextNextYear + "-1");
            periodosArray.push( varNextNextYear + "-2");
            periodosArray.push( varNextNextYear + "-3");


          }else if (varMonth>=9&&varMonth<=12){



            periodosArray.push( varYear + "-2");
            periodosArray.push( varYear + "-3");
            periodosArray.push( varNextYear + "-1");
            periodosArray.push( varNextYear + "-2");
            periodosArray.push( varNextYear + "-3");
            periodosArray.push( varNextNextYear + "-1");
            periodosArray.push( varNextNextYear + "-2");
            periodosArray.push( varNextNextYear + "-3");
            periodosArray.push( varNextNextNextYear + "-1");
            periodosArray.push( varNextNextNextYear + "-2");
            periodosArray.push( varNextNextNextYear + "-3");

          }
}




function registrarPlanTrabajo() {



var nombrePlan = $('#txtNombrePlanTrabajo').val();
var periodoPlan = $('#txtPeriodo').val();
var periodoEncontrado = 0;
var cantidadEstudiantes = $('#txtQtyEstudiantes').val();
var responsable = $('#responsable').val();
var proyectoId = '<?php echo $proyecto->proyecto_investigacion_id; ?>';


    for(MP=0; MP<=Object.keys(periodosArray).length-1; MP++){


        if(periodosArray[MP] == periodoPlan){

            periodoEncontrado =  1;

        }



    }


if(nombrePlan===""){
alert("Debe ingresar el nombre del plan de trabajo!");
}else if(periodoPlan===""){
alert("Debe ingresar el periodo del plan de trabajo!");
}else if(cantidadEstudiantes===""){
alert("Debe ingresar la cantidad de estudiantes del plan de trabajo!");
}else{


         if(periodoEncontrado==0){
alert("El periodo ingresado no es valido!");
}else if(parseInt(cantidadEstudiantes)==0){
alert("Debe ingresar la cantidad de estudiantes del plan de trabajo!");
}else   if(parseInt(cantidadEstudiantes)>30){
alert("Debe revisar la cantidad de estudiantes ingresada!");
}else{


        $.ajax({


        type:'get',
        url:'{{URL::to('guardarPlanTrabajo/')}}',

        data:{'plan_proyecto_nombre': nombrePlan, 'periodo': periodoPlan, 'responsable': responsable, 'cantidad_encargados': cantidadEstudiantes, 'proyecto_investigacion_id': proyectoId},
        success:function(data){

            //proceso de insercesion de datos
            console.log("TETA");




        },
        error:function(){

        }
       });

        $.ajax();
        $.ajax();
        $.ajax();

        $.ajax(window.location = getURLFromBrowser()+"ModuloIE/Proyecto/"+proyectoId+"/PlanTrabajo");

}



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

		var pId  = <?php echo $proyecto->proyecto_investigacion_id; ?>;
    window.location = getURLFromBrowser()+"ModuloIE/Proyecto/"+pId+"/PlanTrabajo"
}


</script>

@endsection
