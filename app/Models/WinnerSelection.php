<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WinnerSelection extends Model
{
    use HasFactory;

    protected $table = "winner_selections";
    protected $fillable = [
        'number_winner',
        'alphabet_winner',
        'game_code_num',
        'game_code_alph',
        'publish_date',
    ];

}
