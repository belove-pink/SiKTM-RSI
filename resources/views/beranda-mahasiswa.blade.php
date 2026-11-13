<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Mahasiswa - SiKTM</title>

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
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif;
            font-weight: 500;
            background: #dce8f8;
            color: #13305a;
        }

        /* Bricolage Grotesque untuk logo & judul */
        .brand-name,
        .greeting,
        .card-heading h2,
        .apply-card h2 {
            font-family: var(--heading-font);
            font-optical-sizing: none;
            font-variation-settings: 'opsz' 96; /* bentuk huruf display, seperti di desain */
        }

        /* ================= NAVBAR ================= */
        .navbar {
            height: 66px;
            padding: 0 max(2.5%, calc((100% - var(--frame)) / 2 + 37px));
            background: #13305a;
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
            gap: 45px;
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

        /* ================= KONTEN ================= */
        .main-content {
            min-height: 624px;
            padding: 52px max(6%, calc((100% - var(--frame)) / 2 + 72px)) 98px;
        }

        .greeting {
            margin: 0 0 40px;
            font-size: 35px;
            line-height: 1.3;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: #13305a;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 0.94fr;
            gap: 57px;
            align-items: stretch;
        }

        .card {
            background: #ffffff;
            border-radius: 26px;
            min-height: 354px;
        }

        /* ---- Kartu pengajuan ---- */
        .application-card {
            padding: 30px 26px;
        }

        .card-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
        }

        .card-heading h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.2px;
        }

        .status {
            display: inline-block;
            padding: 7px 19px;
            border-radius: 30px;
            background: #f2f4f9;
            color: #13305a;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .date {
            margin: 18px 0 14px;
            color: #657080;
            font-size: 15px;
        }

        .description {
            max-width: 340px;
            margin: 0 0 14px;
            color: #657080;
            font-size: 15px;
            line-height: 1.6;
        }

        .detail-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #13305a;
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

        .card-divider {
            height: 1px;
            margin: 22px 0 20px;
            background: #d3e0ef;
            border: none;
        }

        .history-title {
            margin: 0 0 15px;
            color: #77808c;
            font-size: 14px;
            font-weight: 500;
        }

        .history-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
        }

        .history-item p {
            margin: 0;
            font-size: 15px;
            font-weight: 500;
        }

        /* ---- Kartu ajukan KTM ---- */
        .apply-card {
            padding: 35px 34px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .apply-card h2 {
            max-width: 420px;
            margin: 0;
            font-size: 35px;
            line-height: 1.3;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: #13305a;
        }

        .apply-button {
            width: 100%;
            min-height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 12px;
            background: #f2aa00;
            color: #13305a;
            font-family: inherit;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .apply-button:hover {
            background: #e69f00;
        }

        /* ================= FOOTER ================= */
        .footer {
            padding: 60px max(7.2%, calc((100% - var(--frame)) / 2 + 87px)) 68px;
            background: #13305a;
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
                min-height: 0;
                padding: 32px 5% 48px;
            }

            .greeting {
                font-size: 26px;
                margin-bottom: 26px;
            }

            .content-grid {
                grid-template-columns: 1fr;
                gap: 22px;
            }

            .card {
                min-height: 220px;
                border-radius: 20px;
            }

            .apply-card {
                min-height: 240px;
                gap: 28px;
            }

            .apply-card h2 {
                font-size: 26px;
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

            .card-heading {
                align-items: flex-start;
                flex-direction: column;
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
            <a href="#beranda" class="active">Beranda</a>
            <a href="#riwayat">Riwayat</a>
            <a href="#bantuan">Bantuan</a>
            <a href="#profil">{{ auth()->user()->name ?? '[NAMA MAHASISWA]' }}</a>
        </nav>
    </header>

    <!-- KONTEN BERANDA -->
    <main class="main-content" id="beranda">

        <h1 class="greeting">
            Halo, {{ auth()->user()->name ?? '[NAMA]' }}. Ada yang bisa kami bantu?
        </h1>

        <div class="content-grid">

            <!-- KARTU PENGAJUAN -->
            <section class="card application-card">

                <div class="card-heading">
                    <h2>Pengajuan KTM baru</h2>
                    <span class="status">Sedang diverifikasi</span>
                </div>

                <p class="date">Diajukan 12 Okt 2026</p>

                <p class="description">
                    Admin sedang memeriksa dokumenmu. Kamu akan
                    dapat notifikasi saat statusnya berubah.
                </p>

                <a href="#" class="detail-link">
                    Lihat status lengkap <span>&rarr;</span>
                </a>

                <hr class="card-divider">

                <div id="riwayat">
                    <p class="history-title">RIWAYAT</p>

                    <div class="history-item">
                        <p>KTM baru</p>
                        <span class="status">Sedang diverifikasi</span>
                    </div>
                </div>

                <hr class="card-divider">

            </section>

            <!-- KARTU AJUKAN KTM -->
            <section class="card apply-card">
                <h2>
                    Butuh KTM baru,<br>
                    hilang, atau rusak?
                </h2>

                <a href="#" class="apply-button">
                    Ajukan KTM
                </a>
            </section>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="footer" id="bantuan">

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
            <a href="#beranda">Beranda</a>
            <a href="#riwayat">Riwayat</a>
            <a href="#bantuan">Bantuan</a>
            <a href="#bantuan">Kontak Kemahasiswaan</a>
        </div>

        <div class="footer-column">
            <h3>LEGAL</h3>
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Ketentuan Layanan</a>
        </div>

    </footer>

</body>
</html>