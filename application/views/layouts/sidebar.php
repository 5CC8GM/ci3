<!-- Page content -->
<div class="page-content">
	
	<!-- Main sidebar -->
	<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">
		
		<!-- Sidebar mobile toggler -->
		<div class="sidebar-mobile-toggler text-center">
			<a href="#"
			   class="sidebar-mobile-main-toggle">
				<i class="icon-arrow-left8"></i>
			</a>
			Menú
			<a href="#"
			   class="sidebar-mobile-expand">
				<i class="icon-screen-full"></i>
				<i class="icon-screen-normal"></i>
			</a>
		</div>
		<!-- /sidebar mobile toggler -->
		
		
		<!-- Sidebar content -->
		<div class="sidebar-content">
			
			<!-- User menu -->
			<div class="sidebar-user">
				<div class="card-body">
					<div class="media align-items-center">
						<div class="mr-3">
							<a href="#"><img src="<?= base_url() ?>components/global_assets/images/image.png"
											 width="38"
											 height="38"
											 class="rounded-circle"
											 alt=""></a>
						</div>
						
						<div class="media-body">
							<div class="media-title font-weight-semibold"><?= $this->session->userdata('nombre') . ' ' . $this->session->userdata('apellido')
								?></div>
						</div>
					</div>
				</div>
			</div>
			<!-- /user menu -->
			
			
			<!-- Main navigation -->
			<div class="card card-sidebar-mobile">
				<ul class="nav nav-sidebar"
					data-nav-type="accordion">
					
					<!-- Main -->
					<li class="nav-item-header">
						<div class="text-uppercase font-size-xs line-height-xs">Principal</div>
						<i class="icon-menu"
						   title="Main"></i>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>dashboard"
						   class="nav-link">
							<i class="icon-home4"></i>
							<span>Inicio</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>clientes"
						   class="nav-link">
							<i class="icon-users4"></i>
							<span>Clientes</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>servicio_tecnico"
						   class="nav-link align-items-center"><i class="icon-hammer-wrench"></i> <span>Órdenes de Trabajo
																					 Sercivio Técnico</span></a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() ?>ploteo"
						   class="nav-link align-items-center"><i class="icon-printer"></i> <span>Órdenes de Trabajo
																					 Ploteo</span></a>
					</li>
					<li class="nav-item">
						<a href=""
						   class="nav-link">
							<i class="icon-stats-growth"></i>
							<span>Reportes</span>
						</a>
					</li>
					<!-- /main -->
				
				</ul>
			</div>
			<!-- /main navigation -->
		
		</div>
		<!-- /sidebar content -->
	
	</div>
	<!-- /main sidebar -->
	
	
	<!-- Main content -->
	<div class="content-wrapper">
