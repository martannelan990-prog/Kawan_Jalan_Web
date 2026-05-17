@extends('layouts.app')
@section('title','Notifikasi')
@section('content')
<section class="screen"><div class="topbar"><a class="back" href="{{ route('home') }}">Kembali</a><h1 class="title">🔔 Notifikasi</h1><span class="tiny" style="margin-left:auto">Tandai Semua Dibaca</span></div><div class="content stack">
@foreach($items as $n)
    <div class="notice"><b>{{ $n->title }}</b><p class="small muted">{{ $n->message }}</p><p class="tiny muted">{{ $n->created_at->diffForHumans() }}</p></div>
@endforeach
</div><x-bottom-nav/></section>
@endsection
