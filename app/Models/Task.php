<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory;

    //protected $primaryKey = 'uuid';
    public $incrementing = true;


    protected $fillable = [
        'user_id',
        'stock_id',
        'category_id',
        'type',
        'quantity',
        'description',
        'period_id',
        'reference',
        'by_date'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->by_date = date('d/m/y');
        });
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function category()
    {
        return $this->belongsTo(CategoryStock::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'created_at' => 'datetime'
    ];



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
