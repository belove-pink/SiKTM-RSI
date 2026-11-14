<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SiKTM</title>

  <!-- Setelah login berhasil (UI-03), arahkan otomatis ke halaman tujuan setelah 2 detik -->
  @if (session('arahkan'))
    <meta http-equiv="refresh" content="2;url={{ url(session('arahkan')) }}">
  @endif

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
    body { margin: 0; font-family: var(--font-teks); font-size: 16px; color: #111; background: var(--latar); }

    /* Susunan halaman: panel kiri (branding) dan panel kanan (form) */
    .halaman { display: grid; grid-template-columns: 1fr 1fr; min-height: 100vh; }

    /* Panel kiri */
    .kiri { position: relative; background: var(--navy); color: #fff; overflow: hidden; }
    .univ { position: absolute; top: 28px; left: 32px; display: flex; align-items: center; gap: 10px; font-family: var(--font-judul); font-size: 16px; font-weight: 600; }
    .univ img { height: 36px; width: auto; }
    .lingkaran { position: absolute; top: 50%; left: -230px; width: 440px; height: 440px; border: 2px solid var(--kuning); border-radius: 50%; transform: translateY(-55%); }
    .brand { position: absolute; top: 47%; left: 50%; transform: translate(-50%, -50%); text-align: center; white-space: nowrap; }
    .brand h1 { margin: 0; font-family: var(--font-judul); font-size: 52px; font-weight: 800; line-height: 1; }
    .brand h1 span { color: var(--kuning); }
    .brand p { margin: 6px 0 0; font-size: 15px; font-weight: 500; }
    .garis { position: absolute; left: 32px; bottom: 32px; width: 200px; height: 8px; background: var(--kuning); }

    /* Panel kanan */
    .kanan { display: flex; align-items: center; justify-content: center; padding: 32px 24px; }
    .card { width: 100%; max-width: 440px; padding: 44px 40px 40px; background: #fff; border-radius: 24px; }
    .card h2 { margin: 0 0 22px; font-family: var(--font-judul); font-size: 30px; line-height: 1.1; font-weight: 800; color: var(--navy); }

    /* Pesan berhasil (UI-03) dan gagal (UI-02) */
    .alert { margin: 0 0 18px; padding: 12px 16px; border-radius: 12px; font-size: 14px; font-weight: 600; line-height: 1.4; }
    .sukses { background: var(--hijau-latar); color: var(--hijau); }
    .gagal { background: var(--merah-latar); color: var(--merah); }

    label { display: block; margin: 0 0 8px; font-size: 14px; line-height: 1.2; font-weight: 700; }
    .jarak { margin-top: 18px; }
    select, input { display: block; width: 100%; height: 46px; padding: 0 16px; border: 1px solid var(--navy); border-radius: 12px; font-family: inherit; font-size: 15px; color: #111; background: #fff; }
    input::placeholder { color: #8a8a8a; }
    select:focus, input:focus { outline: 2px solid var(--kuning); outline-offset: 1px; }
    .valid input { border-color: #2d8b70; }
    .invalid input { border-color: #d93025; }
    button { display: block; width: 100%; height: 46px; border-radius: 12px; font-family: inherit; font-size: 15px; font-weight: 700; color: #111; cursor: pointer; }
    .masuk { margin-top: 26px; border: none; background: var(--kuning); }
    .masuk:hover { filter: brightness(0.95); }
    .sso { margin-top: 10px; border: 2px solid var(--navy); background: #fff; }
    .sso:hover { background: #f3f7fd; }

    /* Layar kecil: panel kiri disembunyikan dan form memenuhi layar */
    @media (max-width: 900px) {
      .halaman { grid-template-columns: 1fr; }
      .kiri { display: none; }
      .kanan { padding: 20px 16px; }
      .card { padding: 32px 22px 30px; }
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
          <!-- Dropdown masuk sebagai / angkatan (angkatan 2024 sampai 2026 berarti peran Mahasiswa) -->
          <label for="peran">Masuk sebagai/Angkatan</label>
          <select id="peran" name="peran">
            <option value="2026" {{ old('peran') == '2026' ? 'selected' : '' }}>2026</option>
            <option value="2025" {{ old('peran') == '2025' ? 'selected' : '' }}>2025</option>
            <option value="2024" {{ old('peran') == '2024' ? 'selected' : '' }}>2024</option>
            <option value="AdminFakultas" {{ old('peran') == 'AdminFakultas' ? 'selected' : '' }}>Admin Fakultas</option>
            <option value="AdminRektorat" {{ old('peran') == 'AdminRektorat' ? 'selected' : '' }}>Admin Rektorat</option>
          </select>

          <!-- Field identitas akun (disamarkan saat login berhasil) -->
          <label for="nim" class="jarak">NIM/Email</label>
          <input type="text" id="nim" name="nim" placeholder="NIM"
                 value="{{ session('success') ? \Illuminate\Support\Str::mask(old('nim'), '*', 3) : old('nim') }}">

          <!-- Field kata sandi -->
          <label for="kataSandi" class="jarak">Kata Sandi</label>
          <input type="password" id="kataSandi" name="kataSandi" placeholder="Kata Sandi"
                 value="{{ session('success') ? '********' : '' }}">

          <button type="submit" class="masuk">Masuk</button>
        </form>
        <button type="button" class="sso">Masuk dengan SSO kampus</button>
      </div>
    </div>
  </div>
</body>
</html>