<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan - SiKTM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>{!! file_get_contents(resource_path('css/bantuan.css')) !!}</style>
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
        <a href="{{ url('/riwayat-pengajuan') }}">Riwayat</a>
        <a class="active" href="{{ route('bantuan') }}">Bantuan</a>
        @if ($nama)
            <a href="{{ url('/profil-mahasiswa') }}">{{ $nama }}</a>
        @endif
    </nav>
</header>

<main class="main-content">
    <h1 class="page-title">Bantuan</h1>
    <p class="page-sub">Temukan jawaban cepat, atau hubungi tim Kemahasiswaan.</p>

    <div class="help-layout">
        <section aria-label="Pertanyaan yang sering diajukan">
            @foreach ($faq as $item)
                <details class="faq-item" name="faq">
                    <summary>{{ $item['tanya'] }}<span class="ikon" aria-hidden="true"></span></summary>
                    <p class="faq-a">{{ $item['jawab'] }}</p>
                </details>
            @endforeach
        </section>

        <aside class="help-card">
            <h2>Belum ketemu jawabannya?</h2>
            <p>Tim Kemahasiswaan siap membantu pada hari kerja. Ceritakan masalahmu dan kami balas lewat email.</p>
            <a class="help-btn" href="{{ $urlKontak }}">Hubungi Kemahasiswaan</a>
        </aside>
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
        <a href="{{ url('/riwayat-pengajuan') }}">Riwayat</a>
        <a href="{{ route('bantuan') }}">Bantuan</a>
        <a href="{{ $urlKontak }}">Kontak Kemahasiswaan</a>
    </div>
    <div class="footer-column">
        <h3>LEGAL</h3>
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Ketentuan Layanan</a>
    </div>
</footer>
</body>
</html>