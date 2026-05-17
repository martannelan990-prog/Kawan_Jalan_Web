@extends('layouts.app')
@section('title', 'Favorit')
@section('content')
<section class="screen favorite-screen">
    <div class="content favorite-layout">
        <div>
            <div class="page-head">
                <a class="back" href="{{ route('home') }}">Kembali</a>
                <img class="logo-sm page-logo" src="{{ asset('assets/kawan/logo.png') }}" alt="Kawan Jalan">
            </div>
            <div class="favorite-title row">
                <div class="row" style="justify-content:flex-start">
                    <div class="heartbig">♥</div>
                    <div>
                        <h1>Destinasi Favorit</h1>
                        <p class="muted small">{{ $favorites->count() }} destinasi tersimpan</p>
                    </div>
                </div>
            </div>
            <p class="small muted favorite-helper">Klik kartu destinasi favorit untuk langsung masuk ke halaman pembayaran.</p>
        </div>
        <div class="favorite-list">
            @forelse($favorites as $favorite)
                @php
                    $destination = $favorite->destination ?? $favorite;
                    $cityName = is_string($destination->city ?? null)
                        ? $destination->city
                        : (($destination->city->name ?? null) ?: ($destination->location ?? 'Destinasi wisata'));
                @endphp
                <article class="card favorite-card favorite-card-wrap">
                    <form method="POST" action="{{ route('favorite.toggle',$destination) }}" class="favorite-remove-form">
                        @csrf
                        <button class="favorite-remove-btn" type="submit" aria-label="Hapus dari favorit">−</button>
                    </form>

                    <a class="favorite-link favorite-card-main" href="{{ route('payment.create', $destination) }}">
                        <img class="photo favorite-photo" src="{{ asset($destination->image ?: ($destination->city->image ?? 'assets/kawan/hero.png')) }}" alt="{{ $destination->name ?? 'Destinasi' }}">
                        <div class="favorite-info">
                            <b>{{ $destination->name ?? 'Destinasi' }}</b>
                            <p class="small muted">{{ $cityName }}</p>
                            <span class="favorite-pay">Lanjut ke pembayaran →</span>
                        </div>
                    </a>
                </article>
            @empty
                <div class="empty favorite-empty">
                    <div>
                        <div class="empty-heart">♡</div>
                        <h3>Belum Ada Favorit</h3>
                        <p class="small muted">Tambahkan destinasi wisata favorit Anda dengan menekan ikon hati pada destinasi.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <x-bottom-nav/>
</section>
@endsection
