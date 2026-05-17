@extends('layouts.app')
@section('title','Laporan Grub Wisata')
@section('content')
<section class="screen">
    <div class="topbar danger">
        <a class="back" href="{{ route('admin.dashboard') }}">Kembali</a>
        <div>
            <h1 class="title">⚠ Laporan Grub Wisata</h1>
            <p class="small" style="margin:4px 0 0">Kelola laporan grub guide bermasalah</p>
        </div>
    </div>

    <div class="content stack">
        <div class="grid3">
            <div class="stat"><strong>{{ $totalReports }}</strong>Total</div>
            <div class="stat" style="background:#3a2217"><strong style="color:#ff9d2e">{{ $pendingReports }}</strong>Menunggu</div>
            <div class="stat" style="background:#07382c"><strong style="color:#38f79a">{{ $resolvedReports }}</strong>Selesai</div>
        </div>

        <form method="GET" action="{{ route('admin.reports') }}" class="admin-search-form">
            <input type="hidden" name="status" value="{{ $status }}">
            <input class="input" name="q" value="{{ $q }}" placeholder="⌕ Cari laporan berdasarkan pemandu, destinasi, pelapor, atau deskripsi...">
        </form>

        <div class="tabs admin-filter-tabs report-tabs">
            <a class="{{ $status === 'all' ? 'active' : '' }}" href="{{ route('admin.reports', ['status' => 'all', 'q' => $q]) }}">Semua ({{ $totalReports }})</a>
            <a class="{{ $status === 'pending' ? 'active' : '' }}" href="{{ route('admin.reports', ['status' => 'pending', 'q' => $q]) }}">Menunggu ({{ $pendingReports }})</a>
            <a class="{{ $status === 'reviewed' ? 'active' : '' }}" href="{{ route('admin.reports', ['status' => 'reviewed', 'q' => $q]) }}">Ditinjau ({{ $reviewedReports }})</a>
            <a class="{{ $status === 'resolved' ? 'active' : '' }}" href="{{ route('admin.reports', ['status' => 'resolved', 'q' => $q]) }}">Selesai ({{ $resolvedReports }})</a>
        </div>

        @forelse($reports as $r)
            <div class="card stack">
                <div class="row">
                    <h3 style="margin:0">{{ $r->guide_name }}</h3>
                    <span class="chip {{ $r->status==='pending'?'orange':($r->status==='resolved'?'green':'blue') }}">
                        {{ $r->status==='pending'?'Menunggu':($r->status==='resolved'?'Selesai':'Ditinjau') }}
                    </span>
                </div>
                <p class="small muted">
                    <b>Destinasi:</b> {{ $r->destination_name }}<br>
                    <b>Nomor Pemandu:</b> {{ $r->guide_phone ?? '-' }}<br>
                    <b>Link Grub Wisata:</b>
                    @if($r->group_link)
                        <a href="{{ $r->group_link }}" target="_blank" rel="noopener">{{ $r->group_link }}</a>
                    @else
                        -
                    @endif
                    <br><b>Pelapor:</b> {{ $r->user->name ?? '-' }} ({{ $r->user->email ?? '-' }})
                </p>
                <p class="small muted">{{ $r->description }}</p>
                <p class="tiny muted">◷ {{ $r->created_at->format('d M Y, H:i') }}</p>
                <form method="POST" action="{{ route('admin.reports.update',$r) }}" class="row admin-report-update">
                    @csrf
                    <select name="status">
                        <option value="pending" @selected($r->status === 'pending')>Menunggu</option>
                        <option value="reviewed" @selected($r->status === 'reviewed')>Ditinjau</option>
                        <option value="resolved" @selected($r->status === 'resolved')>Selesai</option>
                    </select>
                    <button class="btn orange sm">Update</button>
                </form>
            </div>
        @empty
            <div class="card muted small">Tidak ada laporan yang sesuai dengan pencarian atau filter.</div>
        @endforelse
    </div>
    <x-bottom-nav/>
</section>
@endsection
