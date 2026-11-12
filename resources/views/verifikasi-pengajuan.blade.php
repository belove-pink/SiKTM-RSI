
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pengajuan KTM</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #dce8f8;
            color: #17365f;
        }

        /* HEADER */
        header {
            min-height: 55px;
            background: #17345d;
            color: white;
            padding: 0 4%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo {
            width: 27px;
            height: 27px;
            border: 2px solid #d6a52b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d6a52b;
            font-size: 12px;
            font-weight: bold;
        }

        .brand h2 {
            font-size: 17px;
            font-weight: 700;
        }

        .brand span {
            font-size: 13px;
            font-weight: normal;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 32px;
            height: 55px;
        }

        nav a {
            color: #e3eaf4;
            text-decoration: none;
            font-size: 14px;
            height: 100%;
            display: flex;
            align-items: center;
        }

        nav a.active {
            border-bottom: 3px solid #f5ad00;
        }

        /* MAIN */
        main {
            width: 100%;
            max-width: none;
            padding: 0 4%;
            margin: 45px auto 45px;
        }

        .page-title {
            font-size: 34px;
            font-weight: 800;
            color: #17345d;
            margin-bottom: 30px;
        }

        .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: start;
        }

        .left-column {
            display: flex;
            flex-direction: column;
            gap: 22px;
            min-width: 0;
        }

        .card {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
        }

        .card h3 {
            font-size: 21px;
            color: #17345d;
            margin-bottom: 25px;
        }

        /* DATA MAHASISWA */
        .data-label {
            font-size: 16px;
            color: #718096;
            margin-bottom: 14px;
        }

        .student-name {
            font-size: 18px;
            font-weight: bold;
            color: #17345d;
            margin-bottom: 12px;
        }

        .student-info {
            font-size: 16px;
            color: #344b6b;
            margin-bottom: 22px;
        }

        .document-title {
            font-size: 16px;
            color: #718096;
            margin-bottom: 12px;
        }

        .document-row {
            background: #f3f6fb;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15px;
            margin-bottom: 10px;
            color: #344b6b;
            gap: 12px;
        }

        .document-row span {
            overflow-wrap: anywhere;
        }

        .document-row strong {
            color: #17345d;
            white-space: nowrap;
        }

        /* VALIDASI */
        .validation {
            padding: 26px 25px;
            border-radius: 16px;
            background: {{ $validasiLolos ? '#d5f1e5' : '#fce2df' }};
        }

        .validation h4 {
            font-size: 17px;
            margin-bottom: 12px;
            color: {{ $validasiLolos ? '#16805a' : '#b42318' }};
        }

        .validation p {
            font-size: 15px;
            line-height: 1.6;
            color: {{ $validasiLolos ? '#258466' : '#912018' }};
        }

        /* KEPUTUSAN */
        .decision-card {
            padding: 30px;
            min-width: 0;
        }

        .decision-card h3 {
            margin-bottom: 25px;
        }

        .decision-option {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 0 0 22px 10px;
            font-size: 16px;
            color: #344b6b;
            cursor: pointer;
        }

        .decision-option input {
            accent-color: #17345d;
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .note-label {
            display: block;
            font-size: 16px;
            color: #718096;
            margin: 28px 0 12px;
        }

        textarea {
            width: 100%;
            min-height: 100px;
            border: 1px solid #8195b1;
            border-radius: 8px;
            padding: 14px;
            resize: vertical;
            font-size: 15px;
            outline: none;
        }

        textarea:focus {
            border-color: #17345d;
        }

        button {
            width: 100%;
            background: #f5aa00;
            color: #17345d;
            border: none;
            border-radius: 8px;
            padding: 16px;
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #e99e00;
        }

        .admin-note {
            color: #718096;
            font-size: 13px;
            margin-top: 13px;
        }

        /* NOTIFIKASI */
        .message {
            padding: 15px;
            border-radius: 8px;
            font-size: 15px;
            margin-bottom: 18px;
        }

        .success {
            background: #d5f1e5;
            color: #16805a;
        }

        .error {
            background: #fce2df;
            color: #b42318;
        }

        /* FOOTER */
        footer {
            background: #17345d;
            color: white;
            min-height: 210px;
            padding: 45px 7%;
        }

        .footer-content {
            width: 100%;
            margin: auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 40px;
        }

        .footer-brand h2 {
            font-size: 20px;
            line-height: 1.5;
            margin-bottom: 14px;
        }

        .footer-brand p {
            color: #c5d2e4;
            font-size: 12px;
            line-height: 1.7;
            max-width: 350px;
        }

        .footer-links h4 {
            font-size: 13px;
            margin-bottom: 14px;
        }

        .footer-links a {
            display: block;
            color: #c5d2e4;
            font-size: 12px;
            margin-bottom: 9px;
            text-decoration: none;
        }

        /* RESPONSIVE */
        @media (max-width: 700px) {
            header {
                height: auto;
                padding: 15px 5%;
                flex-direction: column;
                gap: 12px;
            }

            nav {
                gap: 18px;
                height: 35px;
                flex-wrap: wrap;
            }

            main {
                padding: 0 5%;
                margin: 30px auto;
            }

            .content {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 27px;
            }

            .card {
                padding: 22px;
            }

            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 25px;
            }

            .footer-brand {
                grid-column: 1 / -1;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="brand">
        <div class="logo">UB</div>
        <h2>SiKTM <span>UNIVERSITAS BRAWIJAYA</span></h2>
    </div>

    <nav>
        <a href="#" class="active">Beranda</a>
        <a href="#">Riwayat</a>
        <a href="#">Bantuan</a>
        <a href="#">[NAMA MAHASISWA]</a>
    </nav>
</header>

<main>
    <h1 class="page-title">Verifikasi Pengajuan</h1>

    @if(session('success'))
        <div class="message success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="message error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="message error">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="content">

        <!-- KOLOM KIRI -->
        <div class="left-column">

            <section class="card">
                <p class="data-label">Data Mahasiswa</p>

                <p class="student-name">
                    {{ $pengajuan->mahasiswa->nama ?? 'Nama mahasiswa belum tersedia' }}
                </p>

                <p class="student-info">
                    NIM {{ $pengajuan->nim }}
                </p>

                <p class="document-title">Dokumen</p>

                <div class="document-row">
                    <span>{{ $pengajuan->dokumen }}</span>
                    <strong>Lihat</strong>
                </div>
            </section>

            <section class="validation">
                <h4>Hasil validasi otomatis</h4>

                <p>
                    {{ $validasiLolos
                        ? 'Tidak ditemukan pengajuan aktif melalui Bank untuk NIM ini. Pengajuan boleh diproses.'
                        : 'Ditemukan pengajuan aktif melalui Bank untuk NIM ini. Pengajuan perlu diperiksa kembali.' }}
                </p>
            </section>

        </div>

        <!-- KOLOM KANAN -->
        <section class="card decision-card">
            <h3>Keputusan</h3>

            <form action="{{ route('pengajuan-ktm.keputusan', $pengajuan->idPengajuan) }}"
                  method="POST">
                @csrf

                <label class="decision-option">
                    <input type="radio" name="keputusan"
                           value="Diterima" required>
                    Disetujui
                </label>

                <label class="decision-option">
                    <input type="radio" name="keputusan"
                           value="Diverifikasi">
                    Data tidak lengkap
                </label>

                <label class="decision-option">
                    <input type="radio" name="keputusan"
                           value="Ditolak">
                    Ditolak
                </label>

                <label class="note-label" for="catatan">
                    Catatan untuk mahasiswa
                </label>

                <textarea id="catatan" name="catatan"
                    placeholder="Tuliskan catatan jika diperlukan..."></textarea>

                <button type="submit">Simpan Keputusan</button>
            </form>

            <p class="admin-note">
                Keputusan dicatat bersama nama admin yang memproses.
            </p>
        </section>

    </div>
</main>

<footer>
    <div class="footer-content">

        <div class="footer-brand">
            <h2>KEMAHASISWAAN<br>UNIVERSITAS BRAWIJAYA</h2>

            <p>
                SiKTM adalah sistem informasi pengajuan dan pemantauan
                Kartu Tanda Mahasiswa Universitas Brawijaya. Layanan ini
                dikelola oleh Kemahasiswaan untuk memudahkan mahasiswa
                mengurus KTM secara cepat, jelas, dan transparan.
            </p>
        </div>

        <div class="footer-links">
            <h4>NAVIGASI</h4>
            <a href="#">Beranda</a>
            <a href="#">Riwayat</a>
            <a href="#">Bantuan</a>
            <a href="#">Kontak Kemahasiswaan</a>
        </div>

        <div class="footer-links">
            <h4>LEGAL</h4>
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Ketentuan Layanan</a>
        </div>

    </div>
</footer>

</body>
</html>
