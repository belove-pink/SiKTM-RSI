<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Pengajuan KTM - SiKTM</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
  <style>
    /* Warna dari desain Figma. Font judul dan banner atas: Bricolage Grotesque, font teks: Plus Jakarta Sans. */
    :root {
      --navy: #13305a;
      --kuning: #f2aa00;
      --latar: #dce8f8;
      --hijau: #0f7a5c;
      --hijau-teks: #3b937a;
      --hijau-badge: #d5efe6;
      --hijau-kotak: #eaf7f3;
      --abu: #636d78;
      --font-teks: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif;
      --font-judul: 'Bricolage Grotesque', 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif;
    }
    * { box-sizing: border-box; }
    body { margin: 0; font-family: var(--font-teks); color: #000; background: var(--latar); }
    a { color: inherit; }
    .wadah { width: 100%; max-width: 1160px; margin: 0 auto; padding: 0 24px; }

    /* Navbar */
    .navbar { background: var(--navy); color: #fff; font-family: var(--font-judul); }
    .navbar .wadah { display: flex; align-items: center; justify-content: space-between; gap: 24px; min-height: 72px; max-width: 1360px; }
    .merek { display: flex; align-items: center; gap: 12px; font-size: 20px; }
    .merek img { height: 40px; width: auto; }
    .merek b { font-family: var(--font-judul); font-size: 26px; font-weight: 800; }
    .merek b span { color: var(--kuning); }
    .menu { display: flex; align-items: center; gap: 40px; font-size: 18px; }
    .menu a { text-decoration: none; padding: 6px 4px; }
    .menu a.aktif { border-bottom: 3px solid var(--kuning); }

    /* Isi halaman */
    main { padding: 48px 0 64px; }
    h1 { margin: 0 0 24px; font-family: var(--font-judul); font-size: 40px; font-weight: 800; color: var(--navy); }
    h2 { margin: 0 0 2px; font-family: var(--font-judul); font-size: 22px; font-weight: 800; color: var(--navy); }
    .cari p { margin: 0 0 14px; font-size: 18px; }
    .baris-cari { display: flex; gap: 32px; align-items: center; margin-bottom: 32px; flex-wrap: wrap; }
    .baris-cari input { flex: 0 1 640px; width: 100%; height: 48px; padding: 0 16px; border: 1px solid #000; border-radius: 14px; font-family: inherit; font-size: 17px; background: #fff; }
    .baris-cari input::placeholder { color: var(--abu); }
    .baris-cari input:focus { outline: 2px solid var(--kuning); outline-offset: 1px; }
    .tombol-cek { height: 48px; padding: 0 36px; border: none; border-radius: 14px; background: var(--kuning); font-family: inherit; font-size: 18px; font-weight: 700; color: var(--navy); cursor: pointer; }
    .tombol-cek:hover { filter: brightness(0.95); }

    /* Kartu status */
    .kartu { padding: 34px; background: #fff; border: 1.5px solid var(--navy); border-radius: 28px; }
    .kartu-atas { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 36px; flex-wrap: wrap; }
    .info { font-size: 19px; color: var(--abu); }
    .badge { padding: 7px 28px; border-radius: 999px; background: var(--hijau-badge); color: var(--hijau); font-size: 17px; font-weight: 700; }

    /* Stepper 4 tahap */
    .stepper { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 32px; }
    .tahap .garis { height: 7px; border-radius: 4px; background: var(--hijau); margin-bottom: 8px; }
    .tahap strong { display: block; font-size: 17px; color: var(--navy); }
    .tahap small { font-size: 15px; color: var(--abu); }

    /* Kotak info pengambilan */
    .kotak { padding: 26px 30px; background: var(--hijau-kotak); border-radius: 18px; }
    .kotak h3 { margin: 0 0 14px; font-size: 19px; font-weight: 700; color: var(--hijau); }
    .kotak dl { display: grid; grid-template-columns: 240px 1fr; gap: 16px 24px; margin: 0; font-size: 18px; }
    .kotak dt { color: var(--hijau-teks); }
    .kotak dd { margin: 0; font-weight: 700; color: var(--abu); }

    /* Footer */
    footer { background: var(--navy); color: #fff; padding: 56px 0 64px; }
    .footer-isi { display: grid; grid-template-columns: 1.6fr 1fr 1fr; gap: 40px; }
    footer h4 { margin: 0 0 22px; font-family: var(--font-judul); font-size: 30px; font-weight: 700; line-height: 1.25; }
    footer p { margin: 0; max-width: 360px; font-size: 14px; line-height: 1.6; }
    footer h5 { margin: 0 0 14px; font-size: 14px; font-weight: 700; }
    footer ul { margin: 0; padding: 0; list-style: none; font-size: 14px; line-height: 2; }
    footer a { text-decoration: underline; }

    @media (max-width: 800px) {
      .menu { gap: 16px; font-size: 15px; }
      .merek span { display: none; }
      .baris-cari { gap: 12px; }
      .stepper { grid-template-columns: repeat(2, 1fr); }
      .kotak dl { grid-template-columns: 1fr; gap: 4px; }
      .kotak dd { margin-bottom: 10px; }
      .footer-isi { grid-template-columns: 1fr; }
      h1 { font-size: 30px; }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <header class="navbar">
    <div class="wadah">
      <div class="merek">
        <img src="{{ asset('images/logo-ub.png') }}" alt="Logo UB">
        <b>Si<span>KTM</span></b>
        <span>UNIVERSITAS BRAWIJAYA</span>
      </div>
      <nav class="menu">
        <a href="#" class="aktif">Beranda</a>
        <a href="#">Riwayat</a>
        <a href="#">Bantuan</a>
        <span>[NAMA MAHASISWA]</span>
      </nav>
    </div>
  </header>

  <main>
    <div class="wadah">
      <h1>Status Pengajuan KTM</h1>

      <!-- Field NIM dan tombol Cek -->
      <section class="cari">
        <h2>Masukkan NIM Anda</h2>
        <p>Mohon untuk memasukkan NIM yang sesuai dengan</p>
        <form class="baris-cari" method="POST" action="/status-pengajuan">
          @csrf
          <input type="text" name="nim" placeholder="NIM">
          <button type="submit" class="tombol-cek">Cek</button>
        </form>
      </section>

      <!-- Kartu status pengajuan -->
      <section class="kartu">
        <div class="kartu-atas">
          <span class="info">[NIM] &middot; Diajukan [TANGGAL]</span>
          <span class="badge">KTM Siap Diambil</span>
        </div>

        <!-- Stepper 4 tahap -->
        <div class="stepper">
          <div class="tahap"><div class="garis"></div><strong>Diajukan</strong><small>Selesai</small></div>
          <div class="tahap"><div class="garis"></div><strong>Sedang Diverifikasi</strong><small>Selesai</small></div>
          <div class="tahap"><div class="garis"></div><strong>Disetujui</strong><small>Selesai</small></div>
          <div class="tahap"><div class="garis"></div><strong>KTM Siap Diambil</strong><small>Selesai</small></div>
        </div>

        <!-- Kotak lokasi, jadwal, keterangan -->
        <div class="kotak">
          <h3>KTM kamu sudah bisa diambil</h3>
          <dl>
            <dt>Lokasi</dt><dd>[Lokasi pengambilan]</dd>
            <dt>Jadwal</dt><dd>[Hari dan jam layanan]</dd>
            <dt>Keterangan</dt><dd>[Keterangan tambahan]</dd>
          </dl>
        </div>
      </section>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <div class="wadah footer-isi">
      <div>
        <h4>KEMAHASISWAAN<br>UNIVERSITAS BRAWIJAYA</h4>
        <p>SiKTM adalah sistem informasi pengajuan dan pemantauan Kartu Tanda Mahasiswa Universitas Brawijaya. Layanan ini dikelola oleh Kemahasiswaan untuk memudahkan mahasiswa mengurus KTM secara cepat, jelas, dan transparan.</p>
      </div>
      <div>
        <h5>NAVIGASI</h5>
        <ul>
          <li><a href="#">Beranda</a></li>
          <li><a href="#">Riwayat</a></li>
          <li><a href="#">Bantuan</a></li>
          <li><a href="#">Kontak Kemahasiswaan</a></li>
        </ul>
      </div>
      <div>
        <h5>LEGAL</h5>
        <ul>
          <li><a href="#">Kebijakan Privasi</a></li>
          <li><a href="#">Ketentuan Layanan</a></li>
        </ul>
      </div>
    </div>
  </footer>
</body>
</html>