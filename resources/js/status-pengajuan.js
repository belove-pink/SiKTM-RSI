// Halaman Status Pengajuan KTM (TrackStatusForm)
document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('form-nim');
    var input = document.getElementById('nim');
    var tombol = document.getElementById('tombol-cek');
    var pesan = document.getElementById('pesan-nim');

    if (!form || !input || !tombol || !pesan) {
        return;
    }

    // Validasi di sisi browser: NIM tidak boleh kosong
    form.addEventListener('submit', function (e) {
        input.value = input.value.trim();

        if (input.value === '') {
            e.preventDefault();
            pesan.textContent = 'Masukkan NIM';
            input.classList.add('invalid');
            input.focus();
            return;
        }

        // Cegah klik ganda selama permintaan diproses
        tombol.disabled = true;
        tombol.textContent = 'Memuat...';
    });

    // Hapus pesan kesalahan begitu pengguna mulai mengetik lagi
    input.addEventListener('input', function () {
        pesan.textContent = '';
        input.classList.remove('invalid');
    });

    // Kembalikan tombol jika halaman dibuka lagi lewat tombol Back
    window.addEventListener('pageshow', function () {
        tombol.disabled = false;
        tombol.textContent = 'Cek';
    });
});