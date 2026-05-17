@extends('layouts.app')
@section('title','Riwayat Wisata')
@section('content')
<section class="screen profile-history-screen">
    <div class="content stack">
        <div class="page-head">
            <a class="back" href="{{ route('profile') }}">Kembali</a>
            <img class="logo-sm page-logo" src="{{ asset('assets/kawan/logo.png') }}" alt="Kawan Jalan">
        </div>

        <div>
            <h1 class="page-title">Riwayat Kunjungan Wisata</h1>
            <p class="small muted">Semua history kunjungan yang pernah dibeli oleh pengguna akan tampil di halaman ini.</p>
        </div>

        <div class="notice history-info-note">
            <b>Keterangan status tiket</b>
            <p class="small muted" style="margin:8px 0 0">Jika tiket masih valid kurang dari 1 minggu sejak pembayaran, status akan tampil <b>Terjadwal</b>. Jika sudah melewati 1 minggu, status akan berubah menjadi <b>Tidak Valid</b>.</p>
        </div>

        <div class="schedule-list ticket-list history-list">
            @forelse($orders as $o)
                @php($isValid = $o->isTicketValid())
                <article class="card schedule-card ticket-card history-card">
                    <img class="photo ticket-thumb" src="{{ asset($o->destination->image ?: ($o->destination->city->image ?? 'assets/kawan/hero.png')) }}" alt="{{ $o->destination->name }}">

                    <div class="ticket-content">
                        <div class="row ticket-top-row">
                            <div>
                                <h3>{{ $o->destination->name }}</h3>
                                <p class="small muted ticket-city">{{ strtoupper($o->destination->city?->name ?? 'Bogor') }}</p>
                            </div>
                            <span class="chip {{ $isValid ? 'blue' : 'red' }}">{{ $o->display_status }}</span>
                        </div>

                        <div class="small muted ticket-meta">
                            <span>📍 {{ $o->destination->location ?? '-' }}</span>
                            <span>🗓 Tanggal pembelian: {{ $o->paid_at?->format('d M Y') }}</span>
                            <span>🎫 Jumlah tiket: {{ $o->ticket_quantity }} orang</span>
                            <span>🧾 Layanan: {{ $o->include_guide ? 'Tiket + Pemandu Wisata' : 'Hanya Tiket' }}</span>
                        </div>

                        <div class="ticket-extra-grid">
                            <div class="ticket-inline-box">
                                <span class="tiny muted">Kode E-Tiket</span>
                                <b>{{ $o->ticket_code ?? '-' }}</b>
                            </div>
                            <div class="ticket-inline-box">
                                <span class="tiny muted">Masa berlaku sampai</span>
                                <b>{{ optional($o->valid_until)->format('d M Y H:i') ?? '-' }}</b>
                            </div>
                        </div>

                        <div class="ticket-bottom-row">
                            <b class="ticket-price">Rp {{ number_format($o->total,0,',','.') }}</b>
                            <span class="small muted">{{ $isValid ? $o->validity_countdown : 'Tiket sudah tidak aktif' }}</span>
                        </div>
                    </div>
                </article>
            @empty
                <div class="card muted small">Belum ada riwayat wisata.</div>
            @endforelse
        </div>
    </div>
    <x-bottom-nav/>
</section>
@endsection
