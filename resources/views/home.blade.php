@extends('layouts.app')
@section('title','Beranda - Kawan Jalan')
@section('content')
<section class="screen">
<div class="content" style="padding-top:23px">
    <div class="row home-head">
        <img class="logo" src="{{ asset('assets/kawan/logo.png') }}" alt="Kawan Jalan">
        <a href="{{ route('search') }}" class="search-pill home-search-pill">⌕ <span>Cari tempat & aktivitas<br>yang ingin dilakukan</span></a>
        <a class="bell" href="{{ auth()->check()?route('notifications'):route('login') }}">🔔 <b style="color:#ff7b87">{{ $notificationCount ?? 0 }}</b></a>
    </div>

    <div class="divider" style="margin-top:10px"></div>

    <h2 class="section-title">Destinasi Terlaris</h2>
    <div class="scroll-x">
        @forelse($popular->unique('city_id')->values() as $d)
            @php($city = $d->city)
            <a class="dest-card city-card" href="{{ $city ? route('city.show',$city->slug) : '#' }}">
                <img class="photo city-photo" src="{{ asset($city?->image ?: 'assets/kawan/hero.png') }}" alt="{{ $city?->name ?? 'Wisata' }}">
                <h3 class="serif">{{ $city?->name ?? 'Wisata' }}</h3>
            </a>
        @empty
            <div class="card muted small">Belum ada destinasi populer.</div>
        @endforelse
    </div>

    <div class="divider"></div>

    <h2 class="section-title">Tempat wisata yang tidak boleh dilewatkan</h2>
    <div class="scroll-x">
        @forelse($cities as $c)
            @php($destinationCount = (int) ($c->destinations_count ?? 0))
            <a class="dest-card city-card" href="{{ route('city.show',$c->slug) }}">
                <img class="photo city-photo" src="{{ asset($c->image ?: 'assets/kawan/hero.png') }}" alt="{{ $c->name }}">
                <h3 class="serif">{{ $c->name }}</h3>
                <div class="tiny muted">{{ $destinationCount > 0 ? $destinationCount . ' kegiatan' : 'Segera Hadir' }}</div>
            </a>
        @empty
            <div class="card muted small">Belum ada kota wisata.</div>
        @endforelse
    </div>

    <div class="divider"></div>

    <h2 class="section-title">Jadwal Wisata yang mungkin anda suka</h2>
    <div class="scroll-x">
        @forelse($recommended as $d)
            @php($city = $d->city)
            <article class="dest-card big suggestion-card">
                <img class="photo suggestion-photo" src="{{ asset($d->image ?: ($city?->image ?: 'assets/kawan/hero.png')) }}" alt="{{ $d->name }}">
                <div class="row" style="margin-top:6px">
                    <span class="tiny muted">{{ $city?->name ?? '-' }}</span>
                    @auth
                        <form method="POST" action="{{ route('favorite.toggle',$d) }}">
                            @csrf
                            <button class="btn outline sm icon-heart" type="submit">♡</button>
                        </form>
                    @endauth
                </div>
                <h3 class="serif" style="font-size:15px;line-height:1.05">{{ $d->name }}</h3>
                <p class="tiny muted">{{ Str::limit($d->description,86) }}</p>
                <a class="btn sm buy-btn" href="{{ auth()->check()?route('payment.create',$d):route('login') }}">Beli Tiket</a>
            </article>
        @empty
            <div class="card muted small">Belum ada rekomendasi wisata.</div>
        @endforelse
    </div>
</div>
<x-bottom-nav/>
</section>
@endsection
