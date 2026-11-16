<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengajuan KTM - SiKTM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>{!! file_get_contents(resource_path('css/status-pengajuan.css')) !!}</style>
</head>
<body>
@php
    $namaUser = $nama ?? null;
    if (!$namaUser && session('idPengguna')) {
        try {
            $namaUser = \App\Models\Pengguna::find(session('idPengguna'))?->nama;
        } catch (\Throwable $e) {
            $namaUser = null;
        }
    }
    // samakan dengan route Beranda temanmu
    $urlBeranda = Route::has('beranda') ? route('beranda') : url('/beranda-manasiswa');
@endphp

<header class="navbar">
    <a class="brand" href="{{ $urlBeranda }}">
        <img src="{{ asset('images/logo-ub.png') }}" alt="Logo Universitas Brawijaya">
        <span class="brand-name">Si<span class="accent">KTM</span></span>
        <span class="brand-univ">UNIVERSITAS BRAWIJAYA</span>
    </a>
    <nav class="nav-menu" aria-label="Menu utama">
        <a href="{{ $urlBeranda }}">Beranda</a>
        <a href="#">Riwayat</a>
        <a href="#">Bantuan</a>
        <a href="#">{{ strtoupper($namaUser ?? 'MAHASISWA') }}</a>
    </nav>
</header>

<main class="main-content">
    <h1 class="page-title">Status Pengajuan KTM</h1>

    {{-- Form Input NIM (TrackStatusForm) --}}
    <form method="POST" action="{{ route('status-pengajuan.kirim') }}" id="form-nim" novalidate>
        @csrf
        <label class="search-label" for="nim">Masukkan NIM Anda</label>
        <p class="search-hint" id="nim-hint">Mohon untuk memasukkan NIM yang sesuai dengan pengajuan.</p>
        <div class="search-row">
            <input type="text" id="nim" name="nim" placeholder="NIM" inputmode="numeric" autocomplete="off"
                   value="{{ old('nim', $nim ?? '') }}" aria-describedby="nim-hint pesan-nim"
                   class="@error('nim') invalid @enderror">
            <button type="submit" id="tombol-cek">Cek</button>
        </div>
        <p class="field-error" id="pesan-nim" role="alert">@error('nim'){{ $message }}@enderror</p>
    </form>

    @isset($pengajuan)
        {{-- Berhasil: Halaman Status Pengajuan (StatusPengajuanView) --}}
        @php
            $ditolak = ($status ?? null) === 'Ditolak';
            $kelasBadge = $ditolak ? 'ditolak' : (in_array($badge, ['Disetujui', 'KTM Siap Diambil']) ? 'ok' : '');
        @endphp
        <section class="card result-card" aria-live="polite">
            <div class="result-top">
                <p>{{ $nim }} &middot; Diajukan {{ \Carbon\Carbon::parse($pengajuan->tanggalPengajuan)->locale('id')->translatedFormat('d M Y') }}</p>
                <span class="badge {{ $kelasBadge }}">{{ $badge }}</span>
            </div>

            <div class="stepper">
                @foreach ($tahap as $t)
                    <div class="tahap {{ $t['kondisi'] }}">
                        <div class="bar"></div>
                        <b>{{ $t['nama'] }}</b>
                        <span>{{ $t['keterangan'] }}</span>
                    </div>
                @endforeach
            </div>

            @if ($badge === 'KTM Siap Diambil')
                <div class="info ok">
                    <strong>KTM kamu sudah bisa diambil</strong>
                    <dl>
                        <dt>Lokasi</dt><dd>{{ $pengajuan->lokasiPengambilan ?? '-' }}</dd>
                        <dt>Jadwal</dt><dd>{{ $pengajuan->jadwalPengambilan ?? '-' }}</dd>
                        <dt>Keterangan</dt><dd>{{ $pengajuan->keteranganPengambilan ?? '-' }}</dd>
                    </dl>
                </div>
            @elseif ($ditolak)
                <div class="info tolak">
                    <strong>Alasan penolakan:</strong><br>
                    {{ $pengajuan->catatan ?? 'Pengajuan tidak dapat diproses.' }}
                </div>
                <p class="help-text">Merasa ini keliru? Hubungi Admin Rektorat dengan menyebutkan NIM kamu.</p>
            @endif
        </section>
    @else
        {{-- Belum dicek / gagal: kartu kerangka supaya halaman tidak sepi --}}
        <section class="card result-card empty" aria-live="polite">
            <div class="result-top">
                <p>NIM &middot; Belum ada pengajuan yang ditampilkan</p>
                <span class="badge">Belum dicek</span>
            </div>

            <div class="stepper">
                @foreach (['Diajukan', 'Sedang Diverifikasi', 'Disetujui', 'KTM Siap Diambil'] as $nama)
                    <div class="tahap">
                        <div class="bar"></div>
                        <b>{{ $nama }}</b>
                        <span>Belum dicek</span>
                    </div>
                @endforeach
            </div>

            <div class="info netral">
                @if ($errors->has('nim'))
                    <strong>Status belum bisa ditampilkan</strong><br>
                    Periksa kembali NIM kamu, atau pastikan kamu sudah mengajukan KTM.
                @else
                    <strong>Status pengajuanmu akan tampil di sini</strong><br>
                    Masukkan NIM lalu tekan Cek untuk melihat tahapan pengajuan, serta lokasi dan jadwal pengambilan KTM jika sudah siap.
                @endif
            </div>
        </section>
    @endisset
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

<script>{!! file_get_contents(resource_path('js/status-pengajuan.js')) !!}</script>
</body>
</html>
