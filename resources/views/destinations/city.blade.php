@extends('layouts.app')
@section('title','Wisata '.$city->name)
@section('content')
<section class="screen city-screen"><div class="content">
    <div class="row city-header"><div><a class="back" href="{{ route('home') }}">Kembali</a><h2 class="serif" style="margin:5px 0 0">Destinasi Terlaris : <span class="city-header-name">{{ $city->name }}</span></h2></div><img class="logo-sm page-logo" src="{{ asset('assets/kawan/logo.png') }}" alt="Kawan Jalan"></div>
    <div class="header-line"></div>
    <div class="grid2 city-grid">
    @foreach($city->destinations as $d)
        <article class="place city-place">
            <img class="photo city-detail-photo" src="{{ asset($d->image ?: ($city->image ?: 'assets/kawan/hero.png')) }}" alt="{{ $d->name }}">
            <h3>{{ $d->name }}</h3>
            <p class="small">Tiket masuk: Rp.{{ number_format($d->ticket_price ?? 0,0,',','.') }}<br>Jam operasional: {{ $d->open_hour }}</p>
            <a class="btn sm buy-btn" href="{{ auth()->check()?route('payment.create',$d):route('login') }}">Beli Tiket</a>
        </article>
    @endforeach
    </div>
</div></section>
@endsection
