<!-- Content area -->
<div class="content pt-0">
	<div class="row">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Reporte de las Órdenes de Trabajo</h5>
					<div class="header-elements">
						<div class="list-icons">
							<a class="list-icons-item"
							   data-action="collapse"></a>
							<a class="list-icons-item"
							   data-action="remove"></a>
						</div>
					</div>
				</div>
				
				<div class="card-body">
					<ul class="nav nav-tabs nav-tabs-top nav-justified">
						<li class="nav-item"><a href="#reporteServicioTecnico" class="nav-link active" data-toggle="tab">Reporte Servicio Técnico</a></li>
						<li class="nav-item"><a href="#reportePloteo" class="nav-link" data-toggle="tab">Reporte Ploteo</a></li>
					</ul>
					
					<div class="tab-content">
						<div class="tab-pane fade show active" id="reporteServicioTecnico">
							
								<div class="card-body">
									<table class="table"
										   id="tablaReporteServicioTecnico">
										<thead>
											<tr>
												<th>#</th>
												<th>Cliente</th>
												<th>Tipo de Documento</th>
												<th>Número de Documento</th>
												<th>Descripción</th>
												<th>Fecha</th>
												<th>Total</th>
												<th>Acciones</th>
											</tr>
										</thead>
									</table>
								</div>
						</div>
						
						<div class="tab-pane fade" id="reportePloteo">
							<div class="card-body">
								<table class="table"
									   id="tablaReporPloteo">
									<thead>
										<tr>
											<th>#</th>
											<th>Cliente</th>
											<th>Tipo de Documento</th>
											<th>Número de Documento</th>
											<th>Fecha</th>
											<th>Total</th>
											<th>Acciones</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
