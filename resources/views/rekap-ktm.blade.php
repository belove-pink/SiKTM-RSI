<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Rekapitulasi KTM - SiKTM</title>
  <link rel='preconnect' href='https://fonts.googleapis.com'>
  <link href='https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap' rel='stylesheet'>
  <style>
    * { box-sizing: border-box; }
    body { zoom: 0.85; margin: 0; font-family: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif; background: #dce8f8; color: #13305a; min-height: 100vh; display: flex; flex-direction: column; }

    /* Navbar */
    .nav { background: #13305a; color: #fff; padding: 0 24px; height: 68px; }
    .nav-isi { max-width: 990px; height: 100%; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; }
    .nav .kiri { display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 500; }
    .nav .kiri img { height: 28px; }
    .nav .kiri b { font-family: 'Bricolage Grotesque', 'Plus Jakarta Sans', Arial, sans-serif; font-size: 22px; font-weight: 800; }
    .nav .kiri b span { color: #f2aa00; }
    .nav .kiri > span { font-weight: 400; }
    .nav .kanan { display: flex; gap: 32px; font-size: 13px; font-weight: 500; }
    .nav .kanan a { color: #fff; text-decoration: none; padding: 4px 8px; }
    .nav .kanan a.aktif { border-bottom: 2px solid #f2aa00; }

    /* Konten */
    main { flex: 1; width: 100%; max-width: 990px; margin: 0 auto; padding: 48px 24px 72px; }
    h1 { margin: 0 0 14px; font-family: 'Bricolage Grotesque', 'Plus Jakarta Sans', Arial, sans-serif; font-size: 45px; font-weight: 800; }
    .petunjuk { margin: 0 0 14px; font-size: 16px; font-weight: 500; color: #000; }

    /* Form cari dan filter */
    .cari { display: flex; gap: 12px; max-width: 760px; margin-bottom: 14px; }
    .cari input { flex: 1; height: 38px; padding: 0 16px; border: 1px solid #13305a; border-radius: 19px; background: #fff; font-family: inherit; font-size: 15px; }
    .cari button { height: 38px; padding: 0 28px; border: none; border-radius: 19px; background: #f2aa00; color: #13305a; font-family: inherit; font-size: 14px; font-weight: 700; cursor: pointer; }
    .filter { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 28px; }
    .filter select { height: 36px; min-width: 170px; padding: 0 14px; border: 1px solid #13305a; border-radius: 18px; background: #fff; font-family: inherit; font-size: 14px; color: #13305a; }
    .error { max-width: 760px; margin-bottom: 14px; padding: 10px 14px; background: #fbdcdc; color: #a12a2a; border-radius: 10px; font-size: 14px; font-weight: 600; }

    /* Kartu ringkasan */
    .kartu { display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px; margin-bottom: 40px; }
    .angka { min-height: 170px; padding: 28px 28px 26px; border: 1px solid #13305a; border-radius: 16px; display: flex; flex-direction: column; justify-content: space-between; }
    .angka strong { font-family: 'Bricolage Grotesque', 'Plus Jakarta Sans', Arial, sans-serif; font-size: 45px; font-weight: 800; line-height: 1; }
    .angka span { font-size: 19px; font-weight: 800; }
    .k-belum { background: #fff; }
    .k-proses { background: #edb93c; }
    .k-sudah { background: #d4efe3; }

    /* Tabel */
    .tabel { background: #fff; border-radius: 28px; padding: 22px 28px 30px; overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; font-size: 16px; }
    th { padding: 14px 12px 16px; text-align: left; font-weight: 600; border-bottom: 1px solid #dce8f8; }
    td { padding: 22px 12px; font-weight: 500; border-bottom: 1px solid #dce8f8; }
    .aksi { color: #13305a; font-weight: 600; text-decoration: none; }
    
    /* Footer */
    footer { background: #13305a; color: #fff; padding: 72px 24px 84px; }
    .footer-isi { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; gap: 40px; flex-wrap: wrap; }
    footer h2 { margin: 0 0 25px; font-size: 24px; font-weight: 600; line-height: 1.3; }
    footer p { margin: 0; max-width: 350px; font-size: 12px; line-height: 1.6; font-weight: 400; }
    footer .kolom { display: flex; gap: 110px; font-size: 12px; }
    footer .kolom h4 { margin: 0 0 16px; font-size: 13px; font-weight: 700; }
    footer .kolom a { display: block; margin-bottom: 12px; color: #fff; text-decoration: underline; font-weight: 500; }
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
        <a href='#' class='aktif'>Beranda</a>
        <a href='#'>Riwayat</a>
        <a href='#'>Bantuan</a>
        <a href='#'>{{ $namaAdmin ?? 'NAMA ADMIN' }}</a>
      </nav>
    </div>
  </header>

  <main>
    <h1>Rekapitulasi KTM</h1>
    <p class='petunjuk'>Mohon untuk memasukkan NIM yang sesuai</p>

    @if (session('error'))
      <div class='error'>{{ session('error') }}</div>
    @endif

    <!-- Pencarian NIM dan filter dalam satu form -->
    <form method='GET' action='/rekap-ktm'>
      <div class='cari'>
        <input type='text' name='kataKunci' placeholder='NIM' value='{{ request("kataKunci") }}'>
        <button type='submit'>Cek</button>
      </div>
      <div class='filter'>
        <select name='prodi' onchange='this.form.submit()'>
          <option value=''>Semua Prodi</option>
          @foreach (($daftarProdi ?? []) as $p)
            <option value='{{ $p->idProdi }}' {{ request('prodi') == $p->idProdi ? 'selected' : '' }}>{{ $p->namaProdi }}</option>
          @endforeach
        </select>
        <select name='angkatan' onchange='this.form.submit()'>
          <option value=''>Semua Angkatan</option>
          @foreach ([2026, 2025, 2024, 2023] as $a)
            <option value='{{ $a }}' {{ request('angkatan') == $a ? 'selected' : '' }}>{{ $a }}</option>
          @endforeach
        </select>
        <select name='status' onchange='this.form.submit()'>
          <option value=''>Semua Status</option>
          @foreach (['Belum Mengajukan', 'Sedang Diproses', 'Sudah Memiliki KTM'] as $s)
            <option value='{{ $s }}' {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
          @endforeach
        </select>
      </div>
    </form>

    <!-- Tiga kartu ringkasan -->
    <div class='kartu'>
      <div class='angka k-belum'><strong>{{ $belum ?? 0 }}</strong><span>Belum Mengajukan</span></div>
      <div class='angka k-proses'><strong>{{ $proses ?? 0 }}</strong><span>Sedang Diproses</span></div>
      <div class='angka k-sudah'><strong>{{ $sudah ?? 0 }}</strong><span>Sudah Memiliki KTM</span></div>
    </div>

    <!-- Tabel rekap mahasiswa -->
    <div class='tabel'>
      <table>
        <tr><th>NIM</th><th>Prodi</th><th>Status</th><th>Aksi</th></tr>
        @foreach (($daftar ?? []) as $baris)
          <tr>
            <td>{{ $baris['nim'] }}</td>
            <td>{{ $baris['prodi'] }}</td>
            <td>{{ $baris['status'] }}</td>
            <td>
              @if ($baris['status'] === 'Sudah Memiliki KTM')
                <a href='#' class='aksi'>Lihat</a>
              @elseif ($baris['status'] === 'Sedang Diproses')
                <a href='#' class='aksi'>Periksa</a>
              @else
                -
              @endif
            </td>
          </tr>
        @endforeach
      </table>
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
    </div>
  </footer>
</body>
</html>