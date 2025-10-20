<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    
    // Tên bảng trong database (mặc định Laravel sẽ là 'flights')
    protected $table = 'flights'; 

    // Các trường có thể được gán giá trị hàng loạt (Mass Assignable)
    protected $fillable = [
        'flight_number',
        'departure_airport_id',
        'arrival_airport_id',
        'departure_time',
        'arrival_time',
        'price',
        'available_seats',
    ];

    // Định nghĩa mối quan hệ (Relationships)
    // Giả sử bạn có model Airport
    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }
}
