@extends('layouts.app')
@section('title','Profil Saya')
@section('content')
<section class="screen profile-screen">
    <div class="topbar settings-topbar">
        <a class="back" href="{{ route('settings') }}">Kembali</a>
        <h1 class="title">Profil Saya</h1>
        <img class="logo-sm page-logo" src="{{ asset('assets/kawan/logo.png') }}" alt="Kawan Jalan">
    </div>

    <div class="content stack profile-content">
        <div class="profile-hero card">
            <div class="profile-avatar">👤</div>
            <div>
                <h2 class="profile-name">{{ auth()->user()->name }}</h2>
                <p class="small muted profile-role-text">Akun {{ auth()->user()->role === 'admin' ? 'Admin' : 'Wisatawan' }}</p>
                <span class="chip blue">{{ auth()->user()->role === 'admin' ? 'Admin' : 'Wisatawan' }}</span>
            </div>
        </div>

        <div class="card stack profile-card">
            <h3 class="profile-block-title">Informasi Pribadi</h3>
            <div class="profile-info-list">
                <div class="settings-line profile-info-line">
                    <span class="settings-icon">✉</span>
                    <span class="settings-copy">
                        <b>Email</b>
                        <small>{{ auth()->user()->email }}</small>
                    </span>
                </div>
                <div class="settings-line profile-info-line">
                    <span class="settings-icon">☏</span>
                    <span class="settings-copy">
                        <b>Nomor Telepon</b>
                        <small>{{ auth()->user()->phone ?? '+62 812-3456-7890' }}</small>
                    </span>
                </div>
            </div>
        </div>

        <div class="card stack profile-card">
            <h3 class="profile-block-title">Menu</h3>
            <a class="settings-line profile-link profile-menu-link" href="{{ route('profile.edit') }}">
                <span class="settings-icon">⚙</span>
                <span class="settings-copy">
                    <b>Pengaturan</b>
                    <small class="muted">Kelola data akun Anda</small>
                </span>
                <span class="profile-arrow">›</span>
            </a>
            <a class="settings-line profile-link profile-menu-link" href="{{ route('profile.history') }}">
                <span class="settings-icon">↻</span>
                <span class="settings-copy">
                    <b>Riwayat Wisata</b>
                    <small class="muted">Lihat kunjungan wisata Anda</small>
                </span>
                <span class="profile-arrow">›</span>
            </a>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button class="btn red">Keluar</button>
        </form>
    </div>

    <x-bottom-nav/>
</section>
@endsection
