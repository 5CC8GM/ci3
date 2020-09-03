<!-- Content area -->
<div class="content pt-0">
	<div class="row">
		<div class="col-xl-4">
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
							<div class="col-sm-6">
								<label for="tipoDocumento">Tipo de Documento</label>
								<select id="tipoDocumento"
										name="tipoDocumento"
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
								
								
									<option value="<?= $value['ID_Cliente'] ?>"><?= $value['Nombre_Cliente'] . ' ' . $value['Apellido_Cliente'] ?></option>'
								
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
		<div class="col-xl-8 col-lg-12">
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
			<div class="modal-body">
				<form action=""
					  method="post"
					  id="formularioEditarServicioTecnico">
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="editarTipoDocumento">Tipo de Documento</label>
							<select id="editarTipoDocumento"
									name="editarTipoDocumento"
									class="form-control"
									data-fouc
									required
									disabled="disabled">
								<?php foreach ($tipoDocumento as $documento): ?>
									
									<option value="<?= $documento->ID_Documento ?>"><?= $documento->Nombre_Documento
										?></option>
								<?php endforeach; ?>
							</select>
							<input type="hidden"
								   id="editarInfoOculta">
							<input type="hidden"
								   id="editarIdDocumento"
								   name="editarIdDocumento">
							<input type="hidden"
								   id="editarImpuestoDocumento"
								   name="editarImpuestoDocumento">
							<input type="hidden"
								   id="editarIdOtServicioTecnico"
								   name="editarIdOtServicioTecnico">
						</div>
						<div class="col-sm-3">
							<label for="editarSerieDocumento">Serie</label>
							<input type="text"
								   name="editarSerieDocumento"
								   id="editarSerieDocumento"
								   class="form-control"
								   disabled>
						</div>
						<div class="col-sm-3">
							<label for="editarNumeroDocumento">Número</label>
							<input type="text"
								   name="editarNumeroDocumento"
								   id="editarNumeroDocumento"
								   class="form-control"
								   disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="editarCliente">Cliente</label>
						<select id="editarCliente"
								name="editarCliente"
								class="form-control select-search"
								data-placeholder="Seleccione un cliente"
								data-fouc
								required>
							<?php foreach ($cliente as $value): ?>
								
								<option value="<?= $value['ID_Cliente'] ?>"><?= $value['Nombre_Cliente'] . ' ' . $value['Apellido_Cliente'] ?></option>'
							
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="editarMarca">Marca:</label>
							<input type="text"
								   class="form-control"
								   name="editarMarca"
								   id="editarMarca"
								   placeholder="Asus"
								   required>
						</div>
						<div class="col-md-6">
							<label for="editarModelo">Modelo:</label>
							<input type="text"
								   class="form-control"
								   name="editarModelo"
								   id="editarModelo"
								   placeholder="BHMX350"
								   required>
						</div>
					</div>
					<div class="form-group">
						<label for="editarDescripcion">Descripción:</label>
						<textarea rows="1"
								  cols="1"
								  class="form-control elastic"
								  placeholder="Descripción:"
								  id="editarDescripcion"
								  name="editarDescripcion"
								  required></textarea>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="editarPrecio">Precio:</label>
							<input type="text"
								   class="input form-control"
								   name="editarPrecio"
								   id="editarPrecio"
								   placeholder="30.50"
								   required>
						</div>
						<div class="col-md-6">
							<label for="editarIva">IVA:</label>
							<div class="input-group">
								<input type="text"
									   id="editarIva"
									   name="editarIva"
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
							<label for="editarSubtotal">Subtotal:</label>
							<input type="text"
								   class="input form-control"
								   name="editarSubtotal"
								   id="editarSubtotal"
								   readonly
								   required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6 ml-md-auto">
							<label for="editarTotal">Total:</label>
							<input type="text"
								   class="input form-control"
								   name="editarTotal"
								   id="editarTotal"
								   readonly
								   required>
						</div>
					</div>
					<div class="text-center">
						<button class="btn bg-primary-800"
								type="button"
								id="actualizarOtServicioTecnico">Actualizar Orden de Trabajo <i
									class="icon-paperplane
									ml-2"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /vertical form modal -->
<!-- MODAL VER ORDEN DE TRABAJO SERVICIO TECNICO -->
<div id="modalVerOtServicioTecnico"
	 class="modal fade"
	 tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
			
			</div>
			
			<div class="modal-footer">
				<button type="button"
						class="btn bg-danger-800"
						data-dismiss="modal">Cerrar
				</button>
				<button class="btn bg-primary-800 btn-print"
						type="button"
						id="crearOrdenTrabajoServicioTecnico">Imprimir <i
							class="icon-printer
									ml-2"></i></button>
			</div>
		</div>
	</div>
</div>
