<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kemahasiswaan - SiKTM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>{!! file_get_contents(resource_path('css/kontak-kemahasiswaan.css')) !!}</style>
</head>
<body>
<header class="navbar">
    <a class="brand" href="{{ $urlBeranda }}">
        <img src="{{ asset('images/logo-ub.png') }}" alt="Logo Universitas Brawijaya">
        <span class="brand-name">Si<span class="accent">KTM</span></span>
        <span class="brand-univ">UNIVERSITAS BRAWIJAYA</span>
    </a>
    <nav class="nav-menu" aria-label="Menu utama">
        <a href="{{ $urlBeranda }}">Beranda</a>
        <a href="#">Riwayat</a>
        <a href="{{ $urlBantuan }}">Bantuan</a>
        @if ($nama)
            <a href="#">{{ strtoupper($nama) }}</a>
        @endif
    </nav>
</header>

<main class="main-content">
    <div class="kontak-wrap">
        <h1 class="page-title">Kontak Kemahasiswaan</h1>
        <p class="page-sub">Datang langsung, kirim email, atau hubungi lewat telepon.</p>

        <section class="info-card">
            <h2>Alamat</h2>
            <p class="tebal">{{ $kontak['gedung'] }}</p>
            <p class="redup">{{ $kontak['kota'] }}</p>
        </section>

        <section class="info-card">
            <h2>Jam layanan</h2>
            <p class="tebal">{{ $kontak['hari'] }}</p>
            <p class="redup">{{ $kontak['jam'] }}</p>
        </section>

        <section class="info-card">
            <h2>Email dan telepon</h2>
            <p class="tebal"><a href="{{ $mailto }}">{{ $kontak['email'] }}</a></p>
            <p class="redup">
                @if (preg_match('/\d/', $kontak['telepon']))
                    <a href="tel:{{ preg_replace('/[^\d+]/', '', $kontak['telepon']) }}">{{ $kontak['telepon'] }}</a>
                @else
                    {{ $kontak['telepon'] }}
                @endif
            </p>
        </section>

        {{-- Tombol ini membuka aplikasi email dengan isian yang sudah terisi --}}
        <a class="email-btn" href="{{ $mailto }}">Kirim email ke Kemahasiswaan</a>
        <p class="email-alt">Email tidak terbuka? <a href="{{ $gmail }}" target="_blank" rel="noopener">Buka lewat Gmail</a></p>
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
        <a href="{{ $urlBantuan }}">Bantuan</a>
        <a href="{{ route('kontak-kemahasiswaan') }}">Kontak Kemahasiswaan</a>
    </div>
    <div class="footer-column">
        <h3>LEGAL</h3>
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Ketentuan Layanan</a>
    </div>
</footer>
</body>
</html>