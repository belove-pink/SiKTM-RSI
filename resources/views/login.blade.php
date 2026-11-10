<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Login - SiKTM</title>
  <link rel='preconnect' href='https://fonts.googleapis.com'>
  <link href='https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap' rel='stylesheet'>
  <style>
    /* Ukuran memakai rem mengikuti frame Figma 1440 x 1024, diskalakan agar seluruh desain muat di layar */
    html { font-size: min(calc(100vw / 90), calc(100vh / 64)); }
    * { box-sizing: border-box; }
    body { margin: 0; font-family: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif; background: #dce8f8; }

    /* Susunan halaman: panel kiri (branding) dan panel kanan (form) */
    .halaman { display: flex; width: 100%; height: 100vh; overflow: hidden; }

    /* Panel kiri */
    .kiri { position: relative; flex: 1; background: #13305a; color: #fff; overflow: hidden; }
    .univ { position: absolute; top: 3.06rem; left: 2.6rem; display: flex; align-items: center; gap: 0.6rem; font-size: 1.19rem; font-weight: 500; }
    .univ img { height: 2.6rem; }
    .lingkaran { position: absolute; top: calc(50% - 1.9rem); left: -17.4rem; width: 32.6rem; height: 32.6rem; border: 0.15rem solid #f2aa00; border-radius: 50%; transform: translateY(-50%); }
    .brand { position: absolute; top: calc(50% - 0.5rem); left: 46%; transform: translate(-50%, -50%); text-align: center; white-space: nowrap; }
    .brand h1 { margin: 0; font-size: 4rem; font-weight: 800; line-height: 1; }
    .brand h1 span { color: #f2aa00; }
    .brand p { margin: 0.3rem 0 0; font-size: 1.2rem; font-weight: 500; }
    .garis { position: absolute; left: 3.3rem; bottom: 2.8rem; width: 16.25rem; height: 0.7rem; background: #f2aa00; }

    /* Panel kanan */
    .kanan { position: relative; flex: 1; background: #dce8f8; }
    .card { position: absolute; top: calc(50% + 0.4rem); left: 50%; transform: translate(-50%, -50%); width: 34rem; height: 49.4rem; padding: 4.875rem 3.06rem 0 3.55rem; background: #fff; border-radius: 2.1rem; }
    .card h2 { margin: 0 0 2.44rem; font-size: 2.44rem; line-height: 1; font-weight: 800; color: #13305a; }
    label { display: block; margin: 0 0 0.69rem; font-size: 1.25rem; line-height: 1.2; font-weight: 700; color: #000; }
    .l2 { margin-top: 2.63rem; }
    .l3 { margin-top: 2.94rem; }
    select, input { display: block; width: 100%; height: 3.9rem; padding: 0 1.45rem; border: 1px solid #13305a; border-radius: 1.1rem; font-family: inherit; font-size: 1.25rem; color: #000; background: #fff; }
    input::placeholder { color: #7a7a7a; }
    button { display: block; width: 100%; height: 3.9rem; border-radius: 1.1rem; font-family: inherit; font-size: 1.25rem; font-weight: 700; color: #000; cursor: pointer; }
    .masuk { margin-top: 2.88rem; border: none; background: #f2aa00; }
    .sso { margin-top: 0.875rem; border: 0.19rem solid #13305a; background: #fff; }
  </style>
</head>
<body>
  <div class='halaman'>
    <!-- Panel kiri: identitas aplikasi -->
    <div class='kiri'>
      <div class='univ'>
        <img src='{{ asset("images/logo-ub.png") }}' alt='Logo UB'>
        <span>UNIVERSITAS BRAWIJAYA</span>
      </div>
      <div class='lingkaran'></div>
      <div class='brand'>
        <h1>Si<span>KTM</span></h1>
        <p>Sistem Layanan Kartu Tanda Mahasiswa</p>
      </div>
      <div class='garis'></div>
    </div>

    <!-- Panel kanan: form login -->
    <div class='kanan'>
      <div class='card'>
        <h2>Masuk</h2>
        <form method='POST' action='/login'>
          @csrf
          <!-- Dropdown masuk sebagai / angkatan (angkatan mahasiswa dipetakan ke peran Mahasiswa) -->
          <label for='peran'>Masuk sebagai/Angkatan</label>
          <select id='peran' name='peran'>
            <option value='Mahasiswa'>2026</option>
            <option value='Mahasiswa'>2025</option>
            <option value='Mahasiswa'>2024</option>
            <option value='AdminFakultas'>Admin Fakultas</option>
            <option value='AdminRektorat'>Admin Rektorat</option>
          </select>

          <!-- Field identitas akun -->
          <label for='nim' class='l2'>NIM/Email</label>
          <input type='text' id='nim' name='nim' placeholder='NIM'>

          <!-- Field kata sandi -->
          <label for='kataSandi' class='l3'>Kata Sandi</label>
          <input type='password' id='kataSandi' name='kataSandi' placeholder='Kata Sandi'>

          <button type='submit' class='masuk'>Masuk</button>
        </form>
        <button type='button' class='sso'>Masuk dengan SSO kampus</button>
      </div>
    </div>
  </div>
</body>
</html>