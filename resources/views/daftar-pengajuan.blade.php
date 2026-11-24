<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengajuan KTM - SiKTM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>{!! file_get_contents(resource_path('css/daftar-pengajuan.css')) !!}</style>
</head>
<body>
<header class="navbar">
    <a class="brand" href="{{ $urlBeranda }}">
        <img src="{{ asset('images/logo-ub.png') }}" alt="Logo Universitas Brawijaya">
        <span class="brand-name">Si<span class="accent">KTM</span></span>
        <span class="brand-univ">UNIVERSITAS BRAWIJAYA</span>
    </a>
    <nav class="nav-menu" aria-label="Menu utama">
        <a class="active" href="{{ $urlBeranda }}">Beranda</a>
        <a href="#">Riwayat</a>
        <a href="#">Bantuan</a>
        <a href="#">{{ strtoupper($nama) }}</a>
    </nav>
</header>

<main class="main-content">
    <h1 class="page-title">Daftar pengajuan KTM</h1>

    <form class="search-bar" method="GET" action="{{ route('daftar-pengajuan') }}">
        <input type="search" name="q" value="{{ $q }}" placeholder="Cari NIM atau nama" aria-label="Cari NIM atau nama">
        <select name="status" aria-label="Filter status">
            <option value="">Semua status</option>
            @foreach ($label as $nilai => $teks)
                <option value="{{ $nilai }}" @selected($status === $nilai)>{{ $teks }}</option>
            @endforeach
        </select>
    </form>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Tanggal</th>
                    <th>Cek pengajuan Bank</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($daftar as $r)
                    <tr>
                        <td>{{ $r->nim }}</td>
                        <td>{{ $r->nama }}</td>
                        <td>{{ $r->namaProdi }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->tanggalPengajuan)->locale('id')->translatedFormat('d M Y') }}</td>
                        <td>
                            @if (in_array($r->nim, $nimBank))
                                <span class="pill merah">Sudah ada pengajuan di Bank</span>
                            @else
                                <span class="pill hijau">Tidak ada pengajuan aktif</span>
                            @endif
                        </td>
                        <td>{{ $label[$r->status] ?? $r->status }}</td>
                        <td>
                            <a class="aksi" href="{{ url('/pengajuan-ktm/verifikasi/' . $r->idPengajuan) }}">
                                {{ in_array($r->status, ['Diajukan', 'Diverifikasi']) ? 'Periksa' : 'Lihat' }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="kosong">Tidak ada pengajuan yang cocok.</td></tr>
                @endforelse
            </tbody>
        </table>

        @if ($daftar->hasPages())
            <div class="pager">
                @if ($daftar->previousPageUrl())
                    <a href="{{ $daftar->previousPageUrl() }}">&larr; Sebelumnya</a>
                @else
                    <span class="mati">&larr; Sebelumnya</span>
                @endif
                @if ($daftar->nextPageUrl())
                    <a href="{{ $daftar->nextPageUrl() }}">Berikutnya &rarr;</a>
                @else
                    <span class="mati">Berikutnya &rarr;</span>
                @endif
            </div>
        @endif
    </div>
</main>

<footer class="footer">
    <div class="footer-info">
        <h2>KEMAHASISWAAN<br>UNIVERSITAS BRAWIJAYA</h2>
        <p>SiKTM adalah sistem informasi pengajuan dan pemantauan Kartu Tanda Mahasiswa Universitas Brawijaya. Layanan ini dikelola oleh Kemahasiswaan untuk memudahkan mahasiswa mengurus KTM secara cepat, jelas, dan transparan.</p>
    </div>
    <div class="footer-column">
        <h3>NAVIGASI</h3>
        <a href="{{ $urlBeranda }}">Beranda</a>
        <a href="#">Riwayat</a>
        <a href="#">Bantuan</a>
        <a href="#">Kontak Kemahasiswaan</a>
    </div>
    <div class="footer-column">
        <h3>LEGAL</h3>
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Ketentuan Layanan</a>
    </div>
</footer>
<script>{!! file_get_contents(resource_path('js/daftar-pengajuan.js')) !!}</script>
</body>
</html>