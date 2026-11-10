<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Login - SiKTM</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f6f8; }
    .card { max-width: 380px; margin: 60px auto; padding: 24px; background: #fff; border: 1px solid #ddd; border-radius: 8px; }
    label { display: block; margin-top: 12px; font-weight: bold; }
    select, input { width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box; }
    button { width: 100%; margin-top: 16px; padding: 10px; border: none; border-radius: 5px; background: #007bff; color: #fff; cursor: pointer; }
    .sso { background: #6c757d; }
  </style>
</head>
<body>
  <div class='card'>
    <h3>Masuk ke SiKTM</h3>
    <form method='POST' action='/login'>
      <!-- Dropdown peran pengguna -->
      <label for='peran'>Masuk sebagai</label>
      <select id='peran' name='peran'>
        <option value='Mahasiswa'>Mahasiswa</option>
        <option value='AdminFakultas'>Admin Fakultas</option>
        <option value='AdminRektorat'>Admin Rektorat</option>
      </select>

      <!-- Field identitas akun -->
      <label for='nim'>NIM/Email</label>
      <input type='text' id='nim' name='nim' placeholder='Masukkan NIM'>

      <!-- Field kata sandi -->
      <label for='kataSandi'>Kata Sandi</label>
      <input type='password' id='kataSandi' name='kataSandi'>

      <button type='submit'>Masuk</button>
    </form>
    <button type='button' class='sso'>Masuk dengan SSO kampus</button>
  </div>
</body>
</html>