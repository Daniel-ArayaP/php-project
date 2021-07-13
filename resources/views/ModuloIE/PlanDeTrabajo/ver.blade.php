@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<h3 align="center">Informacion del Plan de Trabajo</h3>
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
            	<input type="text" id="txtNombrePlanTrabajo" name="txtNombrePlanTrabajo" disabled class="form-control" value="{{$planTrabajoArray->plan_proyecto_nombre}}" placeholder="Nombre del Plan De Trabajo...">
            </div>

            <div class="form-group">
            	<label for="txtPeriodo">Periodo</label>
            	<input type="text" id="txtPeriodo" name="txtPeriodo" disabled class="form-control" value="{{$planTrabajoArray->periodo}}" placeholder="Periodo...">
            </div>

             <div class="form-group">
            	<label for="txtQtyEstudiantes">Cantidad de Estudiantes</label>
            	<input type="text" id="txtQtyEstudiantes" name="txtQtyEstudiantes" value="{{$planTrabajoArray->cantidad_encargados}}" disabled class="form-control" placeholder="Cantidad de Estudiantes...">
            </div>

				<div class="form-group">
                  <label>Responsable</label>
                  <br>
                <select name="responsable" id="responsable" disabled class="form-control">

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
            	<button class="btn btn-primary" type="button" onclick="abrirObjetivosPlanTrabajo()">Ver Objetivos</button>
            	<button class="btn btn-danger" type="reset" onclick="goBack()">Cancelar</button>
            </div>


		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
		</div>
	</div>

<script>

     window.onload = function() {

};


function abrirObjetivosPlanTrabajo() {
    //window.location.href = "/ModuloInvestigacionExtension/ModuloIE/Proyecto/PlanTrabajo/";


        var pId  = <?php echo $proyecto->proyecto_investigacion_id; ?>;
        var planTId  = <?php echo $planTrabajoArray->plan_proyecto_id; ?>;


      window.location = getURLFromBrowser()+'ModuloIE/Proyecto/'+pId+'/PlanTrabajo/'+planTId+'/ObjetivosPlanTrabajo';




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
			var planTId  = <?php echo $planTrabajoArray->plan_proyecto_id; ?>;

      window.location = getURLFromBrowser()+'ModuloIE/Proyecto/'+pId+'/PlanTrabajo';

}


</script>

@endsection
