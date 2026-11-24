<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin Rektorat - SiKTM</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --heading-font: 'Bricolage Grotesque', 'Plus Jakarta Sans', Arial, sans-serif;
            --frame: 1200px; /* makin kecil = konten makin sempit */
            --navy: #13305a;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif;
            font-weight: 500;
            background: #dce8f8;
            color: var(--navy);
        }

        /* Bricolage Grotesque untuk logo, judul, angka & label kartu */
        .brand-name,
        .greeting,
        .stat-value,
        .stat-label,
        .section-title {
            font-family: var(--heading-font);
            font-optical-sizing: none;
            font-variation-settings: 'opsz' 96; /* bentuk huruf display, seperti di desain */
        }

        /* ================= NAVBAR ================= */
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
            color: #f2aa00;
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
            border-bottom-color: #f2aa00;
        }

        /* Nama admin (teks biasa) dan tombol Keluar */
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
            margin: 0;
            display: flex;
            align-items: stretch;
        }

        .nav-keluar button {
            padding: 3px 0 0;
            border: 0;
            border-bottom: 3px solid transparent;
            background: none;
            color: #ffffff;
            font: inherit;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
        }

        .nav-keluar button:hover {
            border-bottom-color: #f2aa00;
        }

        /* ================= KONTEN ================= */
        .main-content {
            padding: 52px max(6%, calc((100% - var(--frame)) / 2 + 72px)) 32px;
        }

        .greeting {
            margin: 0 0 12px;
            font-size: 35px;
            line-height: 1.3;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: var(--navy);
        }

        .subtitle {
            margin: 0 0 20px 4px;
            font-size: 14px;
            font-weight: 500;
            color: #657080;
        }

        /* ---- Kartu statistik ---- */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            margin-bottom: 29px;
        }

        .stat-card {
            min-height: 146px;
            padding: 22px 19px 18px;
            border: 1px solid #2b4a7a;
            border-radius: 13px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-card.proses {
            background: #edbb41;
        }

        .stat-card.selesai {
            background: #d5f1e5;
        }

        .stat-value {
            font-size: 40px;
            line-height: 1.1;
            font-weight: 700;
            color: var(--navy);
        }

        .stat-label {
            font-size: 17px;
            line-height: 1.3;
            font-weight: 700;
            color: var(--navy);
        }

        /* ---- Data pengajuan mahasiswa ---- */
        .section-card {
            padding: 24px 34px 32px;
            border-radius: 27px;
            background: #ffffff;
        }

        .section-title {
            margin: 0 0 18px;
            font-size: 23px;
            line-height: 1.3;
            font-weight: 700;
            letter-spacing: -0.2px;
            color: var(--navy);
        }

        .section-divider {
            height: 1px;
            margin: 0 -19px 15px;
            background: #d3e0ef;
            border: none;
        }

        .student-row {
            min-height: 52px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
        }

        .student-name {
            font-size: 15px;
            font-weight: 500;
            color: #0f1f38;
        }

        .status {
            display: inline-block;
            padding: 6px 18px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status.diajukan    { background: #dce8f8; color: #13305a; }
        .status.diverifikasi { background: #fbe9b7; color: #8a5a00; }
        .status.diterima    { background: #d5f1e5; color: #16805a; }
        .status.ditolak     { background: #fce2df; color: #b42318; }

        .empty-row {
            padding: 18px 0;
            font-size: 15px;
            color: #657080;
        }

        .detail-link {
            margin-top: 14px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--navy);
            font-size: 15px;
            font-weight: 700;
            text-decoration: underline;
        }

        .detail-link span {
            font-size: 24px;
            font-weight: 400;
            line-height: 1;
            text-decoration: none;
        }

        /* ================= FOOTER ================= */
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
            margin: 0;
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

            .main-content {
                padding: 32px 5% 32px;
            }

            .greeting {
                font-size: 26px;
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .stat-card {
                min-height: 120px;
            }

            .section-card {
                padding: 22px 20px 26px;
                border-radius: 20px;
            }

            .section-divider {
                margin-left: -20px;
                margin-right: -20px;
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
            <a href="{{ url('/dashboard-admin-rektorat') }}" class="active">Beranda</a>
            <a href="{{ url('/daftar-pengajuan') }}">Verifikasi</a>
            <a href="{{ url('/rekap-ktm') }}">Rekap</a>
            <span class="nav-nama">{{ $admin->nama ?? $namaLogin ?? 'Admin' }}</span>
            <form class="nav-keluar" method="POST" action="{{ url('/keluar') }}">
                @csrf
                <button type="submit">Keluar</button>
            </form>
        </nav>
    </header>

    <!-- KONTEN -->
    <main class="main-content">

        <h1 class="greeting">
            Selamat datang, {{ $admin->nama ?? $namaLogin ?? 'Admin' }}
        </h1>

        <p class="subtitle">Ringkasan pengajuan KTM Universitas Brawijaya</p>

        <!-- KARTU STATISTIK -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-value">{{ $totalPengajuan ?? 0 }}</div>
                <div class="stat-label">Total Pengajuan</div>
            </div>

            <div class="stat-card proses">
                <div class="stat-value">{{ $sedangDiproses ?? 0 }}</div>
                <div class="stat-label">Sedang Diproses</div>
            </div>

            <div class="stat-card selesai">
                <div class="stat-value">{{ $diterima ?? 0 }}</div>
                <div class="stat-label">Diterima</div>
            </div>
        </div>

        <!-- DATA PENGAJUAN MAHASISWA -->
        @php
            $ringkasan = collect($pengajuanTerbaru ?? [])->take(5);
        @endphp

        <section class="section-card">
            <h2 class="section-title">Pengajuan terbaru</h2>

            <hr class="section-divider">

            @forelse ($ringkasan as $pengajuan)
                <div class="student-row">
                    <span class="student-name">{{ $pengajuan->nama }} &middot; Jalur {{ $pengajuan->jalur }}</span>

                    <span class="status {{ strtolower($pengajuan->status) }}">
                        {{ $pengajuan->status }}
                    </span>
                </div>
            @empty
                <p class="empty-row">
                    Belum ada pengajuan KTM.
                </p>
            @endforelse

            <a href="{{ url('/daftar-pengajuan') }}" class="detail-link">
                Lihat seluruh pengajuan <span>&rarr;</span>
            </a>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">

        <div class="footer-info">
            <h2>
                KEMAHASISWAAN<br>
                UNIVERSITAS BRAWIJAYA
            </h2>

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