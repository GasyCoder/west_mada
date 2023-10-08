<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'room_type_id',
        'nbre_persone',
        'tarif',
        'is_active',
        'include',
        'disponible'
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function include()
    {
        return $this->belongsTo(Included::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'hotel_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'hotel_id');
    }

    // public function scopeAdmitted($query)
    // {
    //     return $query->where('is_active', true);
    // }
}
