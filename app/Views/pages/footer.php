<!--begin::Footer-->
<footer class="app-footer">
    <!--begin::To the end-->
    <div class="float-end d-none d-sm-inline"></div>
    <!--end::To the end-->
    <!--begin::Copyright-->
    <strong>
        Copyright &copy; 2025&nbsp;
        <a href="https://panitiapusat7.my.id" class="text-decoration-none">Panitia Pusat 7 by Pemuda MTA Sragen</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer>
<!--end::Footer-->
</div>
<!--end::App Wrapper-->
<!--begin::Script-->
<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
<!--end::Third Party Plugin(OverlayScrollbars)-->
<!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<!--end::Required Plugin(popperjs for Bootstrap 5)-->
<!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>
<!--end::Required Plugin(Bootstrap 5)-->
<!--begin::Required Plugin(AdminLTE)-->
<script src="<?php echo base_url('') ?>dashboard/js/adminlte.js"></script>
<!--end::Required Plugin(AdminLTE)-->
<!--begin::OverlayScrollbars Configure-->
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="<?php echo base_url('') ?>dashboard/js/datatables-simple-demo.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script>
<!--end::OverlayScrollbars Configure-->
<!-- OPTIONAL SCRIPTS -->
<!-- sortablejs -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
    integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script>
<!-- sortablejs -->
<script>
    const connectedSortables = document.querySelectorAll('.connectedSortable');
    connectedSortables.forEach((connectedSortable) => {
        let sortable = new Sortable(connectedSortable, {
            group: 'shared',
            handle: '.card-header',
        });
    });

    const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
    cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
    });
</script>
<!-- apexcharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
<!-- ChartJS -->
<!-- jsvectormap -->
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
    integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
    integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>
<!-- jsvectormap -->
<!--end::Script-->

<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            language: {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                },
                "zeroRecords": "Data tidak ditemukan",
                "infoEmpty": "Tidak ada entri yang ditampilkan",
                "infoFiltered": "(difilter dari _MAX_ total entri)"
            }
        });
    });
</script>

</body>
<!--end::Body-->

</html>