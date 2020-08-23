<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\CardContent;
use Illuminate\Http\Request;

class CardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cards = Card::withContent('ru')->paginate(2);
        return view('admin.cards.list', ['cards' => $cards]);
    }

    public function create()
    {
        return view('admin.cards.create', ['card' => new Card()]);
    }


    public function store(Request $request)
    {
        $card = new Card();
        $card->image = uniqid('', true);
        $card->save();
        if ($card->id !== null) {
            $this->createContent($card->id, 'ru', $request->input('content.ru') ?? []);
            $this->createContent($card->id, 'en', $request->input('content.en') ?? []);
        }
        return back()->with('success', 'Created');
    }

    protected function createContent(int $cardId, string $lang, $data = [])
    {
        CardContent::updateOrCreate(
            [
                'lang' => $lang,
                'card_id' => $cardId
            ],
            [
                'lang' => $lang,
                'card_id' => $cardId,
                'title' => $data['title'] ?? '',
                'description' => $data['description'] ?? ''
            ]
        );
    }


    public function edit(Card $card)
    {
        return view('admin.cards.edit', ['card' => $card]);
    }


    public function update(Request $request, Card $card)
    {
        $card->image = uniqid('', true);
        $card->save();
        if ($card->id !== null) {
            $this->createContent($card->id, 'ru', $request->input('content.ru') ?? []);
            $this->createContent($card->id, 'en', $request->input('content.en') ?? []);
        }
        return back()->with('success', 'Updated');
    }

    public function destroy(Card $card)
    {
        $card->delete();
        return redirect()->route('admin.cards.index')->with('success', 'Deleted');
    }
}
