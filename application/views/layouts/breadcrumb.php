<!-- Page header -->
<div class="page-header border-bottom-0">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title">
			<h5>
				
				<?php if (current_url() == base_url() . 'dashboard') : ?>
					<span class="font-weight-semibold">Inicio</span>
					
				<?php elseif (current_url() == base_url() . 'clientes') : ?>
					<span class="font-weight-semibold">Gestión de Clientes</span>
					
				<?php elseif (current_url() == base_url() . 'servicio_tecnico') : ?>
					<span class="font-weight-semibold">Órdenes de Trabajo - Servicio Técnico</span>
					
				<?php elseif (current_url() == base_url() . 'ploteo') : ?>
					<span class="font-weight-semibold">Órdenes de Trabajo - Ploteo</span>
					
				<?php elseif (current_url() == base_url() . 'reportes') : ?>
					<span class="font-weight-semibold">Reportes</span>
					
				<?php endif ?>
			</h5>
		</div>
		
		<div class="header-elements py-0">
			<div class="breadcrumb">
				
				<?php if (current_url() == base_url() . 'dashboard') : ?>
					<a href="<?= base_url() ?>dashboard"
					   class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Inicio</a>
				
				<?php elseif (current_url() == base_url() . 'clientes') : ?>
					<a href="<?= base_url() ?>dashboard"
					   class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Inicio</a>
					<span class="breadcrumb-item active">Clientes</span>
				
				<?php elseif (current_url() == base_url() . 'servicio_tecnico') : ?>
					<a href="<?= base_url() ?>dashboard"
					   class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Inicio</a>
					<span class="breadcrumb-item active">Órdenes de Trabajo</span>
					<span class="breadcrumb-item active">Servicio Tecnico</span>
				
				<?php elseif (current_url() == base_url() . 'ploteo') : ?>
					<a href="<?= base_url() ?>dashboard"
					   class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Inicio</a>
					<span class="breadcrumb-item active">Órdenes de Trabajo</span>
					<span class="breadcrumb-item active">Ploteo</span>
				
				<?php elseif (current_url() == base_url() . 'reportes') : ?>
					<a href="<?= base_url() ?>dashboard"
					   class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Inicio</a>
					<span class="breadcrumb-item active">Reportes</span>
				
				<?php endif ?>
			
			</div>
		</div>
	</div>
</div>
<!-- /page header -->

