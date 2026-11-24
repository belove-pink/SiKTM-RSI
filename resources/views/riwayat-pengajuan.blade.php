
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengajuan - SiKTM</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --heading-font: 'Bricolage Grotesque', 'Plus Jakarta Sans', Arial, sans-serif;
            --frame: 1200px;
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

        .brand-name,
        .page-title,
        .item-title,
        .footer-info h2 {
            font-family: var(--heading-font);
            font-optical-sizing: none;
            font-variation-settings: 'opsz' 96;
        }

        /* NAVBAR */
        .navbar {
            min-height: 66px;
            padding: 0 max(2.5%, calc((100% - var(--frame)) / 2 + 37px));
            background: var(--navy);
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
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
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.4px;
        }

        .brand-name .accent {
            color: #f2aa00;
        }

        .brand-univ {
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.2px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 38px;
            min-height: 66px;
        }

        .nav-menu a {
            min-height: 66px;
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-bottom: 3px solid transparent;
            padding-top: 3px;
            transition: 0.2s;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            border-bottom-color: #f2aa00;
        }

        /* KONTEN */
        .main-content {
            max-width: 1200px;
            margin: auto;
            padding: 42px 72px 67px;
        }

        .page-title {
            margin: 0 0 6px;
            font-size: 36px;
            line-height: 1.3;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: var(--navy);
        }

        .subtitle {
            margin: 0 0 21px;
            font-size: 15px;
            font-weight: 500;
            color: #657080;
        }

        /* FILTER */
        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 11px;
            margin-bottom: 21px;
        }

        .filter {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 38px;
            padding: 0 19px;
            border: none;
            border-radius: 30px;
            background: white;
            color: var(--navy);
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .filter:hover {
            background: #eef3fb;
        }

        .filter.active {
            background: var(--navy);
            color: white;
        }

        /* DAFTAR RIWAYAT */
        .history-card {
            padding: 6px 26px;
            border-radius: 29px;
            background: white;
        }

        .item {
            display: grid;
            grid-template-columns: 1fr auto 182px;
            align-items: center;
            gap: 29px;
            padding: 22px 0;
            border-bottom: 1px solid #d3e0ef;
        }

        .item.last-visible {
            border-bottom: none;
        }

        .item-title {
            margin: 0 0 3px;
            font-size: 21px;
            line-height: 1.3;
            font-weight: 700;
            letter-spacing: -0.2px;
            color: var(--navy);
        }

        .item-meta {
            margin: 0;
            font-size: 15px;
            color: #657080;
        }

        .status {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status.diajukan {
            background: #e4ebf7;
            color: #13305a;
        }

        .status.diverifikasi {
            background: #fdebc0;
            color: #8a5a00;
        }

        .status.diterima {
            background: #d5f1e5;
            color: #16805a;
        }

        .status.siap-diambil {
            background: #d5f1e5;
            color: #16805a;
        }

        .status.ditolak {
            background: #fcdcdc;
            color: #b42318;
        }

        .detail-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: var(--navy);
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            cursor: default;
            opacity: 0.65;
        }

        .detail-link span {
            font-size: 22px;
            font-weight: 400;
            line-height: 1;
        }

        .empty {
            padding: 36px 0;
            text-align: center;
            font-size: 15px;
            color: #657080;
        }

        /* FOOTER */
        .footer {
            padding: 46px max(5.6%, calc((100% - var(--frame)) / 2 + 72px)) 50px;
            background: var(--navy);
            color: white;
            display: grid;
            grid-template-columns: 1fr 172px 120px;
            gap: 40px;
            align-items: start;
        }

        .footer-info h2 {
            margin: 0 0 18px;
            font-size: 26px;
            line-height: 1.2;
            font-weight: 700;
        }

        .footer-info p {
            max-width: 330px;
            margin: 0;
            color: #dce8f8;
            font-size: 12px;
            line-height: 1.6;
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

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .navbar {
                height: auto;
                padding: 14px 5%;
                flex-wrap: wrap;
                gap: 12px;
            }

            .nav-menu {
                width: 100%;
                min-height: 38px;
                justify-content: space-between;
                gap: 10px;
            }

            .nav-menu a {
                min-height: 38px;
            }

            .main-content {
                padding: 32px 5% 48px;
            }

            .page-title {
                font-size: 28px;
            }

            .history-card {
                padding: 4px 20px;
                border-radius: 20px;
            }

            .item {
                grid-template-columns: 1fr auto;
                gap: 12px 16px;
            }

            .item-info {
                grid-column: 1 / -1;
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

        @media (max-width: 480px) {
            .brand-univ {
                display: none;
            }

            .item {
                grid-template-columns: 1fr;
            }

            .item-info {
                grid-column: auto;
            }

            .item .status,
            .item .detail-link {
                justify-self: start;
            }

            .footer {
                grid-template-columns: 1fr;
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
            <a href="{{ url('/beranda-mahasiswa') }}">Beranda</a>
            <a href="{{ route('riwayat.pengajuan') }}" class="active">Riwayat</a>
            <a href="{{ url('/bantuan') }}">Bantuan</a>
            <a href="#">{{ $nama ?? 'Mahasiswa' }}</a>        
        </nav>
    </header>

    <!-- KONTEN -->
    <main class="main-content">

        <h1 class="page-title">Riwayat pengajuan</h1>
        <p class="subtitle">
            Semua pengajuan KTM yang pernah kamu buat, dari yang terbaru.
        </p>

        <!-- FILTER BACKEND -->
        <div class="filters">

            <a href="{{ route('riwayat.pengajuan', ['status' => 'semua']) }}"
               class="filter {{ $filterAktif === 'semua' ? 'active' : '' }}">
                Semua
            </a>

            <a href="{{ route('riwayat.pengajuan', ['status' => 'diverifikasi']) }}"
               class="filter {{ $filterAktif === 'diverifikasi' ? 'active' : '' }}">
                Diverifikasi
            </a>

            <a href="{{ route('riwayat.pengajuan', ['status' => 'ditolak']) }}"
               class="filter {{ $filterAktif === 'ditolak' ? 'active' : '' }}">
                Ditolak
            </a>

            <a href="{{ route('riwayat.pengajuan', ['status' => 'siap-diambil']) }}"
               class="filter {{ $filterAktif === 'siap-diambil' ? 'active' : '' }}">
                Siap Diambil
            </a>

        </div>

        <!-- DAFTAR RIWAYAT -->
        <section class="history-card">

            @forelse ($riwayat as $item)

                <article class="item">

                    <div class="item-info">
                        <h3 class="item-title">
                            {{ $item['jenis'] }}
                        </h3>

                        <p class="item-meta">
                            Diajukan {{ $item['tanggal'] }}
                            &middot; No. {{ $item['id'] }}
                        </p>
                    </div>

                    <span class="status {{ $item['kondisi'] }}">
                        {{ $item['status'] }}
                    </span>

                    <!-- Akan dihubungkan saat integrasi branch status-pengajuan -->
                    <span class="detail-link" aria-disabled="true">
                        Detail <span>&rarr;</span>
                    </span>

                </article>

            @empty

                <div class="empty">
                    Tidak ada pengajuan dengan status tersebut.
                </div>

            @endforelse

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
                Kartu Tanda Mahasiswa. Layanan ini dikelola oleh
                Kemahasiswaan untuk memudahkan mahasiswa mengurus KTM
                secara cepat, jelas, dan transparan.
            </p>
        </div>

        <div class="footer-column">
            <h3>NAVIGASI</h3>
            <a href="{{ url('/beranda-mahasiswa') }}">Beranda</a>
            <a href="{{ route('riwayat.pengajuan') }}">Riwayat</a>
            <a href="{{ url('/bantuan') }}">Bantuan</a>
            <a href="#">Kontak Kemahasiswaan</a>
        </div>

        <div class="footer-column">
            <h3>LEGAL</h3>
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Ketentuan Layanan</a>
        </div>

    </footer>

</body>
</html>