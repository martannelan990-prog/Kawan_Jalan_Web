@extends('layouts.app')
@section('title', 'Masuk - Kawan Jalan')

@section('content')
<section class="screen auth-screen login-screen">
    <div class="auth-hero">
        <img class="logo auth-logo" src="{{ asset('assets/kawan/logo.png') }}" alt="Kawan Jalan">
    </div>

    <div class="auth-panel stack">
        <a class="btn outline social" href="#">
            <span class="social-google">G</span>
            Lanjutkan dengan Google
        </a>

        <a class="btn outline social" href="#">
            <span class="social-facebook">f</span>
            Lanjutkan dengan Facebook
        </a>

        <div class="or">atau</div>

        <form method="POST" action="{{ route('login.post') }}" class="stack auth-form kj-validated-form" novalidate>
            @csrf

            <div class="field-wrap">
                <input class="input auth" type="text" name="email" placeholder="Nama Pengguna / Email"
                       data-required="Email wajib diisi gaboleh kosong."
                       data-email="Email wajib menggunakan tanda @."
                       value="{{ old('email') }}">
            </div>

            <div class="password-field field-wrap">
                <button type="button" class="password-toggle" data-password-toggle="#login-password">⌘ Tampilkan Password</button>
                <input id="login-password" class="input auth" type="password" name="password" placeholder="Password"
                       data-required="Password wajib diisi gaboleh kosong.">
            </div>

            <div class="row small auth-links">
                <a href="{{ route('register') }}">Buat akun baru</a>
                <a href="{{ route('password.request') }}">Lupa Password?</a>
            </div>

            <button class="btn outline auth-submit">Masuk</button>
        </form>

        <p class="auth-note">
            Dengan membuat akun, Anda menyetujui <u>Syarat dan Ketentuan</u> serta memahami <u>Kebijakan Privasi</u>.
        </p>
    </div>
</section>
@endsection
