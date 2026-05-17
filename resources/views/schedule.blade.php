@extends('layouts.app')
@section('title', 'Jadwal')

@section('content')
<section class="screen schedule-screen">
    <div class="content">
        <div class="page-head schedule-head">
            <div>
                <h1 class="page-title">Jadwal Perjalanan</h1>
                <p class="small muted">Lihat aktivitas wisata yang akan datang</p>
            </div>
            <img class="logo-sm page-logo" src="{{ asset('assets/kawan/logo.png') }}" alt="Kawan Jalan">
        </div>

        <div class="schedule-list ticket-list">
            @forelse($orders as $o)
                <article class="card schedule-card ticket-card">
                    <img class="photo ticket-thumb" src="{{ asset($o->destination->image ?: ($o->destination->city->image ?? 'assets/kawan/hero.png')) }}" alt="{{ $o->destination->name }}">

                    <div class="ticket-content">
                        <div class="row ticket-top-row">
                            <div>
                                <h3>{{ $o->destination->name }}</h3>
                                <p class="small muted ticket-city">{{ $o->destination->city?->name ?? 'Bogor' }}</p>
                            </div>
                            <span class="chip blue">{{ $o->display_status }}</span>
                        </div>

                        <div class="small muted ticket-meta">
                            <span>📍 {{ $o->destination->location ?? ($o->destination->city?->name ?? '-') }}</span>
                            <span>🗓 Tanggal beli: {{ $o->paid_at?->format('d M Y') ?? now()->format('d M Y') }}</span>
                            <span>🎫 Jumlah tiket: {{ $o->ticket_quantity }} orang</span>
                            <span>🧾 Layanan: {{ $o->include_guide ? 'Tiket + Pemandu Wisata' : 'Hanya Tiket' }}</span>
                        </div>

                        <div class="ticket-extra-grid">
                            <div class="ticket-inline-box">
                                <span class="tiny muted">Kode E-Tiket</span>
                                <b>{{ $o->ticket_code ?? '-' }}</b>
                            </div>
                            <div class="ticket-inline-box">
                                <span class="tiny muted">Berlaku sampai</span>
                                <b>{{ optional($o->valid_until)->format('d M Y H:i') ?? '-' }}</b>
                            </div>
                        </div>

                        <div class="validity-box">
                            <div>
                                <b>Status tiket</b>
                                <p class="small muted" style="margin:4px 0 0">Tiket valid selama 1 minggu sejak pembayaran.</p>
                            </div>
                            <span class="count-chip" data-validity-timer data-deadline="{{ optional($o->valid_until)->toIso8601String() }}">{{ $o->validity_countdown }}</span>
                        </div>

                        <div class="barcode-grid">
                            <div class="ticket-barcode-box">
                                <h4>Barcode Tiket</h4>
                                <div class="barcode compact"></div>
                                <p class="tiny muted">{{ $o->ticket_code }}</p>
                            </div>

                            @if($o->include_guide && $o->group_barcode)
                                @php($waLink = 'https://chat.whatsapp.com/H1s4PbpZNWhCubKPZyW6GR')
                                <div class="ticket-barcode-box schedule-group-barcode-box">
                                    <h4>Barcode Grup</h4>
                                    <div class="schedule-group-qr-wrap">
                                        <img class="schedule-group-qr-img" src="{{ asset('assets/kawan/barcode-link-whatsapp.png') }}" alt="Barcode link WhatsApp grup wisata">
                                    </div>
                                    <div class="schedule-wa-link-row">
                                        <button class="schedule-copy-btn" type="button" data-copy-link="{{ $waLink }}" aria-label="Salin link grup WhatsApp">⧉</button>
                                        <p class="tiny muted schedule-wa-link-text">{{ $waLink }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <div class="card empty-schedule">
                    <p class="muted" style="margin:0">Belum ada tiket wisata yang masih aktif. Tiket yang sudah lewat masa berlakunya akan otomatis berpindah ke riwayat kunjungan wisata.</p>
                </div>
            @endforelse
        </div>
    </div>
    <x-bottom-nav/>
</section>
@endsection

@push('scripts')
<script>
    (function () {
        function formatRemaining(targetDate) {
            var diff = new Date(targetDate) - new Date();
            if (diff <= 0) {
                return 'Masa berlaku tiket telah habis';
            }
            var totalMinutes = Math.floor(diff / 60000);
            var days = Math.floor(totalMinutes / (60 * 24));
            var hours = Math.floor((totalMinutes % (60 * 24)) / 60);
            var minutes = totalMinutes % 60;
            var parts = [];
            if (days > 0) parts.push(days + ' hari');
            if (hours > 0) parts.push(hours + ' jam');
            if (minutes > 0 && parts.length < 2) parts.push(minutes + ' menit');
            return 'Berlaku ' + parts.join(' ');
        }

        function showThemeToast(message) {
            var old = document.querySelector('.toast-notify.dynamic');
            if (old) old.remove();
            var toast = document.createElement('div');
            toast.className = 'toast-notify dynamic show';
            toast.textContent = message;
            document.body.appendChild(toast);
            setTimeout(function () { toast.classList.remove('show'); setTimeout(function(){ toast.remove(); }, 250); }, 2800);
        }

        document.addEventListener('click', function (event) {
            var copyButton = event.target.closest('[data-copy-link]');
            if (!copyButton) return;
            var link = copyButton.dataset.copyLink;
            if (navigator.clipboard) {
                navigator.clipboard.writeText(link).then(function () { showThemeToast('link grub telah tersalin'); });
            } else {
                var input = document.createElement('input');
                input.value = link;
                document.body.appendChild(input);
                input.select();
                document.execCommand('copy');
                input.remove();
                showThemeToast('link grub telah tersalin');
            }
        });

        document.querySelectorAll('[data-validity-timer]').forEach(function (node) {
            var deadline = node.dataset.deadline;
            if (!deadline) return;

            function tick() {
                node.textContent = formatRemaining(deadline);
            }

            tick();
            setInterval(tick, 60000);
        });
    })();
</script>
@endpush
