<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory;

    // protected $primaryKey = 'id';
    // public $incrementing = false;

    protected $fillable = [
        'year',
        'mois',
        'is_active'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];
    
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->uuid = Str::uuid(); // Generate a UUID for new records
    //     });
    // }
}
