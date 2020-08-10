<!-- Content area -->
<div class="content pt-0">
	<div class="row">
		<div class="col-xl-5">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Crear Orden de Trabajo Servicio Técnico</h5>
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
						  id="formularioServicioTecnico">
						<div class="form-group row">
							<div class="col-4">
								<label for="tipoDocumento">Tipo de Documento</label>
								<select id="tipoDocumento"
										name="tipoDocumento"
										class="form-control select"
										data-placeholder="Seleccione un documento"
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
									   id="idDocumento"
									   name="idDocumento">
								<input type="hidden"
									   id="impuestoDocumento"
									   name="impuestoDocumento">
							</div>
							<div class="col-4">
								<label for="serieDocumento">Serie del Documento</label>
								<input type="text"
									   name="serieDocumento"
									   id="serieDocumento"
									   class="form-control"
									   readonly>
							</div>
							<div class="col-4">
								<label for="numeroDocumento">Número de Documento</label>
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
							<div class="col-md-6">
								<label for="marca">Marca:</label>
								<input type="text"
									   class="form-control"
									   name="marca"
									   id="marca"
									   placeholder="Asus"
									   required>
							</div>
							<div class="col-md-6">
								<label for="modelo">Modelo:</label>
								<input type="text"
									   class="form-control"
									   name="modelo"
									   id="modelo"
									   placeholder="BHMX350"
									   required>
							</div>
						</div>
						<div class="form-group">
							<label for="descripcion">Descripción:</label>
							<textarea rows="1"
									  cols="1"
									  class="form-control elastic"
									  placeholder="Descripción:"
									  id="descripcion"
									  name="descripcion"
									  required></textarea>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<label for="precio">Precio:</label>
								<input type="text"
									   class="input form-control"
									   name="precio"
									   id="precio"
									   placeholder="30.50"
									   required>
							</div>
							<div class="col-md-6">
								<label for="iva">IVA:</label>
								<div class="input-group">
									<input type="text"
										   id="iva"
										   name="iva"
										   class="input form-control"
										   readonly>
									<span class="input-group-append">
									<span class="input-group-text">IVA</span>
								</span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6 ml-md-auto">
								<label for="subtotal">Subtotal:</label>
								<input type="text"
									   class="input form-control"
									   name="subtotal"
									   id="subtotal"
									   readonly
									   required>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6 ml-md-auto">
								<label for="total">Total:</label>
								<input type="text"
									   class="input form-control"
									   name="total"
									   id="total"
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
		<div class="col-xl-7">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Servicio Técnico</h5>
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
						   id="tablaServicioTecnico">
						<thead>
							<tr>
								<th>#</th>
								<th>Cliente</th>
								<th>Marca</th>
								<th>Modelo</th>
								<th>Descripcion</th>
								<th>Total</th>
								<th>Fecha de Creacion</th>
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
<div id="modalEditarOtServicioTecnico"
	 class="modal fade"
	 tabindex="-1">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Editar Orden de Trabajo Servicio Técnico</h5>
				<button type="button"
						class="close"
						data-dismiss="modal">&times;
				</button>
			</div>
			
			<form action=""
				  method="post"
				  id="formularioEditarOtServicioTecnico">
				<input type="hidden"
					   name="editarIdOtServicioTecnico"
					   id="editarIdOtServicioTecnico"
					   value="">
				<div class="modal-body">
					<div class="form-group">
						<label for="editarClienteOtServicioTecnico">Cliente</label>
						<select id="editarClienteOtServicioTecnico"
								name="editarClienteOtServicioTecnico"
								class="form-control select-search"
								data-placeholder="Seleccione un cliente"
								data-fouc
								required>
							<?php foreach ($cliente as $value): ?>
								
								<option value="<?= $value->ID_Cliente ?>"><?= $value->Nombre_Cliente . ' ' . $value->Apellido_Cliente ?></option>'
							
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="editarMarcaOtServicioTecnico">Marca:</label>
							<input type="text"
								   class="form-control"
								   name="editarMarcaOtServicioTecnico"
								   id="editarMarcaOtServicioTecnico"
								   placeholder="Asus"
								   required>
						</div>
						<div class="col-md-6">
							<label for="editarModeloOtServicioTecnico">Modelo:</label>
							<input type="text"
								   class="form-control"
								   name="editarModeloOtServicioTecnico"
								   id="editarModeloOtServicioTecnico"
								   placeholder="BHMX350"
								   required>
						</div>
					</div>
					<div class="form-group">
						<label for="editarDescripcionOtServicioTecnico">Descripción:</label>
						<textarea rows="1"
								  cols="1"
								  class="form-control elastic"
								  placeholder="Descripción:"
								  id="editarDescripcionOtServicioTecnico"
								  name="editarDescripcionOtServicioTecnico"
								  required></textarea>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="editarPrecioOtServicioTecnico">Precio:</label>
							<input type="text"
								   class="editarInput form-control"
								   name="editarPrecioOtServicioTecnico"
								   id="editarPrecioOtServicioTecnico"
								   placeholder="30.50"
								   required>
						</div>
						<div class="col-md-6">
							<label for="editarImpuestoOtServicioTecnico">Impuesto:</label>
							<div class="input-group">
								<input type="number"
									   id="editarImpuestoOtServicioTecnico"
									   name="editarImpuestoOtServicioTecnico"
									   class="editarInput form-control"
									   placeholder="12%"
									   min="0"
									   max="100">
								<span class="input-group-append">
									<span class="input-group-text">%</span>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6 ml-md-auto">
							<label for="editarSubtotalOtServicioTecnico">Subtotal:</label>
							<input type="text"
								   class="editarInput form-control"
								   name="editarSubtotalOtServicioTecnico"
								   id="editarSubtotalOtServicioTecnico"
								   readonly
								   required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6 ml-md-auto">
							<label for="editarTotalOtServicioTecnico">Total:</label>
							<input type="text"
								   class="editarInput form-control"
								   name="editarTotalOtServicioTecnico"
								   id="editarTotalOtServicioTecnico"
								   readonly
								   required>
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button"
							class="btn bg-danger-800"
							data-dismiss="modal">Cerrar
					</button>
					<button type="button"
							class="btn bg-primary-800"
							id="actualizarOtServicioTecnico">Editar
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /vertical form modal -->
<!-- MODAL VER ORDEN DE TRABAJO SERVICIO TECNICO -->
<div id="modalEditarOtServicioTecnico"
	 class="modal fade"
	 tabindex="-1">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Editar Orden de Trabajo Servicio Técnico</h5>
				<button type="button"
						class="close"
						data-dismiss="modal">&times;
				</button>
			</div>
			
			<form action=""
				  method="post"
				  id="formularioEditarOtServicioTecnico">
				<input type="hidden"
					   name="editarIdOtServicioTecnico"
					   id="editarIdOtServicioTecnico"
					   value="">
				<div class="modal-body">
					<div class="form-group">
						<label for="editarClienteOtServicioTecnico">Cliente</label>
						<select id="editarClienteOtServicioTecnico"
								name="editarClienteOtServicioTecnico"
								class="form-control select-search"
								data-placeholder="Seleccione un cliente"
								data-fouc
								required>
							<?php foreach ($cliente as $value): ?>
								
								<option value="<?= $value->ID_Cliente ?>"><?= $value->Nombre_Cliente . ' ' . $value->Apellido_Cliente ?></option>'
							
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="editarMarcaOtServicioTecnico">Marca:</label>
							<input type="text"
								   class="form-control"
								   name="editarMarcaOtServicioTecnico"
								   id="editarMarcaOtServicioTecnico"
								   placeholder="Asus"
								   required>
						</div>
						<div class="col-md-6">
							<label for="editarModeloOtServicioTecnico">Modelo:</label>
							<input type="text"
								   class="form-control"
								   name="editarModeloOtServicioTecnico"
								   id="editarModeloOtServicioTecnico"
								   placeholder="BHMX350"
								   required>
						</div>
					</div>
					<div class="form-group">
						<label for="editarDescripcionOtServicioTecnico">Descripción:</label>
						<textarea rows="1"
								  cols="1"
								  class="form-control elastic"
								  placeholder="Descripción:"
								  id="editarDescripcionOtServicioTecnico"
								  name="editarDescripcionOtServicioTecnico"
								  required></textarea>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="editarPrecioOtServicioTecnico">Precio:</label>
							<input type="text"
								   class="editarInput form-control"
								   name="editarPrecioOtServicioTecnico"
								   id="editarPrecioOtServicioTecnico"
								   placeholder="30.50"
								   required>
						</div>
						<div class="col-md-6">
							<label for="editarImpuestoOtServicioTecnico">Impuesto:</label>
							<div class="input-group">
								<input type="number"
									   id="editarImpuestoOtServicioTecnico"
									   name="editarImpuestoOtServicioTecnico"
									   class="editarInput form-control"
									   placeholder="12%"
									   min="0"
									   max="100">
								<span class="input-group-append">
									<span class="input-group-text">%</span>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6 ml-md-auto">
							<label for="editarSubtotalOtServicioTecnico">Subtotal:</label>
							<input type="text"
								   class="editarInput form-control"
								   name="editarSubtotalOtServicioTecnico"
								   id="editarSubtotalOtServicioTecnico"
								   readonly
								   required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6 ml-md-auto">
							<label for="editarTotalOtServicioTecnico">Total:</label>
							<input type="text"
								   class="editarInput form-control"
								   name="editarTotalOtServicioTecnico"
								   id="editarTotalOtServicioTecnico"
								   readonly
								   required>
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button"
							class="btn bg-danger-800"
							data-dismiss="modal">Cerrar
					</button>
					<button type="button"
							class="btn bg-primary-800"
							id="actualizarOtServicioTecnico">Editar
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /vertical form modal -->
