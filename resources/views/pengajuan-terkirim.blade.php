<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Pengajuan Terkirim - SiKTM</title>
  <link rel='preconnect' href='https://fonts.googleapis.com'>
  <link href='https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap' rel='stylesheet'>
  <style>
    * { box-sizing: border-box; }
    body { margin: 0; font-family: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif; background: #dce8f8; color: #13305a; min-height: 100vh; display: flex; flex-direction: column; }

    /* Navbar */
    .nav { background: #13305a; color: #fff; display: flex; align-items: center; justify-content: space-between; padding: 0 32px; height: 56px; }
    .nav .kiri { display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 500; }
    .nav .kiri img { height: 28px; }
    .nav .kiri b { font-size: 17px; font-weight: 800; }
    .nav .kiri b span { color: #f2aa00; }
    .nav .kanan { display: flex; gap: 32px; font-size: 13px; font-weight: 500; }
    .nav .kanan a { color: #fff; text-decoration: none; padding: 4px 8px; }
    .nav .kanan a.aktif { border-bottom: 2px solid #f2aa00; }

    /* Konten */
    main { flex: 1; display: flex; align-items: flex-start; justify-content: center; padding: 32px 16px 56px; }
    .card { width: 100%; max-width: 560px; background: #fff; border-radius: 24px; padding: 32px 40px 36px; text-align: center; }
    .ikon { width: 68px; height: 68px; margin: 0 auto; }
    .card h1 { margin: 12px 0 16px; font-size: 32px; font-weight: 800; }
    .ket { margin: 0 0 20px; font-size: 15px; line-height: 1.5; color: #6b7a90; font-weight: 500; }
    .baris { display: flex; justify-content: space-between; padding: 13px 0; border-bottom: 1px solid #dce8f8; font-size: 16px; font-weight: 700; text-align: left; }
    .btn { display: block; margin-top: 18px; padding: 17px; background: #f2aa00; color: #000; border-radius: 12px; font-size: 15px; font-weight: 700; text-decoration: none; }

    /* Footer */
    footer { background: #13305a; color: #fff; padding: 40px 60px 48px; display: flex; justify-content: space-between; gap: 40px; flex-wrap: wrap; }
    footer h2 { margin: 0 0 14px; font-size: 20px; font-weight: 800; line-height: 1.3; }
    footer p { margin: 0; max-width: 300px; font-size: 10px; line-height: 1.5; }
    footer .kolom { display: flex; gap: 48px; font-size: 10px; }
    footer .kolom h4 { margin: 0 0 8px; font-size: 10px; font-weight: 800; }
    footer .kolom a { display: block; margin-bottom: 6px; color: #fff; text-decoration: underline; }
  </style>
</head>
<body>
  <!-- Navbar -->
  <header class='nav'>
    <div class='kiri'>
      <img src='{{ asset("images/logo-ub.png") }}' alt='Logo UB'>
      <b>Si<span>KTM</span></b>
      <span>UNIVERSITAS BRAWIJAYA</span>
    </div>
    <nav class='kanan'>
      <a href='#' class='aktif'>Beranda</a>
      <a href='#'>Riwayat</a>
      <a href='#'>Bantuan</a>
      <a href='#'>{{ $namaMahasiswa ?? 'NAMA MAHASISWA' }}</a>
    </nav>
  </header>

  <!-- Card pengajuan terkirim -->
  <main>
    <div class='card'>
      <svg class='ikon' viewBox='0 0 56 56' xmlns='http://www.w3.org/2000/svg'>
        <circle cx='28' cy='28' r='28' fill='#2e9e48'/>
        <path d='M15 29l9 9 17-19' fill='none' stroke='#fff' stroke-width='6' stroke-linecap='round' stroke-linejoin='round'/>
      </svg>
      <h1>Pengajuan Terkirim</h1>
      <p class='ket'>Admin Rektorat akan memeriksa dokumenmu. Kamu dapat notifikasi maksimal 2×24 jam bila data tidak lengkap.</p>

      <div class='baris'><span>Alasan</span><span>{{ $alasan ?? 'KTM baru' }}</span></div>
      <div class='baris'><span>Jalur</span><span>{{ $jalur ?? 'Rektorat' }}</span></div>
      <div class='baris'><span>Tanggal</span><span>{{ $tanggal ?? date('d F Y') }}</span></div>

      <a href='/status-pengajuan' class='btn'>Lihat status pengajuan</a>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <div>
      <h2>KEMAHASISWAAN<br>UNIVERSITAS BRAWIJAYA</h2>
      <p>SiKTM adalah sistem informasi pengajuan dan pemantauan Kartu Tanda Mahasiswa Universitas Brawijaya. Layanan ini dikelola oleh Kemahasiswaan untuk memudahkan mahasiswa mengurus KTM secara cepat, jelas, dan transparan.</p>
    </div>
    <div class='kolom'>
      <div>
        <h4>NAVIGASI</h4>
        <a href='#'>Beranda</a>
        <a href='#'>Riwayat</a>
        <a href='#'>Bantuan</a>
        <a href='#'>Kontak Kemahasiswaan</a>
      </div>
      <div>
        <h4>LEGAL</h4>
        <a href='#'>Kebijakan Privasi</a>
        <a href='#'>Ketentuan Layanan</a>
      </div>
    </div>
  </footer>
</body>
</html>