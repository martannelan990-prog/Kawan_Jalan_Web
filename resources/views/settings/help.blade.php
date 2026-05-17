@extends('layouts.app')
@section('title','Bantuan & Dukungan')
@section('content')
<section class="screen"><div class="topbar"><a class="back" href="{{ route('settings') }}">Kembali</a><h1 class="title">Bantuan & Dukungan</h1></div>
<div class="content stack">
    <div class="card stack" style="background:linear-gradient(135deg,#1561ff,#5727d8)"><h3 style="margin:0">✉ Hubungi Kami</h3><p class="small">Ada pertanyaan atau butuh bantuan? Hubungi kami melalui:</p><div class="inner">✉ kelompok6@gmail.com</div></div>
    <div class="tabs"><a class="{{ $tab==='faq'?'active':'' }}" href="{{ route('help','faq') }}">FAQ</a><a class="{{ $tab==='saran'?'active':'' }}" href="{{ route('help','saran') }}">Saran</a><a class="{{ $tab==='laporan'?'active':'' }}" href="{{ route('help','laporan') }}">Laporan</a></div>
    @if($tab==='laporan')
    <form method="POST" action="{{ route('report.store') }}" class="card stack kj-validated-form" novalidate>@csrf
        <h3 style="margin:0">⚠ Laporkan Guide/Grub Bermasalah</h3><p class="small muted">Jika Anda mengalami masalah dengan pemandu atau grup wisata, silakan laporkan kepada kami.</p>
        <label class="small">Nama Pemandu</label>
        <div class="field-wrap"><input class="input" name="guide_name" placeholder="Masukkan nama pemandu" data-required="Nama pemandu wajib diisi gaboleh kosong."></div>
        <label class="small">Nomor Pemandu</label>
        <div class="field-wrap"><input class="input" name="guide_phone" placeholder="Masukkan nomor pemandu 08xxxxxxxxxx" data-required="Nomor pemandu wajib diisi gaboleh kosong." data-phone="Nomor pemandu wajib diawali 08."></div>
        <label class="small">Link Grub Wisata</label>
        <div class="field-wrap"><input class="input" name="group_link" placeholder="Masukkan link grub wisata" data-required="Link grub wisata wajib diisi gaboleh kosong." data-url="Link grub wisata wajib berupa URL yang valid."></div>
        <label class="small">Destinasi Wisata</label>
        <div class="field-wrap"><input class="input" name="destination_name" placeholder="Masukkan nama destinasi" data-required="Destinasi wisata wajib diisi gaboleh kosong."></div>
        <label class="small">Deskripsi Masalah</label>
        <div class="field-wrap"><textarea class="input" name="description" rows="5" placeholder="Jelaskan masalah yang Anda alami..." data-required="Deskripsi masalah wajib diisi gaboleh kosong."></textarea></div>
        <button class="btn red">⚠ Kirim Laporan</button>
        <div class="card flat" style="border-color:#a16207;color:#fde047;background:#352717">Catatan: Pastikan informasi yang Anda berikan akurat. Laporan palsu dapat berakibat pada penangguhan akun.</div>
    </form>
    @elseif($tab==='saran')
    <form class="card stack"><h3 style="margin:0">▣ Saran Aplikasi & Fitur</h3><p class="small muted">Kami menghargai masukan Anda untuk meningkatkan layanan kami.</p><textarea class="input" rows="6" placeholder="Tuliskan saran Anda di sini..."></textarea><button class="btn">✈ Kirim Saran</button></form>
    @else
    <div class="stack">
        <details class="card faq"><summary>Bagaimana cara memesan wisata?</summary><p class="small muted">Pilih kota, pilih destinasi, login, lalu lakukan pembayaran QRIS.</p></details>
        <details class="card faq"><summary>Metode pembayaran apa yang tersedia?</summary><p class="small muted">Untuk saat ini hanya QR/barcode/QRIS.</p></details>
        <details class="card faq"><summary>Bagaimana jika pembayaran saya gagal?</summary><p class="small muted">Silakan ulangi pemesanan atau hubungi admin.</p></details>
        <details class="card faq"><summary>Apakah saya bisa membatalkan pesanan?</summary><p class="small muted">Hubungi admin sebelum jadwal wisata dimulai.</p></details>
        <details class="card faq"><summary>Apa yang harus saya bawa saat wisata?</summary><p class="small muted">E-ticket, barcode grup wisata, dan perlengkapan pribadi.</p></details>
    </div>
    @endif
</div><x-bottom-nav/></section>
@endsection
