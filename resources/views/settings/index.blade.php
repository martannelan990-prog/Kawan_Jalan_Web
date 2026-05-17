@extends('layouts.app')
@section('title', 'Pengaturan')

@section('content')
<section class="screen settings-screen">
    <div class="topbar settings-topbar">
        <a class="back" href="{{ route('home') }}">Kembali</a>
        <h1 class="title">Pengaturan</h1>
        <img class="logo-sm page-logo" src="{{ asset('assets/kawan/logo.png') }}" alt="Kawan Jalan">
    </div>

    <div class="content stack settings-content">
        <div class="card settings-card stack">
            <h4>Profil</h4>
            <a class="settings-line" href="{{ route('profile') }}">
                <span class="settings-icon">♟</span>
                <span class="settings-copy">
                    <b>Profil</b>
                    <small class="muted">Informasi profil Anda</small>
                </span>
            </a>
        </div>

        <div class="card settings-card stack">
            <h4>Tampilan</h4>
            <div class="settings-line">
                <span class="settings-icon">☾</span>
                <span class="settings-copy">
                    <b>Tema</b>
                    <small class="muted" data-theme-label>Mode Terang</small>
                </span>
                <div class="theme-switch" aria-label="Pilih tema">
                    <button type="button" data-theme-option="light">Terang</button>
                    <button type="button" data-theme-option="dark">Gelap</button>
                </div>
            </div>
        </div>

        <div class="card settings-card stack">
            <h4>Notifikasi</h4>
            <div class="settings-line">
                <span class="settings-icon">♧</span>
                <span class="settings-copy">
                    <b>Push Notifikasi</b>
                    <small class="muted">Status: <span data-toggle-label>Aktif</span></small>
                </span>
                <button type="button" class="toggle is-on" data-toggle aria-label="Aktifkan atau matikan notifikasi">
                    <span></span>
                </button>
            </div>
        </div>

        <div class="card settings-card stack">
            <h4>Lainnya</h4>

            <a class="settings-line" href="{{ route('profile.password') }}">
                <span class="settings-icon">♡</span>
                <span class="settings-copy">
                    <b>Profil & Keamanan</b>
                    <small class="muted">Kelola data dan riwayat kunjungan</small>
                </span>
            </a>

            <a class="settings-line" href="{{ route('help', 'faq') }}">
                <span class="settings-icon">ⓘ</span>
                <span class="settings-copy">
                    <b>Bantuan & Dukungan</b>
                    <small class="muted">FAQ dan kontak</small>
                </span>
            </a>

            @if(auth()->check() && auth()->user()->isAdmin())
                <a class="btn role-admin admin-button" href="{{ route('admin.dashboard') }}">Panel Admin</a>
            @endif

            @auth
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="btn red logout-btn">Keluar Akun</button>
                </form>
            @endauth
        </div>
    </div>

    <x-bottom-nav/>
</section>
@endsection
