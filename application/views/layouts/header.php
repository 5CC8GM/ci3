<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible"
			  content="IE=edge">
		<meta name="viewport"
			  content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php if (current_url() == base_url() . 'dashboard') : ?>
			<title>Inicio | Signs & Letters</title>
		
		<?php elseif (current_url() == base_url() . 'clientes'): ?>
			<title>Clientes | Signs & Letters</title>
		
		<?php elseif (current_url() == base_url() . 'servicio_tecnico'): ?>
			<title>Orden de Trabajo Servicio Técnico | Signs & Letters</title>
		
		<?php elseif (current_url() == base_url() . 'ploteo'): ?>
			<title>Orden de Trabajo Ploteo | Signs & Letters</title>
		
		<?php elseif (current_url() == base_url() . 'reportes'): ?>
			<title>Reportes | Signs & Letters</title>
		<?php endif; ?>
		<!-- Global stylesheets -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900"
			  rel="stylesheet"
			  type="text/css">
		<link href="<?= base_url() ?>components/global_assets/css/icons/icomoon/styles.min.css"
			  rel="stylesheet"
			  type="text/css">
		<link href="<?= base_url() ?>components/global_assets/css/extras/toastr.min.css"
			  rel="stylesheet"
			  type="text/css">
		<link href="<?= base_url() ?>components/assets/css/bootstrap.min.css"
			  rel="stylesheet"
			  type="text/css">
		<link href="<?= base_url() ?>components/assets/css/bootstrap_limitless.min.css"
			  rel="stylesheet"
			  type="text/css">
		<link href="<?= base_url() ?>components/assets/css/layout.min.css"
			  rel="stylesheet"
			  type="text/css">
		<link href="<?= base_url() ?>components/assets/css/components.min.css"
			  rel="stylesheet"
			  type="text/css">
		<link href="<?= base_url() ?>components/assets/css/colors.min.css"
			  rel="stylesheet"
			  type="text/css">
		<!-- /global stylesheets -->
	
	</head>
	
	<body class="navbar-top">
	
