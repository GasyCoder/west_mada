<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageType extends Model
{
    use HasFactory;

    protected $table = 'pages_type';

    protected $enum = [
        'type' => ['apropos_de_nous', 'politique_de_confidentialite', 'mentions_legale', 'conditions_des_services', 'autres'],
    ];

    protected $fillable = [
        'title',
        'type',
        'sub_title',
        'contenus',
        'is_active'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($page) {
            $page->slug = Str::slug($page->title);  
        });
    }
}
