<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Storie extends Model
{
    use HasFactory;
    protected $appends = ['time_diff'];

    protected $fillable = [
        'images',
        'is_active'
    ];

    public function getTimeDiffAttribute()
    {
        // Calculer la différence de temps entre la date de création et maintenant
        return Carbon::parse($this->created_at)->diffForHumans();
    }
    
}
