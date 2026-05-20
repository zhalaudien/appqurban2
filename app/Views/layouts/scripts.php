<!-- jQuery -->
<script src="<?php echo base_url('') ?>adminlte/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="<?php echo base_url('') ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE -->
<script src="<?php echo base_url('') ?>adminlte/css/js/adminlte.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url('') ?>adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('') ?>adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(function() {
        $('#datatablesSimple').DataTable();
    });
</script>

<script>
    function formatRupiah(el, id = '') {
        let angka = el.value.replace(/[^,\d]/g, '');
        let split = angka.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        el.value = rupiah ? 'Rp ' + rupiah : '';

        let cleanVal = angka.replace(/\D/g, '');

        if (el.id.includes('pembayaran')) {
            const hidden = document.getElementById('pembayaran_clean' + (id ? `_${id}` : ''));
            if (hidden) hidden.value = cleanVal;
        } else if (el.id.includes('shadaqoh')) {
            const hidden = document.getElementById('shadaqoh_clean' + (id ? `_${id}` : ''));
            if (hidden) hidden.value = cleanVal;
        }
    }

    function bersihkanRupiah(str) {
        return str.replace(/\D/g, '');
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll("form").forEach(form => {
            const isEdit = form.action.includes('/penerimaan/edit');
            const idInput = form.querySelector("input[name='id']");
            const id = isEdit && idInput ? idInput.value : '';

            const pembayaranDisplay = form.querySelector(`input[name='pembayaran_display']`);
            const pembayaranHidden = form.querySelector(`input[name='pembayaran']`);
            const pembayaranHiddenId = form.querySelector(`#pembayaran_clean${id ? '_' + id : ''}`);

            const shadaqohDisplay = form.querySelector(`input[name='shadaqoh_display']`);
            const shadaqohHidden = form.querySelector(`input[name='shadaqoh']`);
            const shadaqohHiddenId = form.querySelector(`#shadaqoh_clean${id ? '_' + id : ''}`);

            // Saat halaman selesai dimuat, isi hidden input jika display sudah punya nilai
            if (pembayaranDisplay && pembayaranHiddenId) {
                pembayaranHiddenId.value = bersihkanRupiah(pembayaranDisplay.value);
            }
            if (shadaqohDisplay && shadaqohHiddenId) {
                shadaqohHiddenId.value = bersihkanRupiah(shadaqohDisplay.value);
            }

            // Saat submit form
            form.addEventListener("submit", function() {
                if (pembayaranDisplay && pembayaranHiddenId) {
                    pembayaranHiddenId.value = bersihkanRupiah(pembayaranDisplay.value);
                }
                if (shadaqohDisplay && shadaqohHiddenId) {
                    shadaqohHiddenId.value = bersihkanRupiah(shadaqohDisplay.value);
                }
            });
        });
    });
</script>


<?= $this->renderSection('scripts') ?>