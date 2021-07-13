@extends('layouts.app')
@section('content')
<div class="container-fluid">
           <h2>Proponer Curso</h2>
        <hr />

        <div class="form-horizontal">
        <form onsubmit="return confirm('Esta seguro que desea Guardar?');" method="POST" action="{{ route('trainingSave') }}" >
                {{ csrf_field() }}
                    <div class="container">

                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Área de Interés</label>
                            <div class="col-md-4">
                                <input type="text" id="area" maxlength="45" required name="area" class="form-control">
                            </div>
                        </div>
                        <!--TIPO-->

             
               <div class="form-group">
                        <label for="" class="col-md-4 control-label">Tipo</label>
                        
                       
                            <div class="col-md-6">
                                <div class="checkbox">
                                <label class="form-check-label" for="materialInline1">Curso libre</label>
                        <input type="radio"  name="type" class="form-check-input " id="Course" value="curso libre" checked >
                        
                  
                            <label class="form-check-label" for="materialInline2">Tutoria</label>
                        <input type="radio" name="type" class="form-check-input" id="Training" value="tutoria">
                     
                  
                </div>
                </div>

                </div> 
                    

               

                                        


                        <!--END-->

                        <div class="form-group">
                                <label for="" class="col-md-4 control-label">Fecha Inicio</label>
                                <div class="col-md-4">
                                    <input type="date" id="start_date" required name="start_date" class="form-control">
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="" class="col-md-4 control-label">Fecha final</label>
                                <div class="col-md-4">
                                    <input type="date" id="end_date" required name="end_date" class="form-control">
                                </div>
                        </div>
                        <!-- hour pcicker-->
                        <div class="form-group{{ $errors->has('startTime') ? ' has-error' : '' }}">
                            <label for="startTime" class="col-md-4 control-label">Horario</label>
            
                            <div class="col-md-2">
                                <div class='input-group time'>
                                    <input id="startTime" type="text" class="form-control" name="startTime" value="{{ old('startTime') }}" required />
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
                                    <input id="endTime" type="text" class="form-control" name="endTime" value="{{ old('endTime') }}" required />
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
                                    <input type="text" id="name_course" maxlength="45" required name="name_course" class="form-control">
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="" class="col-md-4 control-label">Descripci&oacute;n</label>
                                <div class="col-md-4">
                                <textarea  id="description" rows="3" cols="31" required name="description" class="form-control " >
                                </textarea>
                                </div>
                        </div>
                       {{--  <div class="form-group">
                                <label for="" class="col-md-4 control-label">Lugar</label>
                                <div class="col-md-4">
                                    <input type="text" id="place" maxlength="45" name="place" required class="form-control">
                                </div>
                        </div> --}}

                        <!---->
                    
                     <div class="form-group" >
                            <label for="" class="col-md-4 control-label">Lugar</label>
                            <div class="col-md-4">
                                    <select class="checkbox" id="place" name="place"  onchange="sede('place','sede')">
                                            <option value="zoom" id="zoom" checked>Zoom</option>
                                        <option value="zoom" id="zoom" checked>Teams</option>
                                            <option value="presencial" id="presencial">Presencial</option>
                                          </select>
                            </div>
                    </div> 




                        <!--Falta de guardar-->
                    
                        <div class="form-group" style="display:none;" id="sede">
                                <label for="" class="col-md-4 control-label">Sede</label>
                                <div class="col-md-4">
                                        <select class="checkbox"  id="sedes" name="sedes">
                                                <option value="San Pedro">San Pedro</option>
                                                <option value="Heredia">Heredia</option>
                                                <option value="Guapiles">Guapiles</option>
                                                <option value="Perez Zeledon">Perez Zeledon</option>
                                                <option value="Santa Cruz">Santa Cruz</option>
                                                <option value="Grecia">Grecia</option>
                                              </select>
                                </div>
                        </div> 

                        <!---->




                       {{--  <div class="form-group">
                                <label for="" class="col-md-4 control-label">¿Tiene Costo?</label>
                                <div class="col-md-4">
                                    <input type="checkbox" id="is_free" name="is_free" value="0" onclick="openPrice()" class="form-control">
                                </div>
                        </div> --}}

              
                          <!---->

                          <div class="form-group">
                                <label for="period" class="col-md-4 control-label">¿Tiene Costo?  </label>
                
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        
                                            <input  style="margin-left: 0px;"
                                             type="checkbox"  id="is_free" name="is_free" value="0" onclick="openPrice()">
                                    </div>
                                </div>
                            </div>


                          <!---->
                        <div class="form-group" id="id_price">
                                <label for="" class="col-md-4 control-label">Precio del curso</label>
                                <div class="col-md-4">
                                    <input type="number" id="price" name="price" class="form-control">
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="" class="col-md-4 control-label">Límite de personas</label>
                                <div class="col-md-4">
                                    <input type="number" id="max_group" min="1" max="999" required name="max_group" class="form-control">
                                </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary-ulat">
                                Guardar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Siguiente
                            </button>
                            <a href="{{ route('trainingList') }}" class="btn btn-primary-ulat">Confirmar </a>
                            <a href="{{ route('trainingList') }}" class="btn btn-primary">Regresar</a>
                        </div>
                    </div>
            </form>
        </div>      
</div>
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
   text.style.display = "none";




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