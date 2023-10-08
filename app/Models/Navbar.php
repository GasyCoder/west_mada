<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dropdown',
        'is_active'
    ];

    public function onglets()
    {
        return $this->hasMany(Onglet::class);
    }
}
