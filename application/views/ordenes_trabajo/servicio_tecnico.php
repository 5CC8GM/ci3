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
							<div class="col-sm-6">
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
							<div class="col-sm-3">
								<label for="serieDocumento">Serie del Documento</label>
								<input type="text"
									   name="serieDocumento"
									   id="serieDocumento"
									   class="form-control"
									   readonly>
							</div>
							<div class="col-sm-3">
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
		<div class="col-xl-7 col-lg-12">
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
								<th>Numero de Documento</th>
								<th>Descripcion</th>
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
<div id="modalVerOtServicioTecnico"
	 class="modal fade"
	 tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Informacion de la Orden</h5>
				<button type="button"
						class="close"
						data-dismiss="modal">&times;
				</button>
			</div>
			
			
			<div class="modal-body">
				<div class="card">
					<div class="card-header bg-transparent border-bottom header-elements-inline">
						<h6 class="card-title">Static invoice</h6>
						<div class="header-elements">
							<button type="button"
									class="btn btn-light btn-sm"><i class="icon-file-check mr-2"></i> Save
							</button>
							<button type="button"
									class="btn btn-light btn-sm ml-3"><i class="icon-printer mr-2"></i> Print
							</button>
						</div>
					</div>
					
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="mb-4">
									<img src="<?= base_url() ?>components/global_assets/images/logo_light.png"
										 class="mb-3 mt-2"
										 alt=""
										 style="width: 120px;">
									<ul class="list list-unstyled mb-0">
										<li>2269 Elba Lane</li>
										<li>Paris, France</li>
										<li>888-555-2311</li>
									</ul>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="mb-4">
									<div class="text-sm-right">
										<h4 class="text-orange-300 mb-2 mt-md-2">Invoice #49029</h4>
										<ul class="list list-unstyled mb-0">
											<li>Date: <span class="font-weight-semibold">January 12, 2015</span></li>
											<li>Due date: <span class="font-weight-semibold">May 12, 2015</span></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						
						<div class="d-md-flex flex-md-wrap">
							<div class="mb-4 mb-md-2">
								<span class="text-muted">Invoice To:</span>
								<ul class="list list-unstyled mb-0">
									<li><h5 class="my-2">Rebecca Manes</h5></li>
									<li><span class="font-weight-semibold">Normand axis LTD</span></li>
									<li>3 Goodman Street</li>
									<li>London E1 8BF</li>
									<li>United Kingdom</li>
									<li>888-555-2311</li>
									<li><a href="#">rebecca@normandaxis.ltd</a></li>
								</ul>
							</div>
							
							<div class="mb-2 ml-auto">
								<span class="text-muted">Payment Details:</span>
								<div class="d-flex flex-wrap wmin-md-400">
									<ul class="list list-unstyled mb-0">
										<li><h5 class="my-2">Total Due:</h5></li>
										<li>Bank name:</li>
										<li>Country:</li>
										<li>City:</li>
										<li>Address:</li>
										<li>IBAN:</li>
										<li>SWIFT code:</li>
									</ul>
									
									<ul class="list list-unstyled text-right mb-0 ml-auto">
										<li><h5 class="font-weight-semibold my-2">$8,750</h5></li>
										<li><span class="font-weight-semibold">Profit Bank Europe</span></li>
										<li>United Kingdom</li>
										<li>London E1 8BF</li>
										<li>3 Goodman Street</li>
										<li><span class="font-weight-semibold">KFH37784028476740</span></li>
										<li><span class="font-weight-semibold">BPT4E</span></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					
					<div class="table-responsive">
						<table class="table table-lg">
							<thead>
								<tr>
									<th>Description</th>
									<th>Rate</th>
									<th>Hours</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<h6 class="mb-0">Create UI design model</h6>
										<span class="text-muted">One morning, when Gregor Samsa woke from troubled.</span>
									</td>
									<td>$70</td>
									<td>57</td>
									<td><span class="font-weight-semibold">$3,990</span></td>
								</tr>
								<tr>
									<td>
										<h6 class="mb-0">Support tickets list doesn't support commas</h6>
										<span class="text-muted">I'd have gone up to the boss and told him just what i think.</span>
									</td>
									<td>$70</td>
									<td>12</td>
									<td><span class="font-weight-semibold">$840</span></td>
								</tr>
								<tr>
									<td>
										<h6 class="mb-0">Fix website issues on mobile</h6>
										<span class="text-muted">I am so happy, my dear friend, so absorbed in the exquisite.</span>
									</td>
									<td>$70</td>
									<td>31</td>
									<td><span class="font-weight-semibold">$2,170</span></td>
								</tr>
							</tbody>
						</table>
					</div>
					
					<div class="card-body">
						<div class="d-md-flex flex-md-wrap">
							<div class="pt-2 mb-3">
								<h6 class="mb-3">Authorized person</h6>
								<div class="mb-3">
									<img src="<?= base_url() ?>components/global_assets/images/signature_light.png"
										 width="150"
										 alt="">
								</div>
								
								<ul class="list-unstyled text-muted">
									<li>Eugene Kopyov</li>
									<li>2269 Elba Lane</li>
									<li>Paris, France</li>
									<li>888-555-2311</li>
								</ul>
							</div>
							
							<div class="pt-2 mb-3 wmin-md-400 ml-auto">
								<h6 class="mb-3">Total due</h6>
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<th>Subtotal:</th>
												<td class="text-right">$7,000</td>
											</tr>
											<tr>
												<th>Tax: <span class="font-weight-normal">(25%)</span></th>
												<td class="text-right">$1,750</td>
											</tr>
											<tr>
												<th>Total:</th>
												<td class="text-right text-orange-300"><h5 class="font-weight-semibold">
														$8,750</h5></td>
											</tr>
										</tbody>
									</table>
								</div>
								
								<div class="text-right mt-3">
									<button type="button"
											class="btn btn-primary btn-labeled btn-labeled-left">
										<b><i class="icon-paperplane"></i></b> Send invoice
									</button>
								</div>
							</div>
						</div>
					</div>
					
					<div class="card-footer border-light">
						<span class="text-muted">Thank you for using Limitless. This invoice can be paid via PayPal, Bank transfer, Skrill or Payoneer. Payment is due within 30 days from the date of delivery. Late payment is possible, but with with a fee of 10% per month. Company registered in England and Wales #6893003, registered office: 3 Goodman Street, London E1 8BF, United Kingdom. Phone number: 888-555-2311</span>
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
