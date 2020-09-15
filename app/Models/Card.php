<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Kyslik\ColumnSortable\Sortable;

class Card extends Model
{
    use Sortable;

    public const DIFFICULTY = ["EASY", "MEDIUM", "HARD"];
    protected $fillable = ['image', 'difficulty', 'average_time'];

    public $sortable = [
        'id',
        'active',
        'is_locked'
    ];

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
