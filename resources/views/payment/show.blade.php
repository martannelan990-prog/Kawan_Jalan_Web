@extends('layouts.app')
@section('title','Pembayaran')
@section('content')
<section class="screen payment-screen">
    <div class="topbar">
        <a class="back" href="{{ $order->destination->city?->slug ? route('city.show',$order->destination->city->slug) : route('home') }}">Kembali</a>
        <h1 class="title">Pembayaran</h1>
    </div>

    <div class="content stack">
        <div class="countdown">
            <span>⏱ Selesaikan pembayaran dalam:</span>
            <span id="timer">{{ $order->payment_deadline ? $order->payment_deadline->diff(now())->format('%I:%S') : '10:00' }}</span>
        </div>

        <form method="POST" action="{{ route('payment.confirm', $order) }}" class="stack" id="payment-form">
            @csrf

            <div class="card stack">
                <h3 style="margin:0">Detail Pesanan</h3>
                <div class="row payment-destination-row" style="justify-content:flex-start">
                    <img class="photo favorite-photo payment-photo" src="{{ asset($order->destination->image ?: ($order->destination->city->image ?? 'assets/kawan/hero.png')) }}" alt="{{ $order->destination->name }}">
                    <div>
                        <b>{{ $order->destination->name }}</b><br>
                        <span class="small muted">{{ $order->destination->city?->name ?? '-' }}</span>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="small stack payment-summary" style="gap:7px">
                    <div class="row"><span class="muted">Harga tiket / orang</span><span>Rp {{ number_format($order->destination->ticket_price,0,',','.') }}</span></div>
                    <div class="row"><span class="muted">Jumlah tiket</span><span id="qtyLabel">1 tiket</span></div>
                    <div class="row"><span class="muted">Biaya Wisata</span><span id="ticketTotal">Rp {{ number_format($order->destination->ticket_price,0,',','.') }}</span></div>
                    <div class="row"><span class="muted">Biaya Pemandu</span><span id="guideFee">Rp {{ number_format(250000,0,',','.') }}</span></div>
                    <div class="row"><span class="muted">Biaya Admin Aplikasi</span><span id="adminFee">Rp {{ number_format(10000,0,',','.') }}</span></div>
                    <div class="row" style="font-weight:900"><span>Total</span><span id="grandTotal" style="color:#58a6ff">Rp {{ number_format($order->total,0,',','.') }}</span></div>
                </div>
            </div>

            <div class="card stack">
                <h3 style="margin:0">Pengaturan Pembelian</h3>

                <div class="selection-card stack">
                    <div>
                        <b>Jumlah Tiket</b>
                        <p class="small muted" style="margin:4px 0 0">Maksimal pembelian 3 tiket dalam satu transaksi.</p>
                    </div>
                    <div class="qty-control">
                        <button type="button" class="qty-btn" data-qty-action="minus">−</button>
                        <input type="number" id="ticket_quantity" name="ticket_quantity" class="qty-input" value="1" min="1" max="3" readonly>
                        <button type="button" class="qty-btn" data-qty-action="plus">+</button>
                    </div>
                    <div id="qtyWarning" class="small error-note" hidden>Maksimal pembelian adalah 3 tiket.</div>
                </div>

                <div class="selection-card stack">
                    <div>
                        <b>Pilihan Layanan</b>
                        <p class="small muted" style="margin:4px 0 0">Jika memilih tambah pemandu wisata, Anda akan mendapatkan barcode grup wisata.</p>
                    </div>
                    <label class="purchase-option">
                        <input type="radio" name="purchase_type" value="tiket">
                        <span>
                            <b>Hanya Beli Tiket</b>
                            <small class="muted">Tanpa barcode grup wisata</small>
                        </span>
                    </label>
                    <label class="purchase-option">
                        <input type="radio" name="purchase_type" value="guide" checked>
                        <span>
                            <b>Tambah Pemandu Wisata</b>
                            <small class="muted">Mendapat barcode grup wisata + biaya Rp 250.000</small>
                        </span>
                    </label>
                </div>
            </div>

            <div class="card stack">
                <h3 style="margin:0">Metode Pembayaran</h3>
                <label class="payment-option-card active-payment-option">
                    <input type="radio" name="payment_method" value="QRIS" checked>
                    <div>
                        <b>QRIS</b>
                        <p class="small muted" style="margin:4px 0 0">Scan untuk membayar</p>
                    </div>
                    <span class="payment-check">✓</span>
                </label>
                <div class="qr-wrap">
                    <img class="payment-qr-img" src="{{ asset('assets/kawan/barcode-pembayaran.png') }}" alt="Barcode pembayaran QRIS">
                    <p class="small muted">Scan kode QR ini di aplikasi pembayaran Anda.</p>
                </div>
            </div>

            <button class="btn" type="submit">Konfirmasi Pembayaran</button>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
    (function () {
        var timer = document.getElementById('timer');
        if (timer && window.startCountdown) {
            window.startCountdown(timer, @json(optional($order->payment_deadline)->toIso8601String()));
        }

        var quantityInput = document.getElementById('ticket_quantity');
        var warning = document.getElementById('qtyWarning');
        var ticketPrice = {{ (int) $order->destination->ticket_price }};
        var guideFeeValue = 250000;
        var adminFeeValue = 10000;
        var qtyLabel = document.getElementById('qtyLabel');
        var ticketTotal = document.getElementById('ticketTotal');
        var guideFee = document.getElementById('guideFee');
        var adminFee = document.getElementById('adminFee');
        var grandTotal = document.getElementById('grandTotal');

        function formatRupiah(value) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
        }

        function selectedPurchaseType() {
            var checked = document.querySelector('input[name="purchase_type"]:checked');
            return checked ? checked.value : 'guide';
        }

        function updateSummary() {
            var quantity = parseInt(quantityInput.value || '1', 10);
            var includeGuide = selectedPurchaseType() === 'guide';
            var totalTicket = ticketPrice * quantity;
            var totalGuide = includeGuide ? guideFeeValue : 0;
            var total = totalTicket + totalGuide + adminFeeValue;

            qtyLabel.textContent = quantity + ' tiket';
            ticketTotal.textContent = formatRupiah(totalTicket);
            guideFee.textContent = formatRupiah(totalGuide);
            adminFee.textContent = formatRupiah(adminFeeValue);
            grandTotal.textContent = formatRupiah(total);
        }

        function setQuantity(nextValue) {
            if (nextValue > 3) {
                quantityInput.value = 3;
                warning.hidden = false;
                updateSummary();
                return;
            }
            if (nextValue < 1) {
                nextValue = 1;
            }
            warning.hidden = true;
            quantityInput.value = nextValue;
            updateSummary();
        }

        document.querySelectorAll('[data-qty-action]').forEach(function (button) {
            button.addEventListener('click', function () {
                var current = parseInt(quantityInput.value || '1', 10);
                setQuantity(current + (button.dataset.qtyAction === 'plus' ? 1 : -1));
            });
        });

        document.querySelectorAll('input[name="purchase_type"]').forEach(function (radio) {
            radio.addEventListener('change', updateSummary);
        });

        updateSummary();
    })();
</script>
@endpush
