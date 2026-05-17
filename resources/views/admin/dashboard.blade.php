@extends('layouts.app')
@section('title','Panel Admin')
@section('content')
<section class="screen">
    <div class="topbar admin">
        <a class="back" href="{{ route('settings') }}">Kembali</a>
        <div>
            <h1 class="title">🔧 Panel Admin</h1>
            <p class="small" style="margin:4px 0 0">Kelola sistem wisata</p>
        </div>
    </div>

    <div class="content stack admin-dashboard-content">
        <div class="admin-card admin-summary-card">
            <h2>↗ Ringkasan Sistem</h2>
            <div class="admin-summary-grid">
                <div class="admin-summary-item">
                    <span>Total Pengguna</span>
                    <strong>{{ $users }}</strong>
                </div>
                <div class="admin-summary-item">
                    <span>Laporan Pending</span>
                    <strong>{{ $pendingReports }}</strong>
                </div>
                <div class="admin-summary-item">
                    <span>Transaksi Hari Ini</span>
                    <strong>{{ $todayTransactions }}</strong>
                    <small>Biaya Admin: Rp {{ number_format($todayAdminFee,0,',','.') }}</small>
                </div>
                <div class="admin-summary-item">
                    <span>Transaksi 30 Hari</span>
                    <strong>{{ $last30Transactions }}</strong>
                    <small>Biaya Admin: Rp {{ number_format($last30AdminFee,0,',','.') }}</small>
                </div>
                <div class="admin-summary-item wide">
                    <span>Total Pendapatan Website</span>
                    <strong>Rp {{ number_format($totalAdminFee,0,',','.') }}</strong>
                    <small>Dari Biaya Admin Aplikasi seluruh tiket yang dibeli pengguna</small>
                </div>
            </div>
        </div>

        <h3>Menu Administrasi</h3>

        <a class="card row admin-link" href="{{ route('admin.users') }}">
            <span class="row" style="justify-content:flex-start">
                <span class="round-icon">♙</span>
                <span>
                    <b>Kelola Pengguna</b><br>
                    <small class="muted">Manajemen user wisatawan</small>
                </span>
            </span>
            <span class="chip" style="background:#8b00ff;color:white">{{ $users }}</span>
        </a>

        <a class="card row admin-link" href="{{ route('admin.reports') }}">
            <span class="row" style="justify-content:flex-start">
                <span class="round-icon" style="background:#3a2514;color:#f97316">ⓘ</span>
                <span>
                    <b>Laporan Grup Wisata</b><br>
                    <small class="muted">Kelola laporan guide bermasalah</small>
                </span>
            </span>
            <span class="chip orange">{{ $pendingReports }} Pending</span>
        </a>

        <h3>Aktivitas Terbaru</h3>
        <div class="card small">
            <p>🟢 Sistem berjalan normal</p>
            <p>🔵 {{ $users }} user terdaftar</p>
            <p>🟠 {{ $pendingReports }} laporan menunggu review</p>
            <p>💳 {{ $totalTransactions }} transaksi pembayaran berhasil</p>
        </div>
    </div>

    <x-bottom-nav/>
</section>
@endsection
