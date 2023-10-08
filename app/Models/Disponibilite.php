<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    use HasFactory; 

    protected $table = 'disponibilites';
    protected $dates = ['date_debut', 'date_fin'];

    protected $fillable = [
        'hotel_id',
        'checkin',
        'date_debut',
        'date_fin',
        'checkout',
        'disponible',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

}
