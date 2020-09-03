<div class="row">
	<div class="col-sm-6">
		<div class="mb-4">
			<img src="<?= base_url() ?>components/global_assets/images/logo_light.png"
				 class="mb-3 mt-2"
				 alt=""
				 style="width: 120px;">
			<ul class="list list-unstyled mb-0">
				<li>Julio César Paucar</li>
				<li>Jacinto Escobar Oe4-31 pasaje S21A y José Abarcas</li>
				<li>Quito - Ecuador</li>
				<li>0984035994</li>
			</ul>
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="mb-4">
			<div class="text-sm-right">
				<h4 class="text-orange-300 mb-2 mt-md-2"><?= $venta->Nombre_Documento ?> #<?=
						$venta->NumeroDocumento_OTServicioTecnico ?></h4>
				<ul class="list list-unstyled mb-0">
					<?php
						$fechaOriginal = $venta->Fecha_OTServicioTecnico;
						setlocale(LC_ALL, 'spanish');
						$fechaNueva = strftime("%d de %B de %Y %H:%M:%S", strtotime($fechaOriginal));
					?>
					<li>Fecha: <span class="font-weight-semibold"><?= $fechaNueva
							?></span></li>
					<!--							<li>Due date: <span class="font-weight-semibold">May 12, 2015</span></li>-->
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="d-md-flex flex-md-wrap">
	<div class="mb-4 mb-md-2">
		<span class="text-muted">Factura para:</span>
		<ul class="list list-unstyled mb-0">
			<li><h5 class="my-2"><?= $venta->Nombre_Cliente . ' ' . $venta->Apellido_Cliente ?></h5></li>
			<!--					<li><span class="font-weight-semibold">Normand axis LTD</span></li>-->
			<!--					<li>3 Goodman Street</li>-->
			<!--					<li>London E1 8BF</li>-->
			<!--					<li>United Kingdom</li>-->
			<li><?= $venta->Telefono_Cliente ?></li>
			<!--					<li><a href="#">rebecca@normandaxis.ltd</a></li>-->
		</ul>
	</div>
	
	<div class="mb-2 ml-auto">
		<span class="text-muted">Detalles:</span>
		<div class="d-flex flex-wrap wmin-md-400">
			<ul class="list list-unstyled mb-0">
				<li><h5 class="my-2">Total a Pagar:</h5></li>
				<!--						<li>Bank name:</li>-->
				<!--						<li>Country:</li>-->
				<!--						<li>City:</li>-->
				<!--						<li>Address:</li>-->
				<!--						<li>IBAN:</li>-->
				<!--						<li>SWIFT code:</li>-->
			</ul>
			
			<ul class="list list-unstyled text-right mb-0 ml-auto">
				<li><h5 class="font-weight-semibold my-2">$<?= $venta->Total_OTServicioTecnico ?></h5></li>
				<!--						<li><span class="font-weight-semibold">Profit Bank Europe</span></li>-->
				<!--						<li>United Kingdom</li>-->
				<!--						<li>London E1 8BF</li>-->
				<!--						<li>3 Goodman Street</li>-->
				<!--						<li><span class="font-weight-semibold">KFH37784028476740</span></li>-->
				<!--						<li><span class="font-weight-semibold">BPT4E</span></li>-->
			</ul>
		</div>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-lg">
		<thead>
			<tr>
				<th>Descripción</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<h6 class="mb-0"><?= $venta->Descripcion_OTServicioTecnico ?></h6>
					<!--						<span class="text-muted">One morning, when Gregor Samsa woke from troubled.</span>-->
				</td>
				<td><?= $venta->Marca_OTServicioTecnico ?></td>
				<td><?= $venta->Modelo_OTServicioTecnico ?></td>
				<td><span class="font-weight-semibold">$<?= $venta->Subtotal_OTServicioTecnico ?></span></td>
			</tr>
		</tbody>
	</table>
</div>

<div class="d-md-flex flex-md-wrap">
	<div class="pt-2 mb-3">
		<h6 class="mb-3">Firma Autorizada</h6>
		<div class="mb-3">
			<img src="<?= base_url() ?>components/global_assets/images/signature_light.png"
				 width="150"
				 alt="">
		</div>
		
		<ul class="list-unstyled text-muted">
			<li>Julio César Paucar</li>
			<li>Jacinto Escobar Oe4-31 pasaje S21A y José Abarcas</li>
			<li>Quito - Ecuador</li>
			<li>0984035994</li>
		</ul>
	</div>
	
	<div class="pt-2 mb-3 wmin-md-400 ml-auto">
		<h6 class="mb-3">Total a Pagar:</h6>
		<div class="table-responsive">
			<table class="table">
				<tbody>
					<tr>
						<th>Subtotal:</th>
						<td class="text-right">$<?= $venta->Subtotal_OTServicioTecnico ?></td>
					</tr>
					<tr>
						<th>Impuesto: <span class="font-weight-normal"><?= $venta->Impuesto_Documento . '%'
								?></span></th>
						<td class="text-right">$<?= $venta->Impuesto_OTServicioTecnico ?></td>
					</tr>
					<tr>
						<th>Total:</th>
						<td class="text-right text-orange-300"><h5 class="font-weight-semibold">
								$<?= $venta->Total_OTServicioTecnico ?></h5></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
