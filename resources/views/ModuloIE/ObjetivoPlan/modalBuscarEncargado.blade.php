<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-BuscarObjetivo">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button id="btnAtrasModal" name="btnAtrasModal" type="button" class="close" data-dismiss="modal"
        aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Busqueda Encargado</h4>
      </div>


                <?php


                $varNum = 0;
                $conEncargados = 0;
                $conEncargadosFinded = count($encargadosObj2);


                 ?>
        <div class="modal-body">
        <div class="form-group">
                  <label>Encargado</label>
                  <br>
                <select name="encargado" id="encargado" class="form-control">

                <option value="0">Seleccionar Encargado</option>







                @if(count($encargadosObj)<1) <!-- if principal validacion de si existen encargados con o sin objetivos asignados -->


                  @foreach($profesores as $profe)


                 <?php

                  $encargadoID = strval($profe->id)."-".strval($profe->encargado_plan_proyecto_id);

                 ?>


                  <option value="{{$encargadoID}}" style="background:#8ee5ee">{{$profe->name}}</option>


                  @endforeach



                @else<!-- if principal validacion de si existen encargados con o sin objetivos asignados -->



                <?php


                $encargadosObj3 = array_unique($encargadosObj2);


                ?>


                  @foreach($encargadosObj3 as $profe2) <!-- contando si existen encargados con objetivos asignados del plan de trabajo actual -->



                    <?php


                    $conEncargadosFinded = $conEncargadosFinded+1;


                    ?>




                   @endforeach<!-- contando si existen encargados con objetivos asignados del plan de trabajo actual -->






                  @if($conEncargadosFinded==0) <!-- validando si existen encargados con objetivos asignados del plan de trabajo actual -->






                  @foreach($profesores as $profe)


                 <?php

                  $encargadoID = strval($profe->id)."-".strval($profe->encargado_plan_proyecto_id);

                 ?>


                  <option value="{{$encargadoID}}" style="background:#8ee5ee">{{$profe->name}}</option>


                  @endforeach








                  @else <!-- validando si existen encargados con objetivos asignados del plan de trabajo actual -->







                  @foreach($encargadosObj as $profe2)



                                  @foreach($profesores as $profe)


                                   <?php

                                    $encargadoID = strval($profe->id)."-".strval($profe->encargado_plan_proyecto_id);

                                   ?>

                                    @if($profe->encargado_plan_proyecto_id == $profe2->encargado_plan_proyecto_id  && $profe2->plan_proyecto_id==$proyecto->plan_proyecto_id)

                                    <?php


                                    $varNum = 1;


                                    ?>


                                    @endIf



                                    @if($conEncargados == $conEncargadosFinded)

                                      <option value="{{$encargadoID}}" style="background:#8ee5ee">{{$profe->name}}</option>


                                    @else


                                                      @if($varNum == 1)
                                                      <option value="{{$encargadoID}}" style="background:#66cd00">{{$profe->name}}</option>
                                                      <?php

                                                      $conEncargados = $conEncargados + 1;
                                                      $varNum = 0;


                                                      ?>

                                                      @endIf


                                    @endIf





                                  @endforeach




                  @endforeach














                  @if($conEncargados == $proyecto->cantidad_encargados)

                  <option value="{{$encargadoID}}" style="background:#8ee5ee">{{$profe->name}}</option>

                  @else



                  @foreach($profesores as $profe)

                                 @foreach($encargadosObj as $profe2)



                                                <?php

                                                $encargadoID = strval($profe->id)."-".strval($profe->encargado_plan_proyecto_id);

                                               ?>

                                                @if($profe->encargado_plan_proyecto_id == $profe2->encargado_plan_proyecto_id && $profe2->plan_proyecto_id!=$proyecto->plan_proyecto_id)

                                                <?php


                                                $varNum = 1;


                                                ?>


                                                @endIf



                                  @endforeach



                                              @if($conEncargados == $proyecto->cantidad_encargados)


                                              @else



                                                                @if($varNum == 1)

                                                                  <?php $conEncargados = $conEncargados + 1; ?>
                                                                        <?php


                                                                        $varNum = 0;


                                                                        ?>

                                                                <option value="{{$encargadoID}}" style="background:#8ee5ee">{{$profe->name}}</option>

                                                                @endIf


                                              @endIf






                  @endforeach


                  @endIf













                  @endif <!-- validando si existen encargados con objetivos asignados del plan de trabajo actual -->






                @endIf <!-- if principal validacion de si existen encargados con o sin objetivos asignados -->
























                </select>


                </div>




  </div>




                <div class="modal-footer">

                  <button type="button" class="btn btn-success" onclick="cargarUsuarioCol()"><span class="fa fa-plus"></span></button>

      </div>



    </div>
  </div>


</div>
