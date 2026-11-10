<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Login - SiKTM</title>
  <style>
    * { box-sizing: border-box; }
    body { margin: 0; font-family: 'Plus Jakarta Sans', 'Segoe UI', Arial, sans-serif; }

    /* Susunan halaman: panel kiri (branding) dan panel kanan (form) */
    .halaman { display: flex; min-height: 100vh; }

    /* Panel kiri */
    .kiri { position: relative; flex: 1; background: #13305a; color: #fff; overflow: hidden; }
    .univ { position: absolute; top: 40px; left: 48px; font-weight: 600; letter-spacing: 0.3px; }
    .lingkaran { position: absolute; top: 50%; left: -251px; width: 470px; height: 470px; border: 3px solid #f2aa00; border-radius: 50%; transform: translateY(-50%); }
    .brand { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; }
    .brand h1 { margin: 0; font-size: 64px; line-height: 1; }
    .brand h1 span { color: #f2aa00; }
    .brand p { margin: 6px 0 0; font-size: 17px; }
    .garis { position: absolute; left: 48px; bottom: 40px; width: 235px; height: 10px; background: #f2aa00; }

    /* Panel kanan */
    .kanan { flex: 1; display: flex; align-items: center; justify-content: center; background: #dce8f8; padding: 24px; }
    .card { width: 100%; max-width: 490px; padding: 48px 52px; background: #fff; border-radius: 30px; }
    .card h2 { margin: 0 0 24px; font-size: 34px; color: #13305a; }
    label { display: block; margin: 18px 0 8px; font-weight: 700; font-size: 16px; }
    select, input { width: 100%; height: 55px; padding: 0 20px; border: 1px solid #13305a; border-radius: 14px; font-size: 16px; background: #fff; }
    button { width: 100%; height: 56px; margin-top: 12px; border-radius: 14px; font-size: 16px; font-weight: 700; cursor: pointer; }
    .masuk { margin-top: 32px; border: none; background: #f2aa00; color: #000; }
    .sso { border: 2px solid #13305a; background: #fff; color: #000; }

    /* Layar kecil: panel kiri disembunyikan */
    @media (max-width: 800px) { .kiri { display: none; } }
  </style>
</head>
<body>
  <div class='halaman'>
    <!-- Panel kiri: identitas aplikasi -->
    <div class='kiri'>
      <div class='univ'>UNIVERSITAS BRAWIJAYA</div>
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
          <!-- Dropdown masuk sebagai / angkatan -->
          <label for='peran'>Masuk sebagai/Angkatan</label>
          <select id='peran' name='peran'>
            <option value='Mahasiswa'>2026</option>
            <option value='AdminFakultas'>Admin Fakultas</option>
            <option value='AdminRektorat'>Admin Rektorat</option>
          </select>

          <!-- Field identitas akun -->
          <label for='nim'>NIM/Email</label>
          <input type='text' id='nim' name='nim' placeholder='NIM'>

          <!-- Field kata sandi -->
          <label for='kataSandi'>Kata Sandi</label>
          <input type='password' id='kataSandi' name='kataSandi' placeholder='Kata Sandi'>

          <button type='submit' class='masuk'>Masuk</button>
        </form>
        <button type='button' class='sso'>Masuk dengan SSO kampus</button>
      </div>
    </div>
  </div>
</body>
</html>