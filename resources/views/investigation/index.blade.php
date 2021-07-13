@extends('layouts.app')

@section('content')
@if(isset($sucess))
    <div class="alert alert-success alertDismissible">
    <button type = "button" class="close" data-dismiss = "alert">x</button>
        {{ $sucess }}
    </div>
@endif

<div class="row">
    <form>
        
    </form>
</div>
<br />
<div class="panel panel-primary">
            
    <div class="panel-heading">
        <h4>Listado de Proyectos</h4>
    </div>
    
    <div class="panel-body">
        <div class="scrollable-area">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Tipo
                        </th>
                        <th>
                            Estado
                        </th>
                        <th>
                            Responsable / Contacto2
                        </th>
                    </tr>
                </thead>
                
                @foreach ($investigaciones as $inv)
                
                    <tr>
                        <td><a href="{{ route('createInvestigation',['idInv'=>$inv->id_investigaciones]) }}" class="btn btn-sm btn-primary-ulat">Informaci&oacute;n</a></td>

                        <td>{{ $inv->nombre_investigaciones }}</td>
                        <td>{{ $inv->tipo_investigaciones }} </td>
                        @if( $inv->publicado_investigaciones == 1)
                            <td> Publicado </td>
                        @else
                            <td> Revision </td>
                        @endif
                        <td>{{ $inv->email}}</td>
                    </tr>  
                          
                @endforeach
            </table>
        </div>
       
    </div>
</div>
@endsection