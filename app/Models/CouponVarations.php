<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponVarations extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon_id',
        'parent_sku',
        'coupon_code',
        'varation_sku',
    ];


    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
