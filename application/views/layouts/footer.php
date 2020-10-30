<!-- Footer -->
<div class="navbar navbar-expand-lg navbar-light">
	<div class="text-center d-lg-none w-100">
		<button type="button"
				class="navbar-toggler dropdown-toggle"
				data-toggle="collapse"
				data-target="#navbar-footer">
			Sistema Creado para Signs & Letters
		</button>
	</div>
	
	<div class="navbar-collapse collapse"
		 id="navbar-footer">
					<span class="navbar-text">
						&copy; 2020. <a>Signs & Letters Todos los Derechos Reservados</a>
					</span>
	</div>
</div>
<!-- /footer -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

<!-- Core JS files -->
<script src="<?= base_url() ?>components/global_assets/js/main/jquery.min.js"></script>
<script src="<?= base_url() ?>components/global_assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>components/global_assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<!-- NOTY -->
<script src="<?= base_url() ?>components/global_assets/js/plugins/notifications/noty.min.js"></script>
<!-- DATATABLES -->
<script src="<?= base_url() ?>components/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="<?= base_url() ?>components/global_assets/js/plugins/tables/datatables/extensions/responsive.min
.js"></script>
<script src="<?= base_url() ?>components/global_assets/js/plugins/tables/datatables/extensions/buttons.min
.js"></script>
<script src="<?= base_url() ?>components/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>components/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
<script src="<?= base_url() ?>components/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
<!-- MULTISELECT -->
<script src="<?= base_url() ?>components/global_assets/js/plugins/forms/selects/select2.min.js"></script>
<!-- SWEETALERT -->
<script src="<?= base_url() ?>components/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
<!-- AUTOSIZE -->
<script src="<?= base_url() ?>components/global_assets/js/plugins/forms/inputs/autosize.min.js"></script>
<!-- ECHARTS -->
<script src="<?= base_url() ?>components/global_assets/js/plugins/visualization/echarts/echarts.min.js"></script>
<!-- PRINT -->
<script src="<?= base_url() ?>components/global_assets/js/plugins/print/jQuery.print.js"></script>
<!-- DATEPICKER -->
<script src="<?= base_url() ?>components/global_assets/js/plugins/pickers/pickadate/picker.js"></script>
<script src="<?= base_url() ?>components/global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
<script src="<?= base_url() ?>components/global_assets/js/plugins/pickers/pickadate/translations/es_ES.js"></script>
<!-- Theme JS files -->
<script src="<?= base_url() ?>components/assets/js/app.js"></script>
<!-- /theme JS files -->
<script src="<?= base_url() ?>components/scripts/clientes.js"></script>
<script src="<?= base_url() ?>components/scripts/servicio_tecnico.js"></script>
<script src="<?= base_url() ?>components/scripts/ploteo.js"></script>
<script src="<?= base_url() ?>components/scripts/reportes.js"></script>
<?php if (current_url() == base_url('dashboard')): ?>
	
	<script src="<?= base_url() ?>components/scripts/graficas.js"></script>

<?php endif; ?>
</body>
</html>
