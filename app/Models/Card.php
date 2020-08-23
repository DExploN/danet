<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['image'];

    public function contents()
    {
        return $this->hasMany(CardContent::class);
    }

    public function scopeWithContent($query, $lang)
    {
        return $query->with(
            [
                'contents' => function ($query) use ($lang) {
                    $query->whereLang($lang);
                }
            ]
        );
    }

    public function getContent(string $lang)
    {
        return $this->contents->firstWhere('lang', $lang);
    }

}
