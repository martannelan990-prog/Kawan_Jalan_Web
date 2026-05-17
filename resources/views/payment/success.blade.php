@extends('layouts.app')
@section('title','Pembayaran Berhasil')
@section('content')
<section class="screen">
    <div class="content stack center" style="padding-top:28px">
        <h2 class="muted">Pembayaran Berhasil!</h2>
        <div class="success-check">✓</div>
        <p class="muted">Terima kasih telah melakukan pembayaran</p>

        <div class="card stack" style="text-align:left">
            <div class="row" style="justify-content:flex-start">
                <img class="photo favorite-photo payment-photo" src="{{ asset($order->destination->image ?: ($order->destination->city->image ?? 'assets/kawan/hero.png')) }}" alt="{{ $order->destination->name }}">
                <div>
                    <b>{{ $order->destination->name }}</b><br>
                    <span class="small muted">{{ $order->destination->city?->name ?? '-' }}</span><br>
                    <span class="tiny" style="color:#57a6ff">Kode Tiket: {{ $order->ticket_code }}</span>
                </div>
            </div>
            <div class="divider"></div>
            <div class="small stack" style="gap:7px">
                <div class="row"><span>Jumlah Tiket</span><b>{{ $order->ticket_quantity }} tiket</b></div>
                <div class="row"><span>Layanan</span><b>{{ $order->include_guide ? 'Tiket + Pemandu Wisata' : 'Hanya Tiket' }}</b></div>
                <div class="row"><span>Total Dibayar</span><b>Rp {{ number_format($order->total,0,',','.') }}</b></div>
                <div class="row"><span>Masa Berlaku Tiket</span><b>{{ optional($order->valid_until)->format('d M Y H:i') }}</b></div>
            </div>
            <div class="validity-box">
                <div>
                    <b>Status tiket</b>
                    <p class="small muted" style="margin:4px 0 0">Tiket berlaku selama 1 minggu setelah pembayaran.</p>
                </div>
                <span class="count-chip" data-validity-timer data-deadline="{{ optional($order->valid_until)->toIso8601String() }}">{{ $order->validity_countdown }}</span>
            </div>
        </div>

        <div class="barcode-grid success-barcode-grid">
            <div class="card stack">
                <h3 style="margin:0">Barcode Tiket Anda</h3>
                <div class="qr-wrap">
                    <div class="barcode"></div>
                    <p class="tiny muted">{{ $order->ticket_code }}</p>
                </div>
                <p class="tiny muted">Tunjukkan barcode tiket ini kepada petugas saat berkunjung.</p>
            </div>

            @if($order->include_guide && $order->group_barcode)
                <div class="card stack">
                    <h3 style="margin:0">Barcode Grup Wisata</h3>
                    <div class="qr-wrap">
                        <img class="group-qr-img" src="{{ asset('assets/kawan/barcode-link-whatsapp.png') }}" alt="Barcode link WhatsApp grup wisata">
                        <p class="tiny muted">{{ $order->group_barcode }}</p>
                    </div>
                    <p class="tiny muted">Scan barcode grup untuk bergabung dengan grup WhatsApp wisata.</p>
                </div>
            @endif
        </div>

        @if($order->include_guide)
            <div class="wa-card stack" style="text-align:left">
                <h3 style="margin:0">💬 Grup WhatsApp Wisata</h3>
                <p class="small">Bergabunglah dengan grup WhatsApp untuk koordinasi dengan pemandu dan peserta lainnya.</p>
                @php($waLink = 'https://chat.whatsapp.com/H1s4PbpZNWhCubKPZyW6GR')
                <div class="inner small wa-link-box">
                    <span>Link Grup:<br><b id="waGroupLink">{{ $waLink }}</b></span>
                    <button class="btn sm gray" type="button" data-copy-link="{{ $waLink }}">Salin</button>
                </div>
                <div class="row">
                    <a class="btn sm" style="background:#004b25" href="{{ $waLink }}" target="_blank" rel="noopener">Buka Grup</a>
                    <button class="btn sm" style="background:#1db954" type="button" data-copy-link="{{ $waLink }}">Bagikan</button>
                </div>
            </div>
        @endif

        <a class="btn outline" href="{{ route('schedule') }}">Lihat E-Tiket Saya</a>
        <a class="btn" href="{{ route('home') }}">Kembali ke Beranda</a>
    </div>
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
                navigator.clipboard.writeText(link).then(function () { showThemeToast('Link grub telah tersalin'); });
            } else {
                var input = document.createElement('input');
                input.value = link;
                document.body.appendChild(input);
                input.select();
                document.execCommand('copy');
                input.remove();
                showThemeToast('Link grub telah tersalin');
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
