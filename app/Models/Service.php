<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',    
        'desc'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'service_users');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

}
