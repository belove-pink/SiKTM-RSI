<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Ajukan KTM - SiKTM</title>
  <link rel='preconnect' href='https://fonts.googleapis.com'>
  <link href='https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap' rel='stylesheet'>
  <style>
    * { box-sizing: border-box; }
    body { margin: 0; font-family: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif; background: #dce8f8; color: #13305a; min-height: 100vh; display: flex; flex-direction: column; }
    
    /* Wajib */
    .wajib::after { content: ' *'; color: #d93025; font-weight: 800; }

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
    h1 { margin: 0 0 20px; font-family: 'Bricolage Grotesque', 'Plus Jakarta Sans', Arial, sans-serif; font-size: 40px; font-weight: 800; }
    .form-card { background: #fff; border: 1px solid #13305a; border-radius: 28px; padding: 28px 32px 32px; }
    h3 { margin: 0 0 12px; font-size: 16px; font-weight: 800; }
    .sub { margin: -8px 0 14px; font-size: 13px; font-weight: 500; color: #000; }
    .blok { margin-bottom: 26px; }
    .error { margin-bottom: 14px; padding: 10px 14px; background: #fbdcdc; color: #a12a2a; border-radius: 10px; font-size: 13px; font-weight: 600; }

    /* Pilihan alasan */
    .alasan { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
    .alasan label { display: flex; align-items: center; gap: 10px; padding: 10px 14px; border: 1px solid #13305a; border-radius: 10px; font-size: 14px; font-weight: 700; cursor: pointer; }
    .alasan input { accent-color: #13305a; }

    /* Grid isian */
    .grid2 select { width: 100%; height: 36px; padding: 0 12px; border: 1px solid #13305a; border-radius: 8px; background: #fff; font-family: inherit; font-size: 14px; color: #13305a; }
    .grid2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px 28px; }
    .grid2 label { display: block; margin-bottom: 6px; font-size: 13px; font-weight: 800; text-transform: uppercase; }
    .grid2 input[type=text] { width: 100%; height: 36px; padding: 0 12px; border: 1px solid #13305a; border-radius: 8px; background: #fff; font-family: inherit; font-size: 14px; color: #13305a; }
    .grid2 input[readonly] { background: #f3f6fb; }

    /* Dokumen */
    .dok label { display: block; margin-bottom: 6px; font-size: 13px; font-weight: 800; }
    .dok small { display: block; margin-bottom: 6px; font-size: 13px; font-weight: 500; color: #000; }
    .dok input[type=file] { width: 100%; min-height: 70px; padding: 12px; border: 1px solid #13305a; border-radius: 8px; background: #fff; font-family: inherit; font-size: 13px; }

    .aksi { display: flex; justify-content: flex-end; }
    .aksi button { height: 40px; padding: 0 56px; border: 1px solid #13305a; border-radius: 10px; background: #f2aa00; color: #13305a; font-family: inherit; font-size: 14px; font-weight: 700; cursor: pointer; }

    /* Footer */
    footer { padding: 60px max(7.2%, calc((100% - 1200px) / 2 + 87px)) 68px; background: #13305a; color: #fff; }
    .footer-isi { display: grid; grid-template-columns: 1fr 180px 120px; gap: 40px; align-items: start; }
    footer h2 { margin: 0 0 22px; font-size: 24px; line-height: 1.3; font-weight: 600; }
    footer p { max-width: 420px; margin: 0; color: #dce8f8; font-size: 12px; line-height: 1.7; font-weight: 500; }
    footer .kolom { display: contents; }
    footer .kolom h4 { margin: 6px 0 14px; font-size: 12px; font-weight: 700; letter-spacing: .4px; }
    footer .kolom a { display: block; margin-bottom: 9px; color: #dce8f8; font-size: 12px; text-decoration: underline; font-weight: 500; }

    @media (max-width: 900px) {
      .alasan, .grid2 { grid-template-columns: 1fr; }
      footer { padding: 40px 7%; }
      .footer-isi { grid-template-columns: 1fr 1fr; gap: 28px; }
      .footer-isi > div:first-child { grid-column: 1 / -1; }
    }
    .grid2 input[list] {
    background: #fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='8'><path d='M1 1l5 5 5-5' fill='none' stroke='%2313305a' stroke-width='2'/></svg>") no-repeat right 12px center;
    padding-right: 34px;
    }
    .grid2 input[list]::-webkit-calendar-picker-indicator { opacity: 0; position: absolute; right: 0; width: 34px; height: 100%; cursor: pointer; }
    .grid2 div { position: relative; }

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
        <a href="{{ url('/beranda-mahasiswa') }}" class='aktif'>Beranda</a>
        <a href="{{ url('/riwayat-pengajuan') }}">Riwayat</a>
        <a href="{{ url('/bantuan') }}">Bantuan</a>
        <a href="{{ url('/profil-mahasiswa') }}">{{ $namaMahasiswa ?: ($namaLogin ?? 'Profil') }}</a>
      </nav>
    </div>
  </header>

  <main>
    <h1>Ajukan KTM</h1>

    @if (session('error'))
      <div class='error'>{{ session('error') }}</div>
    @endif

    @if ($errors->any())
      <div class='error'>
        @foreach ($errors->all() as $pesan)
          <div>{{ $pesan }}</div>
        @endforeach
      </div>
    @endif

    <form class='form-card' method='POST' action='/ajukan-ktm' enctype='multipart/form-data'>
      @csrf

      <!-- Alasan pengajuan -->
      <div class='blok'>
        <h3>Alasan Pengajuan KTM</h3>
        <div class='alasan'>
          <label><input type='radio' name='alasan' value='KTM Baru' checked> Pengajuan KTM Baru</label>
          <label><input type='radio' name='alasan' value='KTM Hilang'> Pengajuan KTM Hilang</label>
          <label><input type='radio' name='alasan' value='KTM Rusak'> Pengajuan KTM Rusak</label>
        </div>
      </div>

      <!-- Data diri -->
      <div class='blok'>
        <h3>Data Diri</h3>
        <p class='sub'>Mohon mengisi data diri secara lengkap dan sesuai</p>
        <div class='grid2'>
        <div><label for='nim' class='wajib'>NIM</label><input type='text' id='nim' name='nim' value='{{ $nim ?? "" }}' placeholder='Masukkan NIM' required></div>
        <div><label for='nama' class='wajib'>Nama Mahasiswa</label><input type='text' id='nama' name='nama' value='{{ $namaMahasiswa ?? "" }}' placeholder='Masukkan nama mahasiswa' required></div>
        <div><label for='fakultas' class='wajib'>Fakultas</label>
            <select id='fakultas' name='fakultas' required>
            <option value=''>Pilih fakultas</option>
            @foreach (($daftarFakultas ?? []) as $f)
            <option value='{{ $f->namaFakultas }}' {{ ($fakultas ?? '') == $f->namaFakultas ? 'selected' : '' }}>{{ $f->namaFakultas }}</option>
            @endforeach
        </select>
        </div>
        <div><label for='prodi' class='wajib'>Program Studi</label><input type='text' id='prodi' name='prodi' value='{{ $prodi ?? "" }}' placeholder='Masukkan program studi' required></div>
        </div>
      </div>

      <!-- Dokumen -->
      <div class='blok grid2 dok'>
        <div>
          <h3>Dokumen Persyaratan</h3>
          <label for='pasfoto' class='wajib'>PAS FOTO (3X4)</label>
          <input type='file' id='pasfoto' name='pasFoto' accept='image/*' required>
        </div>
        <div>
          <h3>Dokumen Pendukung (optional)</h3>
          <small>Surat Kehilangan (khusus pengajuan pembuatan KTM hilang)</small>
          <input type='file' id='surat' name='suratKehilangan' accept='image/*,.pdf'>
        </div>
      </div>

      <div class='aksi'><button type='submit'>Kirim</button></div>
    </form>
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