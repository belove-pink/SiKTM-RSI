<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pengajuan - SiKTM</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --heading-font: 'Bricolage Grotesque', 'Plus Jakarta Sans', Arial, sans-serif;
            --frame: 1200px; /* makin kecil = konten makin sempit */
            --navy: #13305a;
            --amber: #f2aa00;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
        }

        /* Bricolage Grotesque untuk judul halaman & logo */
        .brand-name,
        .page-title {
            font-family: var(--heading-font);
            font-optical-sizing: none;
            font-variation-settings: 'opsz' 96;
        }

        body {
            font-weight: 500;
            background: #dce8f8;
            color: var(--navy);
        }

        /* ================= NAVBAR (sama dengan beranda admin) ================= */
        .navbar {
            height: 66px;
            padding: 0 max(2.5%, calc((100% - var(--frame)) / 2 + 37px));
            background: var(--navy);
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #ffffff;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand img {
            width: 33px;
            height: 33px;
            object-fit: contain;
            display: block;
        }

        .brand-name {
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -0.4px;
        }

        .brand-name .accent {
            color: var(--amber);
        }

        .brand-univ {
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.2px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 40px;
            height: 66px;
        }

        .nav-menu a {
            height: 100%;
            display: flex;
            align-items: center;
            color: #ffffff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            border-bottom: 3px solid transparent;
            padding-top: 3px;
            transition: 0.2s;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            border-bottom-color: var(--amber);
        }

        .nav-nama {
            border-bottom: 3px solid transparent;
            height: 100%;
            display: flex;
            align-items: center;
            padding-top: 3px;
            font-size: 13px;
            font-weight: 500;
            color: #ffffff;
        }

        .nav-keluar {
            height: 100%;
            display: flex;
            align-items: stretch;
        }

        .nav-keluar button {
            width: auto;
            margin: 0;
            padding: 3px 0 0;
            border: 0;
            border-bottom: 3px solid transparent;
            border-radius: 0;
            background: none;
            color: #ffffff;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
        }

        .nav-keluar button:hover {
            background: none;
            border-bottom-color: var(--amber);
        }

        /* ================= MAIN ================= */
        main {
            width: 100%;
            padding: 0 max(5.7%, calc((100% - var(--frame)) / 2 + 72px));
            margin: 60px auto 68px;
        }

        .kembali {
            display: inline-block;
            margin-bottom: 14px;
            color: var(--navy);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .kembali:hover {
            text-decoration: underline;
        }

        .page-title {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -1px;
            color: var(--navy);
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
            color: var(--navy);
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
            color: var(--navy);
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .document-row a:hover {
            text-decoration: underline;
        }

        /* ---- Validasi otomatis ---- */
        .validation {
            padding: 30px 30px;
            border-radius: 21px;
            flex: 1;
        }

        .validation.pass { background: #d5f1e5; }
        .validation.fail { background: #fce2df; }

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
            color: var(--navy);
            margin-bottom: 18px;
        }

        /* Pilihan keputusan: seluruh baris bisa diklik */
        .decision-option {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 0 0 10px;
            padding: 12px 16px;
            border: 1px solid transparent;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: #2f4466;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s, color 0.15s;
        }

        .decision-option:hover {
            background: #f3f6fb;
        }

        .decision-option:has(input:checked) {
            background: #f3f6fb;
            border-color: var(--navy);
            color: var(--navy);
            font-weight: 700;
        }

        /* Radio custom: lingkaran 20px, terpilih = titik navy di tengah */
        .decision-option input {
            -webkit-appearance: none;
            appearance: none;
            display: grid;
            place-content: center;
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            margin: 0;
            border: 2px solid #9fb2d3;
            border-radius: 50%;
            background: #ffffff;
            cursor: pointer;
            transition: border-color 0.15s;
        }

        .decision-option input::before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--navy);
            transform: scale(0);
            transition: transform 0.15s ease-out;
        }

        .decision-option input:checked {
            border-color: var(--navy);
        }

        .decision-option input:checked::before {
            transform: scale(1);
        }

        .decision-option input:focus-visible {
            outline: 3px solid var(--amber);
            outline-offset: 2px;
        }

        .note-label {
            display: block;
            font-size: 13px;
            color: #5f7188;
            margin: 22px 0 10px 6px;
        }

        textarea {
            width: 100%;
            height: 78px;
            border: 1px solid var(--navy);
            border-radius: 8px;
            padding: 10px;
            resize: vertical;
            font-size: 12px;
            outline: none;
        }

        textarea:focus {
            box-shadow: 0 0 0 2px rgba(19, 48, 90, 0.15);
        }

        button {
            width: 100%;
            background: var(--amber);
            color: var(--navy);
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
            font-size: 12px;
            margin-bottom: 16px;
        }

        .message.success { background: #d5f1e5; color: #16805a; }
        .message.error   { background: #fce2df; color: #b42318; }

        /* ================= FOOTER (sama dengan beranda admin) ================= */
        .footer {
            padding: 60px max(7.2%, calc((100% - var(--frame)) / 2 + 87px)) 68px;
            background: var(--navy);
            color: #ffffff;
            display: grid;
            grid-template-columns: 1fr 180px 120px;
            gap: 40px;
            align-items: start;
        }

        .footer-info h2 {
            margin: 0 0 22px;
            font-size: 24px;
            line-height: 1.3;
            font-weight: 600;
        }

        .footer-info p {
            max-width: 420px;
            color: #dce8f8;
            font-size: 12px;
            line-height: 1.7;
        }

        .footer-column h3 {
            margin: 6px 0 14px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.4px;
        }

        .footer-column a {
            display: block;
            margin-bottom: 9px;
            color: #dce8f8;
            font-size: 12px;
            text-decoration: underline;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 900px) {
            .navbar {
                height: auto;
                padding: 14px 5%;
                flex-wrap: wrap;
                gap: 12px;
            }

            .nav-menu {
                width: 100%;
                height: 38px;
                justify-content: space-between;
                gap: 10px;
            }

            main {
                padding: 0 5%;
                margin: 36px auto 50px;
            }

            .page-title {
                font-size: 28px;
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

            .footer {
                grid-template-columns: 1fr 1fr;
                gap: 28px;
                padding: 40px 7%;
            }

            .footer-info {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 380px) {
            .brand-univ {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="brand">
            <img src="{{ asset('images/logo-ub.png') }}" alt="Logo Universitas Brawijaya">
            <span class="brand-name">Si<span class="accent">KTM</span></span>
            <span class="brand-univ">UNIVERSITAS BRAWIJAYA</span>
        </div>

        <nav class="nav-menu">
            <a href="{{ url('/dashboard-admin-rektorat') }}">Beranda</a>
            <a href="{{ url('/daftar-pengajuan') }}" class="active">Verifikasi</a>
            <a href="{{ url('/rekap-ktm') }}">Rekap</a>
            <span class="nav-nama">{{ $namaLogin ?? \App\Models\Pengguna::find(session('idPengguna'))?->nama ?? 'Admin' }}</span>
            <form class="nav-keluar" method="POST" action="{{ url('/keluar') }}">
                @csrf
                <button type="submit">Keluar</button>
            </form>
        </nav>
    </header>

    <main>
        <a href="{{ url('/daftar-pengajuan') }}" class="kembali">&larr; Kembali ke daftar pengajuan</a>

        <h1 class="page-title">Verifikasi Pengajuan</h1>

        @if (session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="message error">{{ $errors->first() }}</div>
        @endif

        <div class="content">

            <!-- KOLOM KIRI -->
            <div class="left-column">

                <section class="card">
                    <p class="data-label">Data Mahasiswa</p>

                    <p class="student-name">{{ $pengajuan->nama ?? '' }}</p>

                    <p class="student-info">
                        NIM {{ $pengajuan->nim ?? '' }}
                        &middot; {{ $pengajuan->namaProdi ?? '' }},
                        {{ $pengajuan->namaFakultas ?? '' }}
                    </p>

                    <p class="document-title">Dokumen</p>

                    <div class="document-row">
                        <span>Pas foto</span>
                        @if (!empty($pengajuan->pas_foto))
                            <a href="{{ asset('storage/' . $pengajuan->pas_foto) }}" target="_blank" rel="noopener">Lihat</a>
                        @else
                            <span>Tidak ada</span>
                        @endif
                    </div>

                    <div class="document-row">
                        <span>Dokumen pendukung</span>
                        @if (!empty($pengajuan->dokumen_pendukung))
                            <a href="{{ asset('storage/' . $pengajuan->dokumen_pendukung) }}" target="_blank" rel="noopener">Lihat</a>
                        @else
                            <span>Tidak dilampirkan</span>
                        @endif
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

                <form action="{{ route('pengajuan-ktm.keputusan', $pengajuan->idPengajuan) }}" method="POST">
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

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-info">
            <h2>KEMAHASISWAAN<br>UNIVERSITAS BRAWIJAYA</h2>
            <p>
                SiKTM adalah sistem informasi pengajuan dan pemantauan
                Kartu Tanda Mahasiswa Universitas Brawijaya. Layanan ini
                dikelola oleh Kemahasiswaan untuk memudahkan mahasiswa
                mengurus KTM secara cepat, jelas, dan transparan.
            </p>
        </div>

        <div class="footer-column">
            <h3>NAVIGASI</h3>
            <a href="{{ url('/dashboard-admin-rektorat') }}">Beranda</a>
            <a href="{{ url('/daftar-pengajuan') }}">Verifikasi</a>
            <a href="{{ url('/rekap-ktm') }}">Rekap</a>
        </div>

        <div class="footer-column">
            <h3>LEGAL</h3>
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Ketentuan Layanan</a>
        </div>
    </footer>

</body>
</html>