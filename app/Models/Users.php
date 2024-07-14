<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'percentage',
        'valid',
        'website_url',
        'is_hidden',
        'description',
        'details',
        'usage_limit',
        'price',
        'image',
        'start_date',
        'expiration_date',
        'sku',
        'categories',
        'store',
        'brand',
    ];

    // You may need to specify date fields for automatic casting
    protected $dates = [
        'start_date',
        'expiration_date',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
