<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServicePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'resume',
        'contenus',
        'is_active',
        'images'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($page) {
            $page->slug = Str::slug($page->name);
        });
    }
}
