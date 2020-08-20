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
									<?php foreach ($tipoDocumentoPloteo as $documento): ?>
										
										<?php $dataDocumento = $documento->ID_Documento . '*'
											. $documento->Cantidad_Documento . '*' .
											$documento->Impuesto_Documento . '*' . $documento->Serie_Documento ?>
										<option value="<?= $dataDocumento ?>"><?= $documento->Nombre_Documento
											?></option>
									<?php endforeach; ?>
								</select>
								<input type="hidden"
									   id="dataDocumentoPloteo">
								<input type="hidden"
									   id="idDocumentoPloteo"
									   name="idDocumentoPloteo">
								<input type="hidden"
									   id="impuestoDocumentoPloteo"
									   name="impuestoDocumentoPloteo">
							</div>
							<div class="col-sm-3">
								<label for="serieDocumentoPloteo">Serie</label>
								<input type="text"
									   name="serieDocumentoPloteo"
									   id="serieDocumentoPloteo"
									   class="form-control"
									   readonly>
							</div>
							<div class="col-sm-3">
								<label for="numeroDocumentoPloteo">Número</label>
								<input type="text"
									   name="numeroDocumentoPloteo"
									   id="numeroDocumentoPloteo"
									   class="form-control"
									   readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="clientePloteo">Cliente</label>
							<select id="clientePloteo"
									name="clientePloteo"
									class="form-control select-search"
									data-placeholder="Seleccione un cliente"
									data-fouc
									required>
								<option></option>
								<?php foreach ($clientePloteo as $value): ?>
									
									<option value="<?= $value->ID_Cliente ?>"><?= $value->Nombre_Cliente . ' ' . $value->Apellido_Cliente ?></option>'
								
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group row">
							<div class="col-sm-5">
								<label for="metrosPloteo">Metros de Ploteo</label>
								<input type="text"
									   name="metrosPloteo"
									   id="metrosPloteo"
									   class="form-control"
									   placeholder="1.75">
							</div>
							<div class="col-sm-7 align-self-end text-right">
								<button href="#"
										id="agregarPloteo"
										class="btn btn-block btn-success btn-icon"
										type="button"><i class="icon-trash"></i> Agregar
								</button>
							</div>
						</div>
						<div class="form-group">
							<div class="table-responsive">
								<table class="table table-bordered tablaAgregarPloteo">
									<thead>
										<tr>
											<th>Metros</th>
											<th>Precio Final</th>
											<th>Acción</th>
										</tr>
									</thead>
									<tbody>
									
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-4">
								<label for="subtotalPloteo">Subtotal:</label>
								<input type="text"
									   class="input form-control"
									   name="subtotalPloteo"
									   id="subtotalPloteo"
									   readonly
									   required>
							</div>
							<div class="col-md-4">
								<label for="ivaPloteo">IVA:</label>
								<input type="text"
									   class="input form-control"
									   name="ivaPloteo"
									   id="ivaPloteo"
									   readonly
									   required>
							</div>
							<div class="col-md-4">
								<label for="totalPloteo">Total:</label>
								<input type="text"
									   class="input form-control"
									   name="totalPloteo"
									   id="totalPloteo"
									   readonly
									   required>
							</div>
						</div>
						<div class="text-center">
							<button class="btn bg-primary-800"
									type="button"
									id="crearOrdenTrabajoPloteo">Crear Orden de Trabajo <i
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
<!-- MODAL EDITAR ORDEN DE TRABAJO SERVICIO TECNICO -->
<div id="modalEditarOtPloteo"
	 class="modal fade"
	 tabindex="-1">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Editar Orden de Trabajo Ploteo</h5>
				<button type="button"
						class="close"
						data-dismiss="modal">&times;
				</button>
			</div>
			<div class="modal-body">
				<form action=""
					  method="post"
					  id="formularioPloteo">
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="editarTipoDocumentoPloteo">Tipo de Documento</label>
							<select id="editarTipoDocumentoPloteo"
									name="editarTipoDocumentoPloteo"
									class="form-control"
									data-fouc
									required
									disabled="disabled">
								<?php foreach ($tipoDocumentoPloteo as $documento): ?>
									
									<option value="<?= $documento->ID_Documento ?>"><?= $documento->Nombre_Documento
										?></option>
								<?php endforeach; ?>
							</select>
							<input type="hidden"
								   id="editarDataDocumentoPloteo"
								   name="editarDataDocumentoPloteo">
							<input type="hidden"
								   id="editarIdDocumentoPloteo"
								   name="editarIdDocumentoPloteo">
							<input type="hidden"
								   id="editarImpuestoDocumentoPloteo"
								   name="editarImpuestoDocumentoPloteo">
							<input type="hidden"
								   id="editarIdOtPloteo"
								   name="editarIdOtPloteo">
						</div>
						<div class="col-sm-3">
							<label for="editarSerieDocumentoPloteo">Serie</label>
							<input type="text"
								   name="editarSerieDocumentoPloteo"
								   id="editarSerieDocumentoPloteo"
								   class="form-control"
								   disabled>
						</div>
						<div class="col-sm-3">
							<label for="editarNumeroDocumentoPloteo">Número</label>
							<input type="text"
								   name="editarNumeroDocumentoPloteo"
								   id="editarNumeroDocumentoPloteo"
								   class="form-control"
								   disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="editarClientePloteo">Cliente</label>
						<select id="editarClientePloteo"
								name="editarClientePloteo"
								class="form-control select-search"
								data-placeholder="Seleccione un cliente"
								data-fouc
								required>
							<option></option>
							<?php foreach ($clientePloteo as $value): ?>
								
								<option value="<?= $value->ID_Cliente ?>"><?= $value->Nombre_Cliente . ' ' . $value->Apellido_Cliente ?></option>'
							
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group row">
						<div class="col-sm-5">
							<label for="editarMetrosPloteo">Metros de Ploteo</label>
							<input type="text"
								   name="editarMetrosPloteo"
								   id="editarMetrosPloteo"
								   class="form-control"
								   placeholder="1.75">
						</div>
						<div class="col-sm-7 align-self-end text-right">
							<button href="#"
									id="editarAgregarPloteo"
									class="btn btn-block btn-success btn-icon"
									type="button"><i class="icon-trash"></i> Agregar
							</button>
						</div>
					</div>
					<div class="form-group">
						<div class="table-responsive">
							<table class="table table-bordered tablaEditarAgregarPloteo">
								<thead>
									<tr>
										<th>Metros</th>
										<th>Precio Final</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
								
								</tbody>
							</table>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-4">
							<label for="editarSubtotalPloteo">Subtotal:</label>
							<input type="text"
								   class="input form-control"
								   name="editarSubtotalPloteo"
								   id="editarSubtotalPloteo"
								   readonly
								   required>
						</div>
						<div class="col-md-4">
							<label for="editarIvaPloteo">IVA:</label>
							<input type="text"
								   class="input form-control"
								   name="editarIvaPloteo"
								   id="editarIvaPloteo"
								   readonly
								   required>
						</div>
						<div class="col-md-4">
							<label for="editarTotalPloteo">Total:</label>
							<input type="text"
								   class="input form-control"
								   name="editarTotalPloteo"
								   id="editarTotalPloteo"
								   readonly
								   required>
						</div>
					</div>
					<div class="text-center">
						<button class="btn bg-primary-800"
								type="button"
								id="editarOrdenTrabajoPloteo">Editar Orden de Trabajo <i
									class="icon-paperplane
									ml-2"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>