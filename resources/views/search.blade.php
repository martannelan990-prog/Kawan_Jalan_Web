@extends('layouts.app')
@section('title', 'Pencarian')
@section('content')
<section class="screen search-screen">
    <div class="content search-content">
        <a class="back" href="{{ route('home') }}">Kembali</a>
        <a href="#" class="search-pill search-full">
            <span>⌕</span>
            Cari tempat & aktivitas yang ingin dilakukan
        </a>
        <p class="small muted">Baru saja dicari</p>
        <div class="search-list">
            @foreach($cities as $c)
                <a href="{{ route('city.show', $c->slug) }}" class="search-item">
                    <h2 class="serif">{{ $c->name }}</h2>
                </a>
            @endforeach
        </div>
        <div class="divider"></div>
    </div>
</section>
@endsection
