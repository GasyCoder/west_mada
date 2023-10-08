<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Onglet extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'navbar_id',
        'is_active',
        'is_slider'
    ];

    public function navbar()
    {
        return $this->belongsTo(Navbar::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($onglet) {
            $onglet->slug = Str::slug($onglet->name);
        });
    }
}
