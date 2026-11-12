<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengajuan KTM - SiKTM</title>
    <link rel="stylesheet" href="{{ asset('css/status-pengajuan.css') }}">
</head>
<body>
<nav>
    <div class="brand"><b>SiKTM</b> UNIVERSITAS BRAWIJAYA</div>
    <div class="menu"><a href="#">Beranda</a><a href="#">Riwayat</a><a href="#">Bantuan</a></div>
</nav>
 
<main>
    <h1>Status Pengajuan KTM</h1>
 
    {{-- Form Input NIM (TrackStatusForm) --}}
    <form method="POST" action="{{ route('status-pengajuan.kirim') }}" class="cari">
        @csrf
        <label for="nim">Masukkan NIM Anda</label>
        <small>Mohon untuk memasukkan NIM yang sesuai dengan pengajuan.</small>
        <div class="baris">
            <input type="text" id="nim" name="nim" placeholder="NIM" value="{{ old('nim', $nim ?? '') }}">
            <button type="submit">Cek</button>
        </div>
        @error('nim') <div class="error">{{ $message }}</div> @enderror
    </form>
 
    {{-- Halaman Status Pengajuan (StatusPengajuanView) --}}
    @isset($pengajuan)
        @php $ditolak = $status === 'Ditolak'; @endphp
        <div class="kartu">
            <div class="atas">
                <div>{{ $nim }} &middot; Diajukan {{ \Carbon\Carbon::parse($pengajuan->tanggalPengajuan)->translatedFormat('d F Y') }}</div>
                <span class="badge {{ $ditolak ? 'ditolak' : '' }}">{{ $badge }}</span>
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
                        <dt>Lokasi</dt><dd>{{ $pengajuan->lokasiPengambilan }}</dd>
                        <dt>Jadwal</dt><dd>{{ $pengajuan->jadwalPengambilan }}</dd>
                        <dt>Keterangan</dt><dd>{{ $pengajuan->keteranganPengambilan ?? '-' }}</dd>
                    </dl>
                </div>
            @elseif ($ditolak)
                <div class="info tolak">
                    <strong>Alasan penolakan:</strong><br>
                    {{ $pengajuan->catatan ?? 'Pengajuan tidak dapat diproses.' }}
                </div>
                <p class="bantuan">Merasa ini keliru? Hubungi Admin Rektorat dengan menyebutkan NIM kamu.</p>
            @endif
        </div>
    @endisset
</main>
 
<footer>
    <h3>KEMAHASISWAAN<br>UNIVERSITAS BRAWIJAYA</h3>
    <p>SiKTM adalah sistem informasi pengajuan dan pemantauan Kartu Tanda Mahasiswa Universitas Brawijaya.</p>
</footer>
</body>
</html>
 