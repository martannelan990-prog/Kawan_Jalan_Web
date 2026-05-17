@extends('layouts.app')
@section('title','Kelola Pengguna')
@section('content')
<section class="screen">
    <div class="topbar admin">
        <a class="back" href="{{ route('admin.dashboard') }}">Kembali</a>
        <div>
            <h1 class="title">♙ Kelola Pengguna</h1>
            <p class="small" style="margin:4px 0 0">Manajemen pengguna aplikasi</p>
        </div>
    </div>

    <div class="content stack">
        <div class="grid3">
            <div class="stat"><strong>{{ $totalUsers }}</strong>Total Pengguna</div>
            <div class="stat" style="background:#07382c"><strong style="color:#00ff95">{{ $activeUsers }}</strong>Aktif</div>
            <div class="stat" style="background:#421924"><strong style="color:#ff5367">{{ $bannedUsers }}</strong>Diblokir</div>
        </div>

        <form method="GET" action="{{ route('admin.users') }}" class="admin-search-form">
            <input type="hidden" name="status" value="{{ $status }}">
            <input class="input" name="q" value="{{ $q }}" placeholder="⌕ Cari user berdasarkan nama, email, atau nomor telepon...">
        </form>

        <div class="tabs admin-filter-tabs">
            <a class="{{ $status === 'all' ? 'active' : '' }}" href="{{ route('admin.users', ['status' => 'all', 'q' => $q]) }}">Semua ({{ $totalUsers }})</a>
            <a class="{{ $status === 'active' ? 'active' : '' }}" href="{{ route('admin.users', ['status' => 'active', 'q' => $q]) }}">Aktif ({{ $activeUsers }})</a>
            <a class="{{ $status === 'banned' ? 'active' : '' }}" href="{{ route('admin.users', ['status' => 'banned', 'q' => $q]) }}">Diblokir ({{ $bannedUsers }})</a>
        </div>

        @forelse($users as $u)
            <div class="card admin-user-card" style="border-color:{{ $u->status==='banned'?'#e11d48':'#64748b' }}">
                <div class="row admin-user-row">
                    <div class="row admin-user-info" style="justify-content:flex-start">
                        <span class="avatar {{ $u->status==='banned'?'red':'' }}">{{ strtoupper(substr($u->name,0,1)) }}</span>
                        <div>
                            <b>{{ $u->name }}</b>
                            <span class="chip {{ $u->status==='banned'?'red':'green' }}">{{ $u->status==='banned'?'Diblokir':'Aktif' }}</span><br>
                            <small class="muted">{{ $u->email }}<br>{{ $u->phone ?? '-' }}</small>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.users.ban',$u) }}">
                        @csrf
                        <button class="btn sm {{ $u->status==='banned'?'green':'orange' }}">{{ $u->status==='banned'?'Aktifkan':'Ban' }}</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="card muted small">Tidak ada pengguna yang sesuai dengan pencarian atau filter.</div>
        @endforelse
    </div>
    <x-bottom-nav/>
</section>
@endsection
