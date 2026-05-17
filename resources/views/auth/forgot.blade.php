@extends('layouts.app')
@section('title','Lupa Password')
@section('content')
<section class="screen forgot-screen"><div class="content stack forgot-wrap">
    <a class="back" href="{{ route('login') }}">Kembali ke Masuk</a>
    <h1 class="page-title">Lupa Password</h1>
    <p>Masukkan email Anda untuk mengatur ulang password</p>
    <form method="POST" action="{{ route('password.email') }}" class="card stack forgot-card kj-validated-form" novalidate>
        @csrf
        <label>Alamat Email</label>
        <div class="field-wrap">
            <input class="input auth" type="text" name="email" placeholder="Masukkan email Anda"
                   data-required="Email wajib diisi gaboleh kosong."
                   data-email="Email wajib menggunakan tanda @.">
        </div>
        <button class="btn green">Kirim Link Reset</button>
    </form>
</div></section>
@endsection
