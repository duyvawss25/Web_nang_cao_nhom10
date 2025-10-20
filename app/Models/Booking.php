<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Các trường có thể gán hàng loạt
    protected $fillable = [
        'booking_code',
        'flight_id',
        'user_id',
        'passenger_name',
        'passenger_email',
        'passenger_phone',
        'passenger_id_number',
        'seats',
        'status',
        'total_price',
    ];

    // Chuyển đổi kiểu dữ liệu tự động
    protected $casts = [
        'seats' => 'array',
        'total_price' => 'float',
    ];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Flight
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    // Quan hệ với Payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Tự động tạo booking_code khi tạo mới
    protected static function booted()
    {
        static::creating(function ($booking) {
            $booking->booking_code = 'BK' . strtoupper(uniqid());
        });
    }
}
