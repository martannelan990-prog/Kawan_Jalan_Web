@extends('layouts.app')
@section('title','Ganti Password')
@section('content')
<section class="screen">
    <div class="content stack">
        <div class="row"><a class="back" href="{{ route('settings') }}">Kembali</a><img class="logo-sm page-logo" src="{{ asset('assets/kawan/logo.png') }}"></div>
        <h1 class="center">Profil Saya</h1>
        <div class="tabs profile-tabs">
            <a href="{{ route('profile.edit') }}"><span class="tab-icon">👤</span><span>Informasi</span></a>
            <a class="active" href="{{ route('profile.password') }}"><span class="tab-icon">🔒</span><span>Keamanan</span></a>
            <a href="{{ route('profile.history') }}"><span class="tab-icon">🕘</span><span>Riwayat</span></a>
        </div>
        <p class="small muted center">Kelola informasi pribadi dan keamanan akun Anda</p>

        <form class="card stack kj-validated-form" method="POST" action="{{ route('profile.password.update') }}" novalidate>
            @csrf
            <h3>Ubah Password</h3>
            <p class="muted small">Pastikan password baru minimal 8 karakter angka atau huruf.</p>

            <div class="field-wrap password-field">
                <label class="small" for="current-password">Password Saat Ini</label>
                <button type="button" class="password-toggle" data-password-toggle="#current-password">⌘ Tampilkan Password</button>
                <input id="current-password" class="input" name="current_password" type="password" placeholder="Masukkan password saat ini"
                       data-required="Password saat ini wajib diisi gaboleh kosong.">
            </div>

            <div class="field-wrap password-field">
                <label class="small" for="new-password">Password Baru</label>
                <button type="button" class="password-toggle" data-password-toggle="#new-password">⌘ Tampilkan Password</button>
                <input id="new-password" class="input" name="password" type="password" placeholder="Minimal 8 karakter angka atau huruf"
                       data-required="Password baru wajib diisi gaboleh kosong."
                       data-password-min="Password baru wajib minimal 8 karakter angka atau huruf.">
            </div>

            <div class="field-wrap password-field">
                <label class="small" for="new-password-confirmation">Konfirmasi Password Baru</label>
                <button type="button" class="password-toggle" data-password-toggle="#new-password-confirmation">⌘ Tampilkan Password</button>
                <input id="new-password-confirmation" class="input" name="password_confirmation" type="password" placeholder="Ketik ulang password baru"
                       data-required="Konfirmasi password baru wajib diisi gaboleh kosong."
                       data-match="#new-password"
                       data-match-message="Konfirmasi password baru harus sama dengan password baru.">
            </div>

            <div class="notice small">Tips keamanan: gunakan minimal 8 karakter. Boleh angka, huruf, atau kombinasi keduanya.</div>
            <button class="btn sm" style="margin-left:auto">Ubah Password</button>
        </form>
    </div>
    <x-bottom-nav/>
</section>
@endsection
