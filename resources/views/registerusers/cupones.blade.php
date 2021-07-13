
<div class="container-fluid">
    <form method="POST" action="{{ route('registerUsers') }}" role="search">
        {{ csrf_field() }}
        <h2>---Usuarios Registro</h2>
        <hr />
        <br />
        <div class="row">
            <div class="form-group col-md-4">
                <label for="name" class="control-label">Nombre</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            <div class="col-md-8 btn-group" role="group" style="margin-top: 25px;">
                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Buscar</button>

            </div>
        </div>
        <br />
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Lista de Cupones</h4>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>
                                Nombre del cupon
                            </th>
                            <th>
                                Cantidad de cupones
                            </th>
                            <th>
                                Fecha de Creación
                            </th>
                        </tr>
                        </thead>

                        </table>
                    </div>
            </div>
