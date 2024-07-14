<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store_Game extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "store_game";
    protected $fillable = [
        'coupon_id',
        'user_id',
        'game_number',
        'game_code',
        'count',
        'date',
        'pay_order_id',
        'payment',
    ];

    /**
     * Get the user that owns the winner.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the coupon associated with the winner.
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}
