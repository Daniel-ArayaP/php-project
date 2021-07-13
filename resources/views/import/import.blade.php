@extends('layouts.app')
@section('content')

<h2>Favor ingresar los siguientes datos:</h2> 
<form action="{{ url('/import') }}" method="POST" role="form">
        <div id="container">
            {{ csrf_field() }}
            <label>Ingresar el codigo de la carrera: </label>
            &nbsp;&nbsp;
            <br>
            <input type="text"  maxlength="7" name="IdCarrerasUlatina" placeholder="max 7 caracteres" required  onkeypress="return valideKey(event);"/>
            &nbsp;&nbsp;
            <br><br>
            <label>Ingresar el nombre de la carrera: </label>
            &nbsp;&nbsp;
            <br>
            <input type="text"  maxlength="150" name="NombreCarreraUlatina" placeholder="max 150 caracteres" required onkeypress="return sololetras(event);"/>
            <br><br>
            <input class="btn btn-success"type="submit" value="Guardar">
        </div>
            </form>

            <br>
            <form class="form-upload" method="POST" action="{{ url('/import/uploadCsv') }}"  enctype="multipart/form-data">
            {{ csrf_field() }}
             <div class="form-group">
                <label for="file">Favor subir el documento con las materias respectivas:</label>
                <input type="file" name="upload-file">
                <p class="help-block">Favor tener el siguiente formato:
                <br>
                    id materia,nombre materia,creditos de materia,id carrera perteneciente
                </p>

              <div > 

                <button type="submit" class="btn btn-success" id="upload_f">Cargar</button>
              </div>
             </div>
</form>

        <h2>Favor registrar las materias independientes:</h2>
<form action="{{ url('/import/uploadMateria') }}" method="POST" role="form">
        <div id="container">
            {{ csrf_field() }}
          <p>   <label> Ingresar el Id de la materia: </label>
            &nbsp;&nbsp;
            <input type="text" name="id_contenido_carreras" maxlength="7" placeholder="max 7 caracteres" required  onkeypress="return valideKey(event);"/>
            <br><br>
           <label>Ingresar el nombre de la materia: </label>
            &nbsp;&nbsp;
            <input type="text" name="nombre_contenido_carreras" maxlength="50" placeholder="max 50 caracteres" required onkeypress="return sololetras(event);"/>
            <br><br>
            <label> Ingresar los creditos de la materia: </label>
            <input type="text" name="creditos_contenido_carreras" maxlength="1" placeholder="max 0-9" required onkeypress="return sololetras(event);"/>
            <br><br>
            <label> Ingresar el id de la carrera perteneciente: </label>
            <input type="text" name="ulatina_carreras_id_carreras_ulatina" maxlength="7" placeholder="max 7 caracteres" id="ulatina_carreras_id_carreras_ulatina" required onkeypress="return sololetras(event);"/>
            <br><br>
            <input class="btn btn-success"type="submit" value="Guardar">
            &nbsp;&nbsp;
            <a href="{{ url('convalidaciones')}}" class="btn btn-success">Regresar</a>
        </div>
            </form>

    </p>
<br>










@endsection
