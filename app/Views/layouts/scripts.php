<!-- jQuery -->
<script src="<?= base_url('adminlte/plugins/jquery/jquery.min.js') ?>"></script>

<!-- Bootstrap -->
<script src="<?= base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- AdminLTE -->
<script src="<?= base_url('adminlte/dist/js/adminlte.min.js') ?>"></script>

<!-- DataTables -->
<script src="<?= base_url('adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(function() {
        $('#datatablesSimple').DataTable();
    });
</script>

<?= $this->renderSection('scripts') ?>