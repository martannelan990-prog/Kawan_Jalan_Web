<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\NotificationItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private const GUIDE_FEE = 250000;
    private const ADMIN_FEE = 10000;

    public function create(Destination $destination)
    {
        $calculation = $this->calculateTotals($destination, 1, true);

        $order = Order::create([
            'user_id' => Auth::id(),
            'destination_id' => $destination->id,
            'guide_name' => 'Pemandu Kawan Jalan',
            'guide_phone' => '0812-3456-7890',
            'ticket_price' => $calculation['ticket_price'],
            'guide_fee' => $calculation['guide_fee'],
            'admin_fee' => $calculation['admin_fee'],
            'ticket_quantity' => 1,
            'include_guide' => true,
            'total' => $calculation['total'],
            'status' => 'pending',
            'payment_method' => 'QRIS',
            'payment_deadline' => now()->addMinutes(10),
        ]);

        return redirect()->route('payment.show', $order);
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        $order->load('destination.city');

        return view('payment.show', compact('order'));
    }

    public function confirm(Request $request, Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        $order->load('destination.city');

        $data = $request->validate([
            'ticket_quantity' => ['required', 'integer', 'min:1', 'max:3'],
            'purchase_type' => ['required', 'in:tiket,guide'],
            'payment_method' => ['required', 'in:QRIS'],
        ], [
            'ticket_quantity.max' => 'Maksimal pembelian adalah 3 tiket.',
        ]);

        $includeGuide = $data['purchase_type'] === 'guide';
        $calculation = $this->calculateTotals($order->destination, (int) $data['ticket_quantity'], $includeGuide);
        $code = 'TM' . strtoupper(Str::random(8));

        $order->update([
            'ticket_price' => $calculation['ticket_price'],
            'guide_fee' => $calculation['guide_fee'],
            'admin_fee' => $calculation['admin_fee'],
            'ticket_quantity' => (int) $data['ticket_quantity'],
            'include_guide' => $includeGuide,
            'guide_name' => $includeGuide ? 'Pemandu Kawan Jalan' : null,
            'guide_phone' => $includeGuide ? '0812-3456-7890' : null,
            'total' => $calculation['total'],
            'status' => 'paid',
            'payment_method' => $data['payment_method'],
            'paid_at' => now(),
            'ticket_code' => $code,
            'group_barcode' => $includeGuide ? 'GRP-' . $code : null,
        ]);

        NotificationItem::create([
            'user_id' => Auth::id(),
            'title' => 'Booking Berhasil!',
            'message' => 'Booking Anda untuk ' . $order->destination->name . ' telah dikonfirmasi.',
            'type' => 'success',
        ]);

        return redirect()->route('payment.success', $order);
    }

    public function success(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        $order->load('destination.city');

        return view('payment.success', compact('order'));
    }

    private function calculateTotals(Destination $destination, int $ticketQuantity, bool $includeGuide): array
    {
        $ticketPrice = $destination->ticket_price * $ticketQuantity;
        $guideFee = $includeGuide ? self::GUIDE_FEE : 0;
        $adminFee = self::ADMIN_FEE;

        return [
            'ticket_price' => $ticketPrice,
            'guide_fee' => $guideFee,
            'admin_fee' => $adminFee,
            'total' => $ticketPrice + $guideFee + $adminFee,
        ];
    }
}
