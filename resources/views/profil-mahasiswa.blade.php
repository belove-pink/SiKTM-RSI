<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Profil Mahasiswa - SiKTM</title>
  <link rel='preconnect' href='https://fonts.googleapis.com'>
  <link href='https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap' rel='stylesheet'>
  <style>
    * { box-sizing: border-box; }
    body { margin: 0; font-family: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif; background: #dce8f8; color: #13305a; min-height: 100vh; display: flex; flex-direction: column; }
    .judul { font-family: 'Bricolage Grotesque', 'Plus Jakarta Sans', Arial, sans-serif; }

    /* Navbar */
    .nav { height: 66px; padding: 0 max(2.5%, calc((100% - 1200px) / 2 + 37px)); background: #13305a; color: #fff; }
    .nav-isi { height: 100%; display: flex; align-items: center; justify-content: space-between; }
    .nav .kiri { display: flex; align-items: center; gap: 12px; font-size: 13px; font-weight: 500; letter-spacing: .2px; }
    .nav .kiri img { width: 33px; height: 33px; object-fit: contain; }
    .nav .kiri b { font-family: 'Bricolage Grotesque', 'Plus Jakarta Sans', Arial, sans-serif; font-size: 21px; font-weight: 800; letter-spacing: -.4px; }
    .nav .kiri b span { color: #f2aa00; }
    .nav .kanan { display: flex; align-items: stretch; gap: 45px; height: 100%; }
    .nav .kanan a { display: flex; align-items: center; padding: 3px 0 0; color: #fff; text-decoration: none; font-size: 13px; font-weight: 500; border-bottom: 3px solid transparent; transition: .2s; }
    .nav .kanan a:hover, .nav .kanan a.aktif { border-bottom-color: #f2aa00; }

    /* Konten */
    main { flex: 1; width: 100%; max-width: 1000px; margin: 0 auto; padding: 40px 24px 64px; }
    h1 { margin: 0 0 6px; font-size: 38px; font-weight: 800; }
    .ket { margin: 0 0 24px; font-size: 14px; font-weight: 500; color: #4a5d7a; }
    .layout { display: grid; grid-template-columns: 1.6fr 1fr; gap: 24px; align-items: start; }
    .card { background: #fff; border-radius: 26px; padding: 24px; }

    /* Kartu profil */
    .atas { display: flex; align-items: center; gap: 20px; padding-bottom: 22px; border-bottom: 2px solid #dce8f8; }
    .foto { width: 82px; height: 104px; border-radius: 14px; background: #dce8f8; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; overflow: hidden; flex-shrink: 0; }
    .foto img { width: 100%; height: 100%; object-fit: cover; }
    .atas h2 { margin: 0 0 6px; font-size: 26px; font-weight: 800; text-transform: uppercase; }
    .atas .nim { margin: 0 0 8px; font-size: 14px; color: #4a5d7a; font-weight: 500; }
    .badge { display: inline-block; padding: 4px 16px; border-radius: 20px; background: #d4efe3; color: #1f8a5b; font-size: 12px; font-weight: 700; }
    .baris { display: flex; justify-content: space-between; gap: 16px; padding: 16px 0; border-bottom: 1px solid #dce8f8; font-size: 14px; }
    .baris:last-child { border-bottom: none; padding-bottom: 4px; }
    .baris span { font-weight: 500; color: #4a5d7a; }
    .baris b { font-weight: 800; text-align: right; }

    /* Pratinjau KTM */
    .kartu-card { padding: 12px; }
    .ktm { position: relative; aspect-ratio: 1700 / 1100; overflow: hidden; border-radius: 16px; color: #fff;
    background: linear-gradient(135deg, #0b4a7a 0%, #0a3d6e 55%, #0b3b6c 100%); }
    .ktm-atas { position: absolute; top: 6%; left: 5%; right: 3%; display: flex; justify-content: space-between; align-items: flex-start; }
    .ktm-logo { display: flex; align-items: center; gap: 2.5%; }
    .ktm-logo img { width: 12%; min-width: 26px; }
    .ktm-univ small { display: block; font-family: 'IM Fell French Canon SC', serif; font-size: 10px; letter-spacing: 3px; }
    .ktm-univ strong { font-family: 'IM FELL French Canon', serif; font-size: 19px; font-weight: 500; line-height: 1; }
    .ktm-ket { max-width: 48%; text-align: right; font-size: 5px; line-height: 1.4; }
    .ktm-ket b { display: block; font-size: 7px; }
    .ktm-isi { position: absolute; top: 27%; left: 6%; right: 6%; display: flex; gap: 6%; }
    .ktm-foto { width: 21%; aspect-ratio: 360 / 480; background: #fff; flex-shrink: 0; overflow: hidden; }
    .ktm-foto img { width: 100%; height: 100%; object-fit: cover; }
    .ktm-data { padding-top: 3%; font-size: 8px; line-height: 1.5; }
    .ktm-data b { display: block; font-weight: 700; }
    .ktm-nim { font-size: 11px; margin-bottom: 2px; }
    .ktm-garis { position: absolute; left: 0; right: 0; bottom: 0; height: 2.5%; background: #ee8b1f; }

    /* Keamanan akun */
    .aman { margin-top: 12px; }
    .aman h3 { margin: 0 0 8px; font-size: 20px; font-weight: 800; }
    .aman p { margin: 0 0 18px; font-size: 13px; line-height: 1.5; color: #4a5d7a; font-weight: 500; }
    .btn-ubah { display: block; width: 100%; padding: 12px; border: 2px solid #13305a; border-radius: 12px; background: #fff; color: #13305a; text-align: center; text-decoration: none; font-family: inherit; font-size: 14px; font-weight: 700; cursor: pointer; }
    .keluar { text-align: center; margin-top: 16px; }
    .keluar button { border: none; background: none; color: #b3261e; font-family: inherit; font-size: 13px; font-weight: 700; cursor: pointer; }

    /* Footer */
    footer { padding: 60px max(7.2%, calc((100% - 1200px) / 2 + 87px)) 68px; background: #13305a; color: #fff; }
    .footer-isi { display: grid; grid-template-columns: 1fr 180px 120px; gap: 40px; align-items: start; }
    footer h2 { margin: 0 0 22px; font-size: 24px; line-height: 1.3; font-weight: 600; }
    footer p { max-width: 420px; margin: 0; color: #dce8f8; font-size: 12px; line-height: 1.7; font-weight: 500; }
    footer .kolom { display: contents; }
    footer .kolom h4 { margin: 6px 0 14px; font-size: 12px; font-weight: 700; letter-spacing: .4px; }
    footer .kolom a { display: block; margin-bottom: 9px; color: #dce8f8; font-size: 12px; text-decoration: underline; font-weight: 500; }

    @media (max-width: 900px) {
      .layout { grid-template-columns: 1fr; }
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
        <a href="{{ url('/profil-mahasiswa') }}" class='aktif'>{{ $namaMahasiswa ?? 'Mahasiswa' }}</a>
      </nav>
    </div>
  </header>

  <main>
    <h1 class='judul'>Profil mahasiswa</h1>
    <p class='ket'>Data ini diambil dari sistem akademik. Hubungi fakultas jika ada yang keliru.</p>

    <div class='layout'>
      <!-- Data profil -->
      <section class='card'>
        <div class='atas'>
          <div class='foto'>
            @if (!empty($foto)) <img src='{{ $foto }}' alt='Foto'> @else [FOTO] @endif
          </div>
          <div>
            <h2 class='judul'>{{ $namaMahasiswa ?? '[NAMA MAHASISWA]' }}</h2>
            <p class='nim'>{{ $nim ?? '[NIM]' }}</p>
            <span class='badge'>{{ $statusAkun ?? 'Aktif' }}</span>
          </div>
        </div>
        <div class='baris'><span>Program studi</span><b>{{ $prodi ?? '[PROGRAM STUDI]' }}</b></div>
        <div class='baris'><span>Fakultas</span><b>{{ $fakultas ?? '[FAKULTAS]' }}</b></div>
        <div class='baris'><span>Angkatan</span><b>{{ $angkatan ?? '[ANGKATAN]' }}</b></div>
        <div class='baris'><span>Email UB</span><b>{{ $emailUb ?? '[EMAIL UB]' }}</b></div>
        <div class='baris'><span>Nomor telepon</span><b>{{ $telepon ?? '[NOMOR TELEPON]' }}</b></div>
      </section>

      <!-- Kolom kanan -->
      <aside>
        <div class='card kartu-card'>
  <div class='ktm'>
    <div class='ktm-atas'>
      <div class='ktm-logo'>
        <img src='{{ asset("images/logo-ub.png") }}' alt='Logo UB'>
        <div class='ktm-univ'><small>UNIVERSITAS</small><strong>BRAWIJAYA</strong></div>
      </div>
      <div class='ktm-ket'>
        <b>KARTU IDENTITAS DIGITAL</b>
        <span>Identitas digital sivitas akademika Universitas Brawijaya untuk penggunaan di lingkungan kampus.</span>
      </div>
    </div>

    <div class='ktm-isi'>
      <div class='ktm-foto'>
        @if (!empty($foto)) <img src='{{ $foto }}' alt='Foto'> @endif
      </div>
      <div class='ktm-data'>
        <b class='ktm-nim'>NIM {{ $nim ?? '000000000000000' }}</b>
        <b>{{ $namaMahasiswa ?? 'NAMA MAHASISWA' }}</b>
        <b>{{ $fakultas ?? 'Fakultas' }}</b>
        <b>{{ $prodi ?? 'Program Studi' }}</b>
      </div>
    </div>

    <div class='ktm-garis'></div>
  </div>
</div>

        <div class='card aman'>
          <h3 class='judul'>Keamanan akun</h3>
          <p>Ganti kata sandi SSO secara berkala dan jangan bagikan ke siapa pun.</p>
          <a href='#' class='btn-ubah'>Ubah kata sandi</a>
          <form class='keluar' method='POST' action='/keluar'>
            @csrf
            <button type='submit'>Keluar dari akun</button>
          </form>
        </div>
      </aside>
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
          <a href='#'>Kontak Kemahasiswaan</a>
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