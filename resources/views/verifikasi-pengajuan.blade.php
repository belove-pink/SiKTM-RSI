<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pengajuan KTM</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --heading-font: 'Bricolage Grotesque', 'Plus Jakarta Sans', Arial, sans-serif;
            --frame: 1200px; /* makin kecil = konten makin sempit */
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
        }

        /* Bricolage Grotesque hanya untuk judul halaman & logo */
        .brand-name,
        .page-title {
            font-family: var(--heading-font);
            font-optical-sizing: none;
            font-variation-settings: 'opsz' 96; /* bentuk huruf display, seperti di desain */
        }

        body {
            font-weight: 500;
            background: #dce8f8;
            color: #17345d;
        }

        /* ================= HEADER ================= */
        header {
            height: 66px;
            background: #17345d;
            color: #ffffff;
            padding: 0 max(3%, calc((100% - var(--frame)) / 2 + 37px));
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-img {
            width: 33px;
            height: 33px;
            object-fit: contain;
            display: block;
        }

        .brand-name {
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #ffffff;
        }

        .brand-name .accent {
            color: #f5ad00;
        }

        .brand-univ {
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.2px;
            margin-left: 2px;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 45px;
            height: 66px;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            height: 100%;
            display: flex;
            align-items: center;
            border-bottom: 3px solid transparent;
            padding-top: 3px;
        }

        nav a.active {
            border-bottom-color: #f5ad00;
        }

        /* ================= MAIN ================= */
        main {
            width: 100%;
            padding: 0 max(5.7%, calc((100% - var(--frame)) / 2 + 72px));
            margin: 60px auto 68px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -1px;
            color: #17345d;
            margin-bottom: 33px;
        }

        .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 38px;
            align-items: stretch;
        }

        .left-column {
            display: flex;
            flex-direction: column;
            gap: 27px;
            min-width: 0;
        }

        .card {
            background: #ffffff;
            border-radius: 21px;
            padding: 24px 22px;
        }

        /* ---- Data mahasiswa ---- */
        .data-label {
            font-size: 13px;
            color: #5f7188;
            margin-bottom: 20px;
        }

        .student-name {
            font-size: 14px;
            font-weight: 700;
            color: #17345d;
            margin-bottom: 10px;
        }

        .student-info {
            font-size: 13px;
            color: #2f4466;
            margin-bottom: 14px;
        }

        .document-title {
            font-size: 13px;
            color: #5f7188;
            margin-bottom: 9px;
        }

        .document-row {
            background: #f3f6fb;
            padding: 12px 10px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 9px;
            font-size: 13px;
            color: #2f4466;
            margin-bottom: 15px;
        }

        .document-row:last-child {
            margin-bottom: 0;
        }

        .document-row span {
            overflow-wrap: anywhere;
        }

        .document-row a {
            color: #17345d;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        /* ---- Validasi otomatis ---- */
        .validation {
            padding: 30px 30px;
            border-radius: 21px;
            flex: 1;
        }

        .validation.pass {
            background: #d5f1e5;
        }

        .validation.fail {
            background: #fce2df;
        }

        .validation h4 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .validation p {
            font-size: 13px;
            line-height: 1.55;
        }

        .validation.pass h4 { color: #16805a; }
        .validation.pass p  { color: #258466; }
        .validation.fail h4 { color: #b42318; }
        .validation.fail p  { color: #912018; }

        /* ---- Keputusan ---- */
        .decision-card {
            padding: 28px 22px 26px;
            min-width: 0;
        }

        .decision-card h3 {
            font-size: 16px;
            font-weight: 700;
            color: #17345d;
            margin-bottom: 22px;
        }

        .decision-option {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 0 0 22px 16px;
            font-size: 14px;
            font-weight: 500;
            color: #2f4466;
            cursor: pointer;
        }

        /* radio custom: lingkaran tipis, terpilih = titik navy */
        .decision-option input {
            -webkit-appearance: none;
            appearance: none;
            width: 14px;
            height: 14px;
            margin: 0;
            border: 2px solid #e3e8f0;
            border-radius: 50%;
            background: transparent;
            cursor: pointer;
            flex-shrink: 0;
        }

        .decision-option input:checked {
            border-color: transparent;
            background: radial-gradient(circle, #17345d 0 4px, transparent 5px);
        }

        .note-label {
            display: block;
            font-size: 13px;
            color: #5f7188;
            margin: 26px 0 10px 6px;
        }

        textarea {
            width: 100%;
            height: 78px;
            border: 1px solid #17345d;
            border-radius: 8px;
            padding: 10px;
            resize: vertical;
            font-size: 12px;
            outline: none;
        }

        textarea:focus {
            box-shadow: 0 0 0 2px rgba(23, 52, 93, 0.15);
        }

        button {
            width: 100%;
            background: #f5ad00;
            color: #17345d;
            border: none;
            border-radius: 8px;
            padding: 10px;
            margin-top: 18px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        button:hover {
            background: #e69f00;
        }

        .admin-note {
            color: #5f7188;
            font-size: 12px;
            margin-top: 14px;
            margin-left: 6px;
        }

        /* ---- Notifikasi ---- */
        .message {
            padding: 11px 14px;
            border-radius: 8px;
            font-size: 11px;
            margin-bottom: 16px;
        }

        .message.success {
            background: #d5f1e5;
            color: #16805a;
        }

        .message.error {
            background: #fce2df;
            color: #b42318;
        }

        /* ================= FOOTER ================= */
        footer {
            background: #17345d;
            color: #ffffff;
            padding: 60px max(7%, calc((100% - var(--frame)) / 2 + 87px)) 68px;
        }

        .footer-content {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 180px 120px;
            gap: 30px;
            align-items: start;
        }

        .footer-brand h2 {
            font-size: 21px;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .footer-brand p {
            color: #dbe5f3;
            font-size: 10px;
            line-height: 1.7;
            max-width: 315px;
        }

        .footer-links h4 {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
        }

        .footer-links a {
            display: block;
            color: #dbe5f3;
            font-size: 10px;
            margin-bottom: 9px;
            text-decoration: underline;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 900px) {
            header {
                height: auto;
                padding: 16px 5%;
                flex-direction: column;
                gap: 12px;
            }

            nav {
                height: 40px;
                gap: 24px;
                flex-wrap: wrap;
                justify-content: center;
            }

            nav a {
                font-size: 15px;
            }

            main {
                padding: 0 5%;
                margin: 36px auto 50px;
            }

            .page-title {
                font-size: 30px;
                margin-bottom: 28px;
            }

            .content {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .card,
            .validation {
                border-radius: 20px;
            }

            .footer-content {
                grid-template-columns: 1fr 1fr;
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
        <img
            src="{{ asset('images/logo-ub.png') }}"
            alt="Logo Universitas Brawijaya"
            class="logo-img"
        >

        <span class="brand-name">Si<span class="accent">KTM</span></span>
        <span class="brand-univ">UNIVERSITAS BRAWIJAYA</span>
    </div>

    <nav>
        <a href="#" class="active">Beranda</a>
        <a href="#">Riwayat</a>
        <a href="#">Bantuan</a>
        <a href="#">{{ auth()->user()->name ?? '[NAMA MAHASISWA]' }}</a>
    </nav>
</header>

<main>
    <h1 class="page-title">Verifikasi Pengajuan</h1>

    @if(session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="message error">{{ $errors->first() }}</div>
    @endif

    <div class="content">

        <!-- KOLOM KIRI -->
        <div class="left-column">

            <section class="card">
                <p class="data-label">Data Mahasiswa</p>

                <p class="student-name">
                    {{ $pengajuan->mahasiswa->nama ?? '[NAMA MAHASISWA]' }}
                </p>

                <p class="student-info">
                    NIM {{ $pengajuan->nim ?? '[NIM]' }}
                    &middot; {{ $pengajuan->mahasiswa->program_studi ?? '[Program Studi]' }},
                    {{ $pengajuan->mahasiswa->fakultas ?? '[FAKULTAS]' }}
                </p>

                <p class="document-title">Dokumen</p>

                <div class="document-row">
                    <span>Pas foto.jpg</span>
                    <a href="{{ !empty($pengajuan->pas_foto) ? asset('storage/' . $pengajuan->pas_foto) : '#' }}"
                       target="_blank">Lihat</a>
                </div>

                <div class="document-row">
                    <span>Dokumen pendukung.jpg</span>
                    <a href="{{ !empty($pengajuan->dokumen_pendukung) ? asset('storage/' . $pengajuan->dokumen_pendukung) : '#' }}"
                       target="_blank">Lihat</a>
                </div>
            </section>

            <section class="validation {{ $validasiLolos ? 'pass' : 'fail' }}">
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
                    <input type="radio" name="keputusan" value="Diterima"
                           {{ old('keputusan', 'Diterima') === 'Diterima' ? 'checked' : '' }} required>
                    Disetujui
                </label>

                <label class="decision-option">
                    <input type="radio" name="keputusan" value="Diverifikasi"
                           {{ old('keputusan') === 'Diverifikasi' ? 'checked' : '' }}>
                    Data tidak lengkap
                </label>

                <label class="decision-option">
                    <input type="radio" name="keputusan" value="Ditolak"
                           {{ old('keputusan') === 'Ditolak' ? 'checked' : '' }}>
                    Ditolak
                </label>

                <label class="note-label" for="catatan">Catatan untuk mahasiswa</label>

                <textarea id="catatan" name="catatan">{{ old('catatan') }}</textarea>

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