<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi KTM</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f6fa;
            color: #263445;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            font-size: 26px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #718096;
            margin-bottom: 28px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
        }

        .card p {
            color: #718096;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .card h2 {
            font-size: 28px;
        }

        .filter, .table-container {
            background: white;
            padding: 22px;
            border-radius: 12px;
            margin-bottom: 22px;
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
        }

        .filter h3, .table-container h3 {
            margin-bottom: 18px;
        }

        .filter form {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            align-items: end;
        }

        label {
            display: block;
            font-size: 13px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 11px;
            border: 1px solid #dce1e8;
            border-radius: 7px;
            background: white;
        }

        button, .reset {
            display: inline-block;
            padding: 11px 18px;
            border: none;
            border-radius: 7px;
            background: #24476b;
            color: white;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .reset {
            background: #e8edf3;
            color: #263445;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #edf0f4;
            font-size: 14px;
        }

        th {
            background: #f7f9fc;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            background: #edf1f5;
        }

        .progress {
            color: #946200;
            background: #fff2cc;
        }

        .success {
            color: #18794e;
            background: #dff5e9;
        }

        .empty {
            text-align: center;
            color: #718096;
            padding: 25px;
        }

        .percentage {
            margin-top: 12px;
            font-size: 13px;
            color: #18794e;
        }

        .error {
            background: #fde8e8;
            color: #b42318;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        @media (max-width: 800px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .filter form {
                grid-template-columns: repeat(2, 1fr);
            }

            .table-container {
                overflow-x: auto;
            }
        }

        @media (max-width: 500px) {
            body {
                padding: 15px;
            }

            .cards, .filter form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Rekapitulasi KTM</h1>
    <p class="subtitle">Monitoring pengajuan dan kepemilikan KTM mahasiswa</p>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <!-- Kartu Ringkasan -->
    <div class="cards">
        <div class="card">
            <p>Total Mahasiswa</p>
            <h2>{{ $total }}</h2>
        </div>

        <div class="card">
            <p>Belum Mengajukan</p>
            <h2>{{ $belum }}</h2>
        </div>

        <div class="card">
            <p>Sedang Diproses</p>
            <h2>{{ $proses }}</h2>
        </div>

        <div class="card">
            <p>Sudah Memiliki KTM</p>
            <h2>{{ $sudah }}</h2>
            <div class="percentage">
                {{ $persentase }}% dari total mahasiswa
            </div>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <div class="filter">
        <h3>Filter Data Mahasiswa</h3>

        <form action="{{ route('rekap-ktm') }}" method="GET">
            <div>
                <label for="kataKunci">Cari NIM</label>
                <input
                    type="text"
                    id="kataKunci"
                    name="kataKunci"
                    placeholder="Masukkan NIM"
                    value="{{ request('kataKunci') }}"
                >
            </div>

            <div>
                <label for="prodi">Program Studi</label>
                <input
                    type="text"
                    id="prodi"
                    name="prodi"
                    placeholder="ID Program Studi"
                    value="{{ request('prodi') }}"
                >
            </div>

            <div>
                <label for="angkatan">Angkatan</label>
                <input
                    type="number"
                    id="angkatan"
                    name="angkatan"
                    placeholder="Contoh: 2025"
                    value="{{ request('angkatan') }}"
                >
            </div>

            <div>
                <label for="status">Status KTM</label>
                <select name="status" id="status">
                    <option value="">Semua Status</option>
                    <option value="Belum Mengajukan"
                        {{ request('status') == 'Belum Mengajukan' ? 'selected' : '' }}>
                        Belum Mengajukan
                    </option>
                    <option value="Sedang Diproses"
                        {{ request('status') == 'Sedang Diproses' ? 'selected' : '' }}>
                        Sedang Diproses
                    </option>
                    <option value="Sudah Memiliki KTM"
                        {{ request('status') == 'Sudah Memiliki KTM' ? 'selected' : '' }}>
                        Sudah Memiliki KTM
                    </option>
                </select>
            </div>

            <div>
                <button type="submit">Terapkan Filter</button>
                <a href="{{ route('rekap-ktm') }}" class="reset">Reset</a>
            </div>
        </form>
    </div>

    <!-- Tabel Rekapitulasi -->
    <div class="table-container">
        <h3>Data Rekapitulasi Mahasiswa</h3>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIM</th>
                    <th>Program Studi</th>
                    <th>Status KTM</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($daftar as $index => $mahasiswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mahasiswa['nim'] }}</td>
                        <td>{{ $mahasiswa['prodi'] }}</td>
                        <td>
                            @if($mahasiswa['status'] == 'Sudah Memiliki KTM')
                                <span class="status success">
                                    {{ $mahasiswa['status'] }}
                                </span>
                            @elseif($mahasiswa['status'] == 'Sedang Diproses')
                                <span class="status progress">
                                    {{ $mahasiswa['status'] }}
                                </span>
                            @else
                                <span class="status">
                                    {{ $mahasiswa['status'] }}
                                </span>
                            @endif
                        </td>
                        <td>-</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            Belum ada data mahasiswa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
