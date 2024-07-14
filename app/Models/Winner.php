<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "winner";
    protected $fillable = [
        'gameType',
        'gameCode',
        'coupon_id',
        'user_id',
        'winningAnswer',
        'winningDate',
        'seen',
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
        return $this->belongsTo(Coupon::class, 'GameCode');
    }
}
