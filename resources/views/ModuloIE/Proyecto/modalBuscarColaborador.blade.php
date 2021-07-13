<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete">
	
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button id="btnAtrasModal" name="btnAtrasModal" type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Colaborador</h4>
			</div>


			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
                  <label>Identificacion</label>
                  <br>
              <input type="text" id="idCol" name="idCol" class="form-control" placeholder="Identificacion del Colaborador. . . " onclick="idClick()">
              <input type="radio" id="idColOp" name="idColOp" value="0" checked disabled="true">
                </div>
                <div class="form-group">
                  <label>E-mail</label>
                  <br>
              <input type="text" id="emailCol" name="emailCol" class="form-control" placeholder="E-mail del Colaborador. . . " onclick="emailClick()">
              &nbsp;<input type="radio" id="emailColOp" name="emailColOp" disabled="true">
                </div>

				<div class="form-group">
                <label>Nombre del Colaborador</label>
                <br>
              	<input type="text" id="nameCol" name="nameCol" class="form-control" placeholder="Nombre del Colaborador. . . " onclick="nameClick()">
              	<input type="radio" id="nameColOp" name="nameColOp" disabled=true">
               </div>
                <br>
                </div>

              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

               <div class="form-group">
                <label>Nombre del Colaborador</label>
                <br>
              	<input type="text" id="nameColADD" name="nameColADD" class="form-control" readonly="true">
               </div>

              </div>

                <div class="modal-footer">

                	<button type="button" class="btn btn-primary" onclick="buscarColaborador()"><span class="fa fa-search"></span></button>

                	<button type="button" class="btn btn-success" onclick="cargarUsuarioCol()"><span class="fa fa-plus"></span></button></span></button>
				
			</div>
			

			
		</div>
	</div>
	

</div>

