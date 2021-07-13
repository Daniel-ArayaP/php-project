<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-BuscarProyecto">
	
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Busqueda de Proyecto</h4>
			</div>



        <div class="modal-body">
    <input type="text" class="form-control" name="searchText" id="searchText" placeholder="Buscar...">

                <br>
                <input type="radio" id="condicionP3" name="condicionP3" value="1" onclick="changeMyProject()"> Mis Proyectos
          &nbsp;&nbsp;&nbsp;<input type="radio" id="condicionP4" name="condicionP4" value="0" checked onclick="changeAllProject()"> Todos los Proyectos



                
  </div>
   


                <div class="modal-footer">

                	<button class="btn btn-primary" id="btnSearch" name="btnSearch" onclick="searchProjectAll()"><span class='fa fa-search'></span>  Buscar</button>

                	<button type="button" class="btn btn-danger" onclick="demoFromHTML()"><span class="fa fa-file-pdf"></span>&nbsp;&nbsp;PDF</button>

                  <button type="button" class="btn btn-success" onclick="tableToExcel('tblData', 'Proyectos')"><span class="fa fa-file-excel"></span>&nbsp;&nbsp;XLSX</button>

         <button id="exportButtonCSV" name="exportButtonCSV" class="btn btn-success clearfix" onclick="exportTableToCSV('plan.csv')"><span class="fa fa-file-excel"></span>&nbsp;&nbsp;CSV</button>
				
			</div>
			

			
		</div>
	</div>
	

</div>

