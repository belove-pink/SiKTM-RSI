<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi KTM - SiKTM</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --heading-font: 'Bricolage Grotesque', 'Plus Jakarta Sans', Arial, sans-serif;
            --frame: 1200px;
            --navy: #13305a;
            --amber: #f2aa00;
            --muted: #657080;
            --line: #e1e9f5;
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
        .stat-value,
        .stat-label {
            font-family: var(--heading-font);
            font-optical-sizing: none;
            font-variation-settings: 'opsz' 96;
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
            border-bottom-color: var(--amber);
        }

        /* ================= KONTEN ================= */
        .main-content {
            min-height: 624px;
            padding: 52px max(6%, calc((100% - var(--frame)) / 2 + 72px)) 72px;
        }

        .page-title {
            margin: 0 0 10px;
            font-size: 35px;
            line-height: 1.3;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .page-sub {
            margin: 0 0 24px;
            font-size: 14px;
            color: var(--muted);
        }

        /* ---- Pencarian dan filter ---- */
        .search-row {
            display: flex;
            gap: 14px;
            max-width: 640px;
            margin-bottom: 14px;
        }

        .search-row input {
            flex: 1;
            min-width: 0;
            height: 46px;
            padding: 0 22px;
            border: 1px solid var(--navy);
            border-radius: 999px;
            background: #ffffff;
            color: var(--navy);
            font: inherit;
            font-size: 14px;
        }

        .search-row input:focus-visible,
        .filter select:focus-visible {
            outline: 3px solid var(--amber);
            outline-offset: 2px;
        }

        .search-row button {
            height: 46px;
            padding: 0 30px;
            border: 0;
            border-radius: 999px;
            background: var(--amber);
            color: var(--navy);
            font: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .search-row button:hover {
            background: #e69f00;
        }

        .filter {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 28px;
        }

        .filter select {
            height: 42px;
            min-width: 170px;
            padding: 0 44px 0 18px;
            border: 1px solid var(--navy);
            border-radius: 999px;
            color: var(--navy);
            font: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            -webkit-appearance: none;
            appearance: none;
            background: #ffffff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1.5l5 5 5-5' fill='none' stroke='%2313305a' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") no-repeat right 18px center / 12px 8px;
        }

        /* ---- Kartu ringkasan ---- */
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
        }

        .stat-label {
            font-size: 17px;
            line-height: 1.3;
            font-weight: 700;
        }

        /* ---- Tabel ---- */
        .table-card {
            background: #ffffff;
            border-radius: 26px;
            padding: 12px 26px 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 640px;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 14px;
            font-weight: 600;
            padding: 16px 10px;
            border-bottom: 1px solid var(--line);
        }

        td {
            padding: 14px 10px;
            font-size: 14px;
            border-bottom: 1px solid var(--line);
            white-space: nowrap;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        .pill {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .pill.belum  { background: #eceff4; color: #4a5d7a; }
        .pill.proses { background: #fbe9b7; color: #8a5a00; }
        .pill.sudah  { background: #d5f1e5; color: #16805a; }

        .aksi {
            color: var(--navy);
            text-decoration: none;
            font-weight: 600;
        }

        .aksi:hover {
            text-decoration: underline;
        }

        .kosong {
            text-align: center;
            color: var(--muted);
            padding: 34px 10px;
        }

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

            .page-title {
                font-size: 26px;
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .stat-card {
                min-height: 120px;
            }

            .table-card {
                padding: 8px 16px 16px;
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

        @media (max-width: 480px) {
            .brand-univ {
                display: none;
            }

            .search-row {
                flex-wrap: wrap;
            }

            .search-row input {
                flex-basis: 100%;
            }

            .search-row button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    @php
        $rektorat = $adalahRektorat ?? false;
        $urlBeranda = url($rektorat ? '/dashboard-admin-rektorat' : '/dashboard-admin-fakultas');
        $kelasStatus = [
            'Belum Mengajukan'   => 'belum',
            'Sedang Diproses'    => 'proses',
            'Sudah Memiliki KTM' => 'sudah',
        ];
    @endphp

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="brand">
            <img src="{{ asset('images/logo-ub.png') }}" alt="Logo Universitas Brawijaya">
            <span class="brand-name">Si<span class="accent">KTM</span></span>
            <span class="brand-univ">UNIVERSITAS BRAWIJAYA</span>
        </div>

        <nav class="nav-menu">
            <a href="{{ $urlBeranda }}">Beranda</a>
            @if ($rektorat)
                <a href="{{ url('/daftar-pengajuan') }}">Verifikasi</a>
                <a href="{{ url('/rekap-ktm') }}" class="active">Rekap</a>
            @else
                <a href="{{ url('/rekap-ktm') }}" class="active">Data Mahasiswa</a>
                <a href="{{ url('/daftar-pengajuan') }}">Pengajuan</a>
            @endif
            <span class="nav-nama">{{ $namaAdmin ?? $namaLogin ?? 'Admin' }}</span>
            <form class="nav-keluar" method="POST" action="{{ url('/keluar') }}">
                @csrf
                <button type="submit">Keluar</button>
            </form>
        </nav>
    </header>

    <!-- KONTEN -->
    <main class="main-content">

        <h1 class="page-title">Rekapitulasi KTM</h1>
        <p class="page-sub">
            {{ $rektorat ? 'Rekap kepemilikan KTM seluruh fakultas.' : 'Rekap kepemilikan KTM mahasiswa di fakultasmu.' }}
            Cari berdasarkan NIM atau gunakan filter.
        </p>

        <!-- Pencarian NIM dan filter dalam satu form -->
        <form method="GET" action="{{ url('/rekap-ktm') }}">
            <div class="search-row">
                <input type="text" name="kataKunci" placeholder="Cari NIM" value="{{ request('kataKunci') }}" aria-label="Cari NIM">
                <button type="submit">Cek</button>
            </div>

            <div class="filter">
                <select name="prodi" onchange="this.form.submit()" aria-label="Filter prodi">
                    <option value="">Semua Prodi</option>
                    @foreach (($daftarProdi ?? []) as $p)
                        <option value="{{ $p->idProdi }}" {{ request('prodi') == $p->idProdi ? 'selected' : '' }}>{{ $p->namaProdi }}</option>
                    @endforeach
                </select>

                <select name="angkatan" onchange="this.form.submit()" aria-label="Filter angkatan">
                    <option value="">Semua Angkatan</option>
                    @foreach ([2026, 2025, 2024, 2023] as $a)
                        <option value="{{ $a }}" {{ request('angkatan') == $a ? 'selected' : '' }}>{{ $a }}</option>
                    @endforeach
                </select>

                <select name="status" onchange="this.form.submit()" aria-label="Filter status">
                    <option value="">Semua Status</option>
                    @foreach (['Belum Mengajukan', 'Sedang Diproses', 'Sudah Memiliki KTM'] as $s)
                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- KARTU RINGKASAN -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-value">{{ $belum ?? 0 }}</div>
                <div class="stat-label">Belum Mengajukan</div>
            </div>

            <div class="stat-card proses">
                <div class="stat-value">{{ $proses ?? 0 }}</div>
                <div class="stat-label">Sedang Diproses</div>
            </div>

            <div class="stat-card selesai">
                <div class="stat-value">{{ $sudah ?? 0 }}</div>
                <div class="stat-label">Sudah Memiliki KTM</div>
            </div>
        </div>

        <!-- TABEL REKAP MAHASISWA -->
        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($daftar ?? []) as $baris)
                        <tr>
                            <td>{{ $baris['nim'] }}</td>
                            <td>{{ $baris['prodi'] }}</td>
                            <td><span class="pill {{ $kelasStatus[$baris['status']] ?? 'belum' }}">{{ $baris['status'] }}</span></td>
                            <td>
                                @if ($rektorat && !empty($baris['idPengajuan']))
                                    <a class="aksi" href="{{ url('/pengajuan-ktm/verifikasi/' . $baris['idPengajuan']) }}">
                                        {{ $baris['status'] === 'Sedang Diproses' ? 'Periksa' : 'Lihat' }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="kosong">{{ $pesan ?? 'Data rekap tidak ditemukan' }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
            <a href="{{ $urlBeranda }}">Beranda</a>
            @if ($rektorat)
                <a href="{{ url('/daftar-pengajuan') }}">Verifikasi</a>
                <a href="{{ url('/rekap-ktm') }}">Rekap</a>
            @else
                <a href="{{ url('/rekap-ktm') }}">Data Mahasiswa</a>
                <a href="{{ url('/daftar-pengajuan') }}">Pengajuan</a>
            @endif
        </div>

        <div class="footer-column">
            <h3>LEGAL</h3>
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Ketentuan Layanan</a>
        </div>
    </footer>

</body>
</html>