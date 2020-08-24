<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardContent extends Model
{
    protected $fillable = ['card_id', 'lang', 'title', 'question', 'answer'];
}
