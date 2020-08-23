<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getImageUrlAttribute($image)
    {
        if ($this->attributes['image'] === null) {
            return null;
        }
        return Storage::disk('public')->url(config('settings.card.image_dir') . '/' . $this->attributes['image']);
    }

}
