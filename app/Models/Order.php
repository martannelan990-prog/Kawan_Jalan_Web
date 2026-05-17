<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination_id',
        'guide_name',
        'guide_phone',
        'ticket_price',
        'guide_fee',
        'admin_fee',
        'ticket_quantity',
        'include_guide',
        'total',
        'status',
        'payment_method',
        'payment_deadline',
        'paid_at',
        'ticket_code',
        'group_barcode',
    ];

    protected $casts = [
        'payment_deadline' => 'datetime',
        'paid_at' => 'datetime',
        'ticket_quantity' => 'integer',
        'include_guide' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function getValidUntilAttribute(): ?Carbon
    {
        return $this->paid_at ? $this->paid_at->copy()->addWeek() : null;
    }

    public function isTicketValid(): bool
    {
        return $this->status === 'paid' && $this->valid_until && now()->lt($this->valid_until);
    }

    public function getDisplayStatusAttribute(): string
    {
        return $this->isTicketValid() ? 'Terjadwal' : 'Tidak Valid';
    }

    public function getValidityCountdownAttribute(): ?string
    {
        if (!$this->valid_until) {
            return null;
        }

        if (now()->gte($this->valid_until)) {
            return 'Masa berlaku tiket telah habis';
        }

        $diff = now()->diff($this->valid_until);
        $parts = [];

        if ($diff->d > 0) {
            $parts[] = $diff->d . ' hari';
        }
        if ($diff->h > 0) {
            $parts[] = $diff->h . ' jam';
        }
        if ($diff->i > 0 && count($parts) < 2) {
            $parts[] = $diff->i . ' menit';
        }

        return 'Berlaku ' . implode(' ', $parts);
    }

}

