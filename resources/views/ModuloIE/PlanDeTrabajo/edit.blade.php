@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<h3 align="center">Modificando Plan de Trabajo</h3>
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
            	<input type="text" id="txtNombrePlanTrabajo" name="txtNombrePlanTrabajo" class="form-control" value="{{$planTrabajoArray->plan_proyecto_nombre}}" placeholder="Nombre del Plan De Trabajo...">
            </div>

            <div class="form-group">
            	<label for="txtPeriodo">Periodo</label>
            	<input type="text" id="txtPeriodo" name="txtPeriodo" class="form-control" onkeypress="return periodoN(event)" value="{{$planTrabajoArray->periodo}}" placeholder="Periodo...">
            </div>

             <div class="form-group">
            	<label for="txtQtyEstudiantes">Cantidad de Estudiantes</label>
            	<input type="text" id="txtQtyEstudiantes" name="txtQtyEstudiantes" onkeypress="return soloNumeros(event)" value="{{$planTrabajoArray->cantidad_encargados}}" class="form-control" placeholder="Cantidad de Estudiantes...">
            </div>

				<div class="form-group">
                  <label>Responsable</label>
                  <br>
                <select name="responsable" id="responsable" class="form-control">

                <option value="0">Seleccionar Responsable</option>
                @foreach($profesores as $profe)

                @if($profe->id==$planTrabajoArray->responsable)
                <option value="{{$profe->id}}" selected>{{$profe->name}}</option>
                @else
                <option value="{{$profe->id}}">{{$profe->name}}</option>
                @endif

                @endforeach


                </select>


                </div>


            <div class="form-group" align="center">
            	<button class="btn btn-primary" type="button" onclick="modificarPlanTrabajo()">Modificar</button>
            	<button class="btn btn-danger" type="reset" onclick="goBack()">Cancelar</button>
            </div>


		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
		</div>
	</div>

<script>

        var colaboradorArray = [];

        var colaboradorArray2 = [];

        var periodosArray = [];

        var encargadosEncontrados = 0;

        var plan_proyecto_id = 0;

        var cantidad_encargados = 0;

     window.onload = function() {

        plan_proyecto_id = <?php  echo $planTrabajoArray->plan_proyecto_id; ?>;

        cantidad_encargados = <?php  echo $planTrabajoArray->cantidad_encargados; ?>;

        colaboradorArray = <?php echo json_encode($encargadosObj,JSON_FORCE_OBJECT); ?>;
        colaboradorArray2 = <?php echo json_encode($encargadosObj2,JSON_FORCE_OBJECT); ?>;
        encargadosEncontrados = Object.keys(colaboradorArray).length;
        cargarPeriodos();

};




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


function modificarPlanTrabajo() {

var planTrabajoId = '<?php echo $planTrabajoArray->plan_proyecto_id; ?>';
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
}else if(responsable==0){
alert("Debe seleccionar el responsable del plan de trabajo!");
}else{


      if(periodoEncontrado==0){
alert("El periodo ingresado no es valido!");
}else if(parseInt(cantidadEstudiantes)<encargadosEncontrados){
alert("No puede reducir la cantidad de encargados, ya existen participando " + encargadosEncontrados + " estudiantes!");
}else   if(parseInt(cantidadEstudiantes)==0){
alert("Debe ingresar la cantidad de estudiantes del plan de trabajo!");
}else   if(parseInt(cantidadEstudiantes)>30){
alert("Debe revisar la cantidad de estudiantes ingresada!");
}else{


        $.ajax({


        type:'get',
        url:'{{URL::to('modificarPlanTrabajo/')}}',

        data:{'plan_proyecto_id': planTrabajoId,'plan_proyecto_nombre': nombrePlan, 'periodo': periodoPlan, 'responsable': responsable, 'cantidad_encargados': cantidadEstudiantes, 'proyecto_investigacion_id': proyectoId},
        success:function(data){




        },
        error:function(){

        }
       });

        $.ajax();

			var pId  = <?php echo $proyecto->proyecto_investigacion_id; ?>;
			//alert(varT);
			window.location = getURLFromBrowser()+"ModuloIE/Proyecto/"+pId+"/PlanTrabajo";


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

window.location = getURLFromBrowser()+"ModuloIE/Proyecto/"+pId+"/PlanTrabajo";
}


</script>

@endsection
