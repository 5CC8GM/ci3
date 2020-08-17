<!-- Content area -->
<div class="content pt-0">
	<div class="row">
		<div class="col-xl-4">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Crear Orden de Trabajo Ploteo</h5>
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
					<form action=""
						  method="post"
						  id="formularioPloteo">
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="tipoDocumentoPloteo">Tipo de Documento</label>
								<select id="tipoDocumentoPloteo"
										name="tipoDocumentoPloteo"
										class="form-control"
										data-fouc
										required>
									<option></option>
									<?php foreach ($tipoDocumento as $documento): ?>
										
										<?php $dataDocumento = $documento->ID_Documento . '*'
											. $documento->Cantidad_Documento . '*' .
											$documento->Impuesto_Documento . '*' . $documento->Serie_Documento ?>
										<option value="<?= $dataDocumento ?>"><?= $documento->Nombre_Documento
											?></option>
									<?php endforeach; ?>
								</select>
								<input type="hidden"
									   id="infoOculta">
								<input type="hidden"
									   id="idDocumento"
									   name="idDocumento">
								<input type="hidden"
									   id="impuestoDocumento"
									   name="impuestoDocumento">
							</div>
							<div class="col-sm-3">
								<label for="serieDocumento">Serie</label>
								<input type="text"
									   name="serieDocumento"
									   id="serieDocumento"
									   class="form-control"
									   readonly>
							</div>
							<div class="col-sm-3">
								<label for="numeroDocumento">Número</label>
								<input type="text"
									   name="numeroDocumento"
									   id="numeroDocumento"
									   class="form-control"
									   readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="cliente">Cliente</label>
							<select id="cliente"
									name="cliente"
									class="form-control select-search"
									data-placeholder="Seleccione un cliente"
									data-fouc
									required>
								<option></option>
								<?php foreach ($cliente as $value): ?>
									
									<option value="<?= $value->ID_Cliente ?>"><?= $value->Nombre_Cliente . ' ' . $value->Apellido_Cliente ?></option>'
								
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group row">
							<div class="col-sm-5">
								<label for="numeroDocumento">Metros de Ploteo</label>
								<input type="text"
									   name="numeroDocumento"
									   id="numeroDocumento"
									   class="form-control"
									   placeholder="1.75">
							</div>
							<div class="col-sm-7 align-self-end text-right">
								<a href="#"
								   id=""
								   value=""
								   class="btn btn-block btn-success btn-icon"
								   type="button"><i class="icon-trash"></i> Agregar
								</a>
							</div>
						</div>
						<div class="form-group">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Metros</th>
											<th>Importe</th>
											<th>Acción</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input type="text"
													   class="form-control"></td>
											<td><input type="text"
													   class="form-control"
													   readonly></td>
											<td><a href="#"
												   id=""
												   value=""
												   class="btn btn-danger btn-icon"
												   type="button"><i class="icon-trash"></i></a></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-4">
								<label for="subtotal">Subtotal:</label>
								<input type="text"
									   class="input form-control"
									   name="subtotal"
									   id="subtotal"
									   readonly
									   required>
							</div>
							<div class="col-md-4">
								<label for="subtotal">IVA:</label>
								<input type="text"
									   class="input form-control"
									   name="subtotal"
									   id="subtotal"
									   readonly
									   required>
							</div>
							<div class="col-md-4">
								<label for="subtotal">Total:</label>
								<input type="text"
									   class="input form-control"
									   name="subtotal"
									   id="subtotal"
									   readonly
									   required>
							</div>
						</div>
						<div class="text-center">
							<button class="btn bg-primary-800"
									type="button"
									id="crearOrdenTrabajoServicioTecnico">Crear Orden de Trabajo <i
										class="icon-paperplane
									ml-2"></i></button>
						</div>
					</form>
				
				</div>
			</div>
		</div>
		<div class="col-xl-8">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Ploteo</h5>
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
					<table class="table"
						   id="tablaPloteo">
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
		</div>
	</div>
</div>