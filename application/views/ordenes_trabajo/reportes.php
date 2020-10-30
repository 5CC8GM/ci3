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
						<li class="nav-item"><a href="#reporteServicioTecnico"
												class="nav-link active"
												data-toggle="tab">Reporte Servicio Técnico</a></li>
						<li class="nav-item"><a href="#reportePloteo"
												class="nav-link"
												data-toggle="tab">Reporte Ploteo</a></li>
					</ul>
					
					<div class="tab-content">
						<div class="tab-pane fade show active"
							 id="reporteServicioTecnico">
							
							<div class="card-body">
								<form action=""
									  method="post"
									  id="buscarServicioTecnico">
									<div class="form-group row">
										<div class="col-sm-4">
											<div class="row">
												<label class="col-lg-4 col-form-label text-lg-right">Desde:</label>
												<div class="col-lg-8">
													<input type="text"
														   class="form-control"
														   name="fechaInicio"
														   id="fechaInicio" data-value="" placeholder="Seleccione una fecha de inicio">
												</div>
											</div>
										
										</div>
										<div class="col-sm-4">
											<div class="row">
												<label class="col-lg-4 col-form-label text-lg-right">Hasta:</label>
												<div class="col-lg-8">
													<input type="text"
														   class="form-control"
														   name="fechaFin"
														   id="fechaFin" data-value="" placeholder="Seleccione una fecha de fin">
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="row">
												<div class="col-lg-6">
													<button type="button" onclick="buscarReporteServicioTecnico()"
															class="btn btn-block btn-primary buscarFechaServicioTecnico">Buscar
													</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<table class="table"
									   id="tablaReporteServicioTecnico">
									<thead>
										<tr>
											<th>#</th>
											<th>Cliente</th>
											<th>Tipo de Documento</th>
											<th>Estado del Documento</th>
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
						
						<div class="tab-pane fade"
							 id="reportePloteo">
							<div class="card-body">
								<form action=""
									  method="post"
									  id="buscarPloteo">
									<div class="form-group row">
										<div class="col-sm-4">
											<div class="row">
												<label class="col-lg-4 col-form-label text-lg-right">Desde:</label>
												<div class="col-lg-8">
													<input type="date"
														   class="form-control"
														   name="fechaInicioPloteo"
														   id="fechaInicioPloteo">
												</div>
											</div>
										
										</div>
										<div class="col-sm-4">
											<div class="row">
												<label class="col-lg-4 col-form-label text-lg-right">Hasta:</label>
												<div class="col-lg-8">
													<input type="date"
														   class="form-control"
														   name="fechaFinPloteo"
														   id="fechaFinPloteo">
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="row">
												<div class="col-lg-6">
													<button type="button"
															onclick="buscarReportePloteo()"
															class="btn btn-block btn-primary buscarPloteo">Buscar
													</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<table class="table"
									   id="tablaReportePloteo">
									<thead>
										<tr>
											<th>#</th>
											<th>Cliente</th>
											<th>Tipo de Documento</th>
											<th>Estado del Documento</th>
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
