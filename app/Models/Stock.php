<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Stock extends Model
{
    use HasFactory;
    public $incrementing = true;

    protected $fillable = [
        'reference',
        'name', 
        'category_id', 
        'service_id', 
        'stock_quantity', 
        'price_u',
        'min_quantity',
        'max_quantity',
        'unite_stock',
        'description',
        'is_active',
    ];

    public function task()
    {
        return $this->hasOne(Task::class);
    }

    public function updateStatus()
    {
        if ($this->stock_quantity <= 0) {
            $this->is_active = false; // Désactive le stock
            // Vous pouvez également ajouter d'autres logiques si nécessaire, par exemple, envoyer une notification.
        } elseif ($this->stock_quantity > 0){
            $this->is_active = true; // Active le stock
        }
        $this->save();
    }


    public function categorie()
    {
        return $this->belongsTo(CategoryStock::class, 'category_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid(); // Generate a UUID for new records
        });
    }

    public function getSimpleNumberAttribute()
    {
        $uuid = $this->attributes['uuid'];

        // Remove hyphens from the UUID
        $uuidWithoutHyphens = str_replace('-', '', $uuid);

        // Extract only the numeric part (assuming it follows letters)
        $numericPart = preg_replace('/[^0-9]/', '', $uuidWithoutHyphens);

        // Limit the numeric value to four characters
        $limitedNumericValue = substr($numericPart, -4);

        return (int)$limitedNumericValue;
    }

    // In your JournalStock model, override the 'booted' method to update the 'simple_number' column
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->reference = $model->getSimpleNumberAttribute();
        });

        static::updating(function ($model) {
            $model->reference = $model->getSimpleNumberAttribute();
        });
    }
}
