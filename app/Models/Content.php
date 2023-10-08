<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'sub_title',
        'onglet_id',
        'slug',
        'description',
        'liste_1',
        'liste_2',
        'liste_3',
        'liste_4',
        'url',
        'images',
        'is_publish',
        'is_slider'
    ];

    public function onglet()
    {
        return $this->belongsTo(Onglet::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($page) {
            $page->slug = Str::slug($page->title);
        });
    }
}
