@extends('layouts.app')
@section('title','Sukabumi - Segera Hadir')
@section('content')
<section class="screen coming-screen">
    <div class="content stack coming-wrap">
        <div class="row"><a class="back" href="{{ route('home') }}">Kembali</a><img class="logo-sm page-logo" src="{{ asset('assets/kawan/logo.png') }}" alt="Kawan Jalan"></div>
        <div class="coming-box">
            <img class="photo city-detail-photo" src="{{ asset($city->image ?: 'assets/kawan/hero.png') }}" alt="{{ $city->name }}">
            <h1 class="serif">COMING SOON</h1>
            <h2>{{ $city->name }}</h2>
            <p class="muted">Destinasi wisata untuk kota {{ $city->name }} sedang dipersiapkan dan akan segera hadir.</p>
            <a class="btn buy-btn" href="{{ route('home') }}">Kembali ke Beranda</a>
        </div>
    </div>
</section>
@endsection
