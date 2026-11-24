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
    .nav { background: #13305a; color: #fff; padding: 0 24px; height: 68px; }
    .nav-isi { max-width: 1100px; height: 100%; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; }
    .nav .kiri { display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 500; }
    .nav .kiri img { height: 28px; }
    .nav .kiri b { font-size: 18px; font-weight: 800; }
    .nav .kiri b span { color: #f2aa00; }
    .nav .kiri > span { font-weight: 500; }
    .nav .kanan { display: flex; align-items: stretch; gap: 45px; height: 100%; }
    .nav .kanan a { display: flex; align-items: center; padding: 3px 0 0; color: #fff; text-decoration: none; font-size: 15px; font-weight: 500; border-bottom: 3px solid transparent; transition: .2s; }
    .nav .kanan a:hover { border-bottom-color: #f2aa00; }

    /* Konten */
    main { flex: 1; display: flex; align-items: flex-start; justify-content: center; padding: 32px 16px 56px; }
    .card { width: 100%; max-width: 560px; background: #fff; border-radius: 24px; padding: 32px 40px 36px; text-align: center; }
    .ikon { display: block; width: 68px; height: 68px; margin: 0 auto; animation: ikon-muncul .5s cubic-bezier(.34, 1.56, .64, 1) both; }
    .card h1 { margin: 12px 0 16px; font-size: 32px; font-weight: 800; }
    .ket { margin: 0 0 20px; font-size: 15px; line-height: 1.5; color: #6b7a90; font-weight: 500; }
    .baris { display: flex; justify-content: space-between; padding: 13px 0; border-bottom: 1px solid #dce8f8; font-size: 16px; font-weight: 700; text-align: left; }
    .btn { display: block; margin-top: 18px; padding: 17px; background: #f2aa00; color: #000; border-radius: 12px; font-size: 15px; font-weight: 700; text-decoration: none; }

    /* Animasi centang: lingkaran muncul, lalu centang digambar */
    .centang-garis { stroke-dasharray: 40; stroke-dashoffset: 40; animation: centang-gambar .45s .4s ease-out forwards; }
    @keyframes ikon-muncul { from { transform: scale(.4); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    @keyframes centang-gambar { to { stroke-dashoffset: 0; } }

    @media (prefers-reduced-motion: reduce) {
      .ikon { animation: none; }
      .centang-garis { animation: none; stroke-dashoffset: 0; }
    }

    /* Footer */
    footer { padding: 60px max(7.2%, calc((100% - 1200px) / 2 + 87px)) 68px; background: #13305a; color: #fff; }
    .footer-isi { display: grid; grid-template-columns: 1fr 180px 120px; gap: 40px; align-items: start; }
    footer h2 { margin: 0 0 22px; font-size: 24px; line-height: 1.3; font-weight: 600; }
    footer p { max-width: 420px; margin: 0; color: #dce8f8; font-size: 12px; line-height: 1.7; font-weight: 500; }
    footer .kolom { display: contents; }
    footer .kolom h4 { margin: 6px 0 14px; font-size: 12px; font-weight: 700; letter-spacing: .4px; }
    footer .kolom a { display: block; margin-bottom: 9px; color: #dce8f8; font-size: 12px; text-decoration: underline; font-weight: 500; }

    @media (max-width: 900px) {
      footer { padding: 40px 7%; }
      .footer-isi { grid-template-columns: 1fr 1fr; gap: 28px; }
      .footer-isi > div:first-child { grid-column: 1 / -1; }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <header class='nav'>
    <div class='nav-isi'>
      <div class='kiri'>
        <img src='{{ asset("images/logo-ub.png") }}' alt='Logo UB'>
        <b>Si<span>KTM</span></b>
        <span>UNIVERSITAS BRAWIJAYA</span>
      </div>
      <nav class='kanan'>
        <a href="{{ url('/beranda-mahasiswa') }}">Beranda</a>
        <a href="{{ url('/riwayat-pengajuan') }}">Riwayat</a>
        <a href="{{ url('/bantuan') }}">Bantuan</a>
        <a href="{{ url('/profil-mahasiswa') }}">{{ $namaMahasiswa ?? $namaLogin ?? 'Profil' }}</a>
      </nav>
    </div>
  </header>

  <!-- Card pengajuan terkirim -->
  <main>
    <div class='card'>
      <svg class='ikon' viewBox='0 0 56 56' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'>
        <circle cx='28' cy='28' r='28' fill='#2e9e48'/>
        <path class='centang-garis' d='M15 29l9 9 17-19' fill='none' stroke='#fff' stroke-width='6' stroke-linecap='round' stroke-linejoin='round'/>
      </svg>
      <h1>Pengajuan Terkirim</h1>
      <p class='ket'>Admin Rektorat akan memeriksa dokumenmu. Kamu dapat notifikasi maksimal 2×24 jam bila data tidak lengkap.</p>

      <div class='baris'><span>Alasan</span><span>{{ $alasan ?? 'KTM baru' }}</span></div>
      <div class='baris'><span>Jalur</span><span>{{ $jalur ?? 'Rektorat' }}</span></div>
      <div class='baris'><span>Tanggal</span><span>{{ $tanggal ?? date('d F Y') }}</span></div>

      <a href="{{ url('/status-pengajuan') }}" class='btn'>Lihat status pengajuan</a>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <div class='footer-isi'>
      <div>
        <h2>KEMAHASISWAAN<br>UNIVERSITAS BRAWIJAYA</h2>
        <p>SiKTM adalah sistem informasi pengajuan dan pemantauan Kartu Tanda Mahasiswa Universitas Brawijaya. Layanan ini dikelola oleh Kemahasiswaan untuk memudahkan mahasiswa mengurus KTM secara cepat, jelas, dan transparan.</p>
      </div>
      <div class='kolom'>
        <div>
          <h4>NAVIGASI</h4>
          <a href="{{ url('/beranda-mahasiswa') }}">Beranda</a>
          <a href="{{ url('/riwayat-pengajuan') }}">Riwayat</a>
          <a href="{{ url('/bantuan') }}">Bantuan</a>
          <a href="{{ url('/kontak-kemahasiswaan') }}">Kontak Kemahasiswaan</a>
        </div>
        <div>
          <h4>LEGAL</h4>
          <a href='#'>Kebijakan Privasi</a>
          <a href='#'>Ketentuan Layanan</a>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>