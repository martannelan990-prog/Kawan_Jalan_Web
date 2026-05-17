@extends('layouts.app')
@section('title','Email Sent')
@section('content')
<section class="screen"><div class="content stack" style="padding-top:28vh">
    <a class="back" href="{{ route('login') }}">Kembali ke Masuk</a>
    <p class="muted">Masukkan email Anda untuk mengatur ulang password</p>
    <h1 class="page-title">Lupa Password</h1>
    <div class="card center" style="padding:50px 24px">
        <div class="success-check">✓</div>
        <h2>Email Terkirim!</h2>
        <p class="muted">Kami telah mengirim link reset password ke<br><b style="color:white">{{ $email }}</b></p>
        <a class="btn green" href="{{ route('login') }}">Kembali ke Masuk</a>
    </div>
</div></section>
@endsection
