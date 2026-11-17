// Halaman Daftar Pengajuan KTM
document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('.search-bar');
    var status = form ? form.querySelector('select[name="status"]') : null;

    if (!status) {
        return;
    }

    // Filter status langsung diterapkan saat dipilih
    status.addEventListener('change', function () {
        form.submit();
    });
});