<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{

    public function list(Request $request)
    {
        $offset = $request->query->getInt('offset');
        $limit = $request->query->getInt('limit');
        $lang = $request->query->get('lang') === 'en' ? 'en' : 'ru';

        $cards = Card::query()->offset($offset)->limit($limit)->withContent($lang)->get()
            ->map(
                function (Card $card) use ($lang) {
                    $content = optional($card->getContent($lang));
                    return [
                        'id' => $card->id,
                        'image' => $card->imageUrl,
                        'title' => $content->title,
                        'description' => $content->description,
                    ];
                }
            )->toArray();
        return new JsonResponse($cards);
    }

}
