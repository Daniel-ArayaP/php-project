@extends('layouts.app')
@section('content')
<div class="container-fluid">
 <h2> Detalles del Curso</h2>
 <br />
      <a href="{{ route('adminTraining') }}" class="btn btn-default">Regresar</a>
 </div>

 <div class="form-horizontal">
             <div class="container">
                 <div class="form-group">
                     <label for="" class="col-md-4 control-label">Área de Interés</label>
                     <div class="col-md-4">
                         <input type="text" id="area" name="area" value="{{$trainingCourse->area}}"  class="form-control">
                     </div>
                 </div>

                 <div class="form-group">
                    <label for="" class="col-md-4 control-label">Tipo</label>
                    
                   
                        <div class="col-md-6">
                            <div class="checkbox">
                            <label class="form-check-label" for="materialInline1">Curso libre</label>
                    <input type="radio"  name="type" class="form-check-input " id="Course" value="curso libre"
                    {{$trainingCourse->type== 'curso libre' ? 'checked' : ''}}>
                    
              
                        <label class="form-check-label" for="materialInline2">Tutoria</label>
                    <input type="radio" name="type" class="form-check-input" id="Training" value="tutoria"
                    {{$trainingCourse->type== 'tutoria' ? 'checked' : ''}} >
                 
              
                    </div>
                    </div>

                    </div> 
                







                 <div class="form-group">
                         <label for="" class="col-md-4 control-label">Fecha Inicio</label>
                         <div class="col-md-4">
                             <input type="date" id="start_date" name="start_date"  value="{{$trainingCourse->start_date}}" class="form-control">
                         </div>
                 </div>
                 <div class="form-group">
                         <label for="" class="col-md-4 control-label">Fecha final</label>
                         <div class="col-md-4">
                             <input type="date" id="end_date" name="end_date" value="{{$trainingCourse->end_date}}" class="form-control">
                         </div>
                 </div>
                 <!---->
                 <div class="form-group{{ $errors->has('startTime') ? ' has-error' : '' }}">
                    <label for="startTime" class="col-md-4 control-label">Horario</label>
    
                    <div class="col-md-2">
                        <div class='input-group time'>
                            <input id="startTime" type="text" class="form-control" name="startTime" value="{{ $trainingCourse->startTime }}"  required />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar">
                                </span>
                            </span>
                        </div>
    
                        @if ($errors->has('startTime'))
                            <span class="help-block">
                                <strong>{{ $errors->first('startTime') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!---->
                    <div class="col-md-2">
                        <div class='input-group time'>
                            <input id="endTime" type="text" class="form-control" name="endTime" value="{{ $trainingCourse->endTime }}"  required />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar">
                                </span>
                            </span>
                        </div>
    
                        @if ($errors->has('startTime'))
                            <span class="help-block">
                                <strong>{{ $errors->first('startTime') }}</strong>
                            </span>
                        @endif
                    </div>
                 </div>






                 <!---->
                 <div class="form-group">
                         <label for="" class="col-md-4 control-label">Nombre del Curso</label>
                         <div class="col-md-4">
                             <input type="text" id="name_course" name="name_course"  value="{{$trainingCourse->name_course}}" class="form-control">
                         </div>
                 </div>
                 <div class="form-group">
                         <label for="" class="col-md-4 control-label">Descripci&oacute;n</label>
                         <div class="col-md-4">
                         <textarea  id="description" rows="3" cols="31" name="description"  class="form-control " >
                         </textarea>
                         </div>
                 </div>
                {{--  <div class="form-group">
                         <label for="" class="col-md-4 control-label">Lugar</label>
                         <div class="col-md-4">
                             <input type="text" id="place" name="place" value="{{$trainingCourse->place}}" disabled class="form-control">
                         </div>
                 </div> --}}
                 <div class="form-group" >
                    <label for="" class="col-md-4 control-label">Lugar</label>
                    <div class="col-md-4">
                            <select class="checkbox" id="place" name="place"  onchange="sede('place','sede')">
                                    <option value="zoom" id="zoom" 
                                    {{$trainingCourse->place== 'zoom' ? 'selected' : ''}}>Zoom</option>
                                    <option value="presencial" id="presencial"
                                    {{$trainingCourse->place== 'presencial' ? 'selected' : ''}}>Presencial</option>
                                  </select>
                    </div>
                     </div> 




                <!--Falta de guardar-->
            
                <div class="form-group"  id="sede">
                        <label for="" class="col-md-4 control-label " style="display:block;" >Sede</label>
                        <div class="col-md-4">
                                <select class="checkbox"  id="sedes" name="sedes">
                                        <option value="San Pedro" {{$trainingCourse->sede== 'San Pedro' ? 'selected' : ''}}>San Pedro</option>
                                        <option value="Heredia" {{$trainingCourse->sede== 'Heredia' ? 'selected' : ''}}>Heredia</option>
                                        <option value="Guapiles" {{$trainingCourse->sede== 'Guapiles' ? 'selected' : ''}}>Guapiles</option>
                                        <option value="Perez Zeledon" {{$trainingCourse->sede== 'Perez Zeledon' ? 'selected' : ''}}>Perez Zeledon</option>
                                        <option value="Santa Cruz" {{$trainingCourse->sede== 'Santa Cruz' ? 'selected' : ''}}>Santa Cruz</option>
                                        <option value="Grecia" {{$trainingCourse->sede== 'Grecia' ? 'selected' : ''}}>Grecia</option>
                                      </select>
                        </div>
                </div> 

                 <!---->
                 <div class="form-group">
                         <label for="" class="col-md-4 control-label">¿Tiene Costo?</label>
                         <div class="col-md-4">
                            @if ($trainingCourse->is_free == 1) 
                             <input type="checkbox" id="is_free" name="is_free" value="{{$trainingCourse->is_free}}" checked  onclick="openPrice()" class="checkbox">
                            @else
                            <input type="checkbox" id="is_free" name="is_free" value="{{$trainingCourse->is_free}}"  onclick="openPrice()" class="checkbox">
                            @endif
                         </div>
                 </div>
                 <div class="form-group" id="id_price">
                         <label for="" class="col-md-4 control-label">Precio</label>
                         <div class="col-md-4">
                             <input type="number" id="price" name="price"  value="{{$trainingCourse->price}}" class="form-control">
                         </div>
                 </div>
                 <div class="form-group">
                        <label for="" class="col-md-4 control-label">Límite de Personas</label>
                        <div class="col-md-4">
                            <input type="number" id="max_group" value="{{$trainingCourse->max_group}}"  name="max_group" class="form-control">
                        </div>
                </div>
                 <div class="form-group">
                        <label for="" class="col-md-4 control-label">Límite de Tiempo</label>
                        <div class="col-md-4">
                            <input type="date" id="closed_at" value="{{$trainingCourse->closed_at}}"  name="closed_at" class="form-control">
                        </div>
                </div>
            </div>
</div>
@if ($trainingCourse->is_free == 1) 
<script>
document.getElementById("id_price").style.display="block";
</script>
@else
<script>
document.getElementById("id_price").style.display="none";
</script>
@endif
<script>
    document.getElementById("description").innerHTML="{{$trainingCourse->description}}";
</script>

@if ($trainingCourse->place == "presencial") 
<script>
document.getElementById("sede").style.display="block";
</script>
@else
<script>
document.getElementById("sede").style.display="none";
</script>
@endif


<script>
    var text = document.getElementById("id_price");
   function openPrice(){
      // Get the checkbox
  var checkBox = document.getElementById("is_free");
  // Get the output text
  text = document.getElementById("id_price");
  
  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    checkBox.value =1;
    text.style.display = "block";
  } else {
    text.style.display = "none";
    checkBox.value =0;
  }
   }
   




function sede(s1,s2){
var s1 = document.getElementById(s1);
var s2 = document.getElementById(s2);
if(s1.value=="presencial"){
    s2.style.display = "block";
}else{
    s2.style.display = "none";
}


}


</script>






@endsection
