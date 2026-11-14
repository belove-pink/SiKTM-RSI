<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SiKTM</title>
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
      --hijau-latar: #d5efe6;
      --merah: #b3261e;
      --merah-latar: #fdecea;
      --font-teks: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif;
      --font-judul: 'Bricolage Grotesque', 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif;
    }
    * { box-sizing: border-box; }
    body { margin: 0; font-family: var(--font-teks); color: #000; background: var(--latar); }

    /* Susunan halaman: panel kiri (branding) dan panel kanan (form) */
    .halaman { display: grid; grid-template-columns: 1fr 1fr; min-height: 100vh; }

    /* Panel kiri */
    .kiri { position: relative; background: var(--navy); color: #fff; overflow: hidden; min-height: 100vh; }
    .univ { position: absolute; top: 49px; left: 42px; font-family: var(--font-judul); display: flex; align-items: center; gap: 12px; font-size: 19px; font-weight: 500; }
    .univ img { height: 42px; width: auto; }
    .lingkaran { position: absolute; top: 50%; left: -278px; width: 522px; height: 522px; border: 2px solid var(--kuning); border-radius: 50%; transform: translateY(-58%); }
    .brand { position: absolute; top: 48%; left: 50%; transform: translate(-50%, -50%); text-align: center; white-space: nowrap; }
    .brand h1 { margin: 0; font-family: var(--font-judul); font-size: 64px; font-weight: 800; line-height: 1; }
    .brand h1 span { color: var(--kuning); }
    .brand p { margin: 6px 0 0; font-size: 19px; font-weight: 500; }
    .garis { position: absolute; left: 53px; bottom: 45px; width: 260px; height: 10px; background: var(--kuning); }

    /* Panel kanan */
    .kanan { display: flex; align-items: center; justify-content: center; padding: 40px 24px; }
    .card { width: 100%; max-width: 545px; padding: 70px 52px 72px; background: #fff; border-radius: 33px; }
    .card h2 { margin: 0 0 32px; font-family: var(--font-judul); font-size: 39px; line-height: 1; font-weight: 800; color: var(--navy); }

    /* Pesan berhasil (UI-03) dan gagal (UI-02) */
    .alert { margin: 0 0 24px; padding: 18px 22px; border-radius: 16px; font-size: 18px; font-weight: 600; line-height: 1.35; }
    .sukses { background: var(--hijau-latar); color: var(--hijau); }
    .gagal { background: var(--merah-latar); color: var(--merah); }

    label { display: block; margin: 0 0 11px; font-size: 20px; line-height: 1.2; font-weight: 700; }
    .jarak { margin-top: 42px; }
    select, input { display: block; width: 100%; height: 62px; padding: 0 23px; border: 1px solid var(--navy); border-radius: 18px; font-family: inherit; font-size: 20px; color: #000; background: #fff; }
    input::placeholder { color: #7a7a7a; }
    select:focus, input:focus { outline: 2px solid var(--kuning); outline-offset: 1px; }
    .valid input { border-color: #2d8b70; }
    .invalid input { border-color: #d93025; }
    button { display: block; width: 100%; height: 62px; border-radius: 18px; font-family: inherit; font-size: 20px; font-weight: 700; color: #000; cursor: pointer; }
    .masuk { margin-top: 46px; border: none; background: var(--kuning); }
    .masuk:hover { filter: brightness(0.95); }
    .sso { margin-top: 14px; border: 3px solid var(--navy); background: #fff; }
    .sso:hover { background: #f3f7fd; }

    /* Layar kecil: panel kiri disembunyikan dan form memenuhi layar */
    @media (max-width: 900px) {
      .halaman { grid-template-columns: 1fr; }
      .kiri { display: none; }
      .kanan { padding: 24px 16px; }
      .card { padding: 40px 24px 44px; border-radius: 24px; }
    }
  </style>
</head>
<body>
  <div class="halaman">
    <!-- Panel kiri: identitas aplikasi -->
    <div class="kiri">
      <div class="univ">
        <img src="{{ asset('images/logo-ub.png') }}" alt="Logo UB">
        <span>UNIVERSITAS BRAWIJAYA</span>
      </div>
      <div class="lingkaran"></div>
      <div class="brand">
        <h1>Si<span>KTM</span></h1>
        <p>Sistem Layanan Kartu Tanda Mahasiswa</p>
      </div>
      <div class="garis"></div>
    </div>

    <!-- Panel kanan: form login -->
    <div class="kanan">
      <div class="card">
        <h2>Masuk</h2>

        <!-- Pesan berhasil (UI-03) -->
        @if (session('success'))
          <div class="alert sukses">{{ session('success') }}</div>
        @endif

        <!-- Pesan gagal (UI-02) -->
        @if (session('error'))
          <div class="alert gagal">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/login" class="{{ session('success') ? 'valid' : (session('error') ? 'invalid' : '') }}">
          @csrf
          <!-- Dropdown masuk sebagai / angkatan (angkatan mahasiswa dipetakan ke peran Mahasiswa) -->
          <label for="peran">Masuk sebagai/Angkatan</label>
          <select id="peran" name="peran">
            <option value="Mahasiswa">2026</option>
            <option value="Mahasiswa">2025</option>
            <option value="Mahasiswa">2024</option>
            <option value="AdminFakultas">Admin Fakultas</option>
            <option value="AdminRektorat">Admin Rektorat</option>
          </select>

          <!-- Field identitas akun -->
          <label for="nim" class="jarak">NIM/Email</label>
          <input type="text" id="nim" name="nim" placeholder="NIM">

          <!-- Field kata sandi -->
          <label for="kataSandi" class="jarak">Kata Sandi</label>
          <input type="password" id="kataSandi" name="kataSandi" placeholder="Kata Sandi">

          <button type="submit" class="masuk">Masuk</button>
        </form>
        <button type="button" class="sso">Masuk dengan SSO kampus</button>
      </div>
    </div>
  </div>
</body>
</html>