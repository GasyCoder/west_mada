<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model 
{
    use HasFactory;

    protected $table = 'reservations';
    protected $appends = ['time_diff']; 

    protected $fillable = [
        'user_id',
        'ref',
        'client_name',
        'hotel_id',
        'date_debut',
        'checkin',
        'date_fin',
        'checkout',
        'phone',
        'sexe',
        'pourcent',
        'montant',
        'description',
        'statut',
        'email',
        'is_active',
        'deleted'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'checkin' => 'datetime',
        'checkout' => 'datetime'
    ];
    
    public function getTimeDiffAttribute()
    {
        // Calculer la différence de temps entre la date de création et maintenant
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($booking) {
            $booking->ref = random_int(1000, 9999); // Generate random integer reference
        });
    }
}
