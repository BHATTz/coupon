<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCouponVariation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'coupon_variation_id']; // Changed this line

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function couponVariation() // Changed this line
    {
        return $this->belongsTo(CouponVarations::class, 'coupon_variation_id'); // Changed this line
    }
}
