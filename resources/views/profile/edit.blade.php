@extends('layouts.app')
@section('title','Informasi Pengguna')
@section('content')
<section class="screen">
    <div class="content stack">
        <div class="row"><a class="back" href="{{ route('profile') }}">Kembali</a><img class="logo-sm page-logo" src="{{ asset('assets/kawan/logo.png') }}"></div>
        <h1 class="center">Profil Saya</h1>
        <div class="tabs profile-tabs">
            <a class="active" href="{{ route('profile.edit') }}"><span class="tab-icon">👤</span><span>Informasi</span></a>
            <a href="{{ route('profile.password') }}"><span class="tab-icon">🔒</span><span>Keamanan</span></a>
            <a href="{{ route('profile.history') }}"><span class="tab-icon">🕘</span><span>Riwayat</span></a>
        </div>
        <p class="small muted center">Kelola informasi pribadi dan keamanan akun Anda</p>

        <form method="POST" action="{{ route('profile.update') }}" class="card stack kj-validated-form" novalidate>
            @csrf
            <p class="muted">Perbarui informasi pribadi Anda di sini</p>

            <label class="small">Nama Lengkap</label>
            <div class="field-wrap">
                <input class="input" name="name" value="{{ old('name', auth()->user()->name) }}"
                       data-required="Nama lengkap wajib diisi gaboleh kosong.">
            </div>

            <label class="small">Email</label>
            <div class="field-wrap">
                <input class="input" type="text" name="email" value="{{ old('email', auth()->user()->email) }}"
                       data-required="Email wajib diisi gaboleh kosong."
                       data-email="Email wajib menggunakan tanda @.">
            </div>

            <label class="small">Nomor Telepon</label>
            <div class="field-wrap">
                <input class="input" name="phone" inputmode="numeric" value="{{ old('phone', auth()->user()->phone) }}"
                       data-required="Nomor telepon wajib diisi gaboleh kosong."
                       data-phone="Nomor telepon wajib diawali 08.">
            </div>

            <label class="small">Negara</label>
            <input class="input" name="country" value="{{ old('country', auth()->user()->country) }}">

            <label class="small">Kota</label>
            <input class="input" name="city" value="{{ old('city', auth()->user()->city) }}">

            <label class="small">Alamat</label>
            <input class="input" name="address" value="{{ old('address', auth()->user()->address) }}">

            <div class="row form-actions">
                <button class="btn sm" type="submit">Simpan Perubahan</button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn red" type="submit">Logout Akun</button>
        </form>
    </div>
    <x-bottom-nav/>
</section>
@endsection
