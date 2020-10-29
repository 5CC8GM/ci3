<!-- Content area -->
<div class="content pt-0">
	
	<!-- Basic card -->
	<div class="row">
		<div class="col-sm-6 col-xl-3">
			<div class="card card-body">
				<div class="media">
					<div class="mr-3 align-self-center">
						<i class="icon-users4 icon-3x text-orange-300"></i>
					</div>
					
					<div class="media-body text-right">
						<h3 class="font-weight-semibold mb-0"><?= $cantidadClientes ?></h3>
						<span class="text-uppercase font-size-sm text-muted">Clientes</span>
					</div>
				</div>
			</div> 
		</div>
		
		<div class="col-sm-6 col-xl-3">
			<div class="card card-body">
				<div class="media">
					<div class="mr-3 align-self-center">
						<i class="icon-hammer-wrench icon-3x text-primary-300"></i>
					</div>
					
					<div class="media-body text-right">
						<h3 class="font-weight-semibold mb-0"><?= $cantidadVentasServicioTecnico ?></h3>
						<span class="text-uppercase font-size-sm text-muted">Órdenes de Trabajo Servicio Técnico</span>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6 col-xl-3">
			<div class="card card-body">
				<div class="media">
					<div class="mr-3 align-self-center">
						<i class="icon-printer icon-3x text-danger-300"></i>
					</div>
					
					<div class="media-body text-right">
						<h3 class="font-weight-semibold mb-0"><?= $cantidadVentasPloteo ?></h3>
						<span class="text-uppercase font-size-sm text-muted">Órdenes de Trabajo Ploteo</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-xl-3">
			<div class="card card-body">
				<div class="media">
					<div class="mr-3 align-self-center">
						<i class="icon-cash icon-3x text-success-300"></i>
					</div>
					
					<div class="media-body text-right">
						<h3 class="font-weight-semibold mb-0">$ <?= $ingresosTotales ?></h3>
						<span class="text-uppercase font-size-sm text-muted">Ingresos Totales</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /basic card -->
	<div class="row">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Gráfica De Ingresos Servicio Técnico</h5>
					<div class="header-elements">
						<div class="list-icons">
							<select name="year"
									id="year"
									class="form-control select">
								<?php foreach ($years as $year): ?>
									<option value="<?= $year->year ?>"><?= $year->year ?></option>
								<?php endforeach; ?>
							</select>
							<a class="list-icons-item"
							   data-action="collapse"></a>
							<a class="list-icons-item"
							   data-action="remove"></a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="chart-container">
						<div class="chart has-fixed-height"
							 id="graficaServicioTecnico"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Gráfica De Ingresos Ploteo</h5>
					<div class="header-elements">
						<div class="list-icons">
							<select name="yearPloteo"
									id="yearPloteo"
									class="form-control selectPloteo">
								<?php foreach ($yearsPloteo as $year): ?>
									<option value="<?= $year->yearPloteo ?>"><?= $year->yearPloteo ?></option>
								<?php endforeach; ?>
							</select>
							<a class="list-icons-item"
							   data-action="collapse"></a>
							<a class="list-icons-item"
							   data-action="remove"></a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="chart-container">
						<div class="chart has-fixed-height"
							 id="graficaPloteo"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /content area -->
