<!-- Content area -->
<div class="content pt-0">
	<div class="row">
		<div class="col-xl-3">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Crear Nuevo Cliente</h5>
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
						  id="formularioClientes">
						<div class="form-group">
							<label for="nombreCliente">Nombre:</label>
							<input type="text"
								   class="form-control"
								   name="nombreCliente"
								   id="nombreCliente"
								   placeholder="Nombre del Cliente:">
						</div>
						<div class="form-group">
							<label for="apellidoCliente">Apellido:</label>
							<input type="text"
								   class="form-control"
								   name="apellidoCliente"
								   id="apellidoCliente"
								   placeholder="Apellido del Cliente:">
						</div>
						<div class="form-group">
							<label for="telefonoCliente">Teléfono:</label>
							<input type="tel"
								   class="form-control"
								   name="telefonoCliente"
								   id="telefonoCliente"
								   placeholder="Teléfono del Cliente:">
						</div>
						<div class="text-center">
							<button class="btn bg-primary-800"
									type="button"
									id="crearCliente">Crear Cliente <i class="icon-paperplane
									ml-2"></i></button>
						</div>
					</form>
				
				</div>
			</div>
		</div>
		<div class="col-xl-9">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Clientes</h5>
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
						   id="tablaClientes">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Teléfono</th>
								<th>Acciones</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /content area -->
<div id="modalEditarCliente"
	 class="modal fade"
	 tabindex="-1">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Editar Cliente</h5>
				<button type="button"
						class="close"
						data-dismiss="modal">&times;
				</button>
			</div>
			
			<form action=""
				  method="post"
				  id="formularioEditarCliente">
				<input type="hidden"
					   name="editarIdCliente"
					   id="editarIdCliente"
					   value="">
				<div class="modal-body">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text"
							   class="form-control"
							   name="editarNombreCliente"
							   id="editarNombreCliente">
					</div>
					<div class="form-group">
						<label>Apellido</label>
						<input type="text"
							   class="form-control"
							   name="editarApellidoCliente"
							   id="editarApellidoCliente">
					</div>
					<div class="form-group">
						<label>Teléfono</label>
						<input type="tel"
							   class="form-control"
							   name="editarTelefonoCliente"
							   id="editarTelefonoCliente">
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button"
							class="btn bg-danger-800"
							data-dismiss="modal">Cerrar
					</button>
					<button type="button"
							class="btn bg-primary-800"
							id="actualizar">Editar
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /vertical form modal -->
