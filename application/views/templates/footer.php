</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
	<!-- To the right -->
	<div class="float-right d-none d-sm-inline">
		Ver : 1.0.0
	</div>
	<!-- Default to the left -->
	<strong>Copyright &copy; <?= date('Y')?> <a href="<?=base_url()?>">Aplikasi POS</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?=base_url('assets/plugins/jquery/jquery.min.js');?>"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

<!-- DataTables -->
<script src="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?=base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
<script>
	$('#tabel1').DataTable();
</script>

<!-- AdminLTE App -->
<script src="<?=base_url('assets/js/adminlte.min.js');?>"></script>
<!-- Custom App -->
<script src="<?=base_url('assets/js/custom.js');?>"></script>
</body>
</html>
