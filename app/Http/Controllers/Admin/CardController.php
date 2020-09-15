<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Models\Card;
use App\Models\CardContent;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class CardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cards = Card::sortable(['id' => 'desc'])->withContent('ru')->paginate(30);
        return view('admin.cards.list', ['cards' => $cards]);
    }

    public function create()
    {
        $card = new Card();
        $card->active = true;
        $card->is_locked = false;
        return view('admin.cards.create', ['card' => $card]);
    }


    public function store(CardRequest $request)
    {
        $card = new Card();
        $card->fill($request->request->all());

        $card->active = $request->request->has('active') ? 1 : 0;
        $card->is_locked = $request->request->has('is_locked') ? 1 : 0;

        $this->saveImage($card, $request->file('image'));
        $card->save();
        if ($card->id !== null) {
            $this->createContent($card->id, 'ru', $request->input('content.ru') ?? []);
            $this->createContent($card->id, 'en', $request->input('content.en') ?? []);
        }
        return redirect()->route('admin.cards.edit', ['card' => $card->id])->with('success', 'Created');
    }

    protected function saveImage(Card $card, ?UploadedFile $uploadedFile = null)
    {
        if ($uploadedFile !== null) {
            $oldImage = $card->image;
            $hashName = $uploadedFile->hashName();
            $uploadedFile->storeAs(config('settings.card.image_dir'), $hashName, ['disk' => 'public']);
            $card->image = $hashName;
            $this->removeImage($oldImage);
        }
    }

    protected function removeImage(?string $image = null)
    {
        if ($image !== null) {
            Storage::disk('public')->delete(config('settings.card.image_dir') . '/' . $image);
        }
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
                'question' => $data['question'] ?? '',
                'answer' => $data['answer'] ?? '',
            ]
        );
    }


    public function edit(Card $card)
    {
        return view('admin.cards.edit', ['card' => $card]);
    }


    public function update(CardRequest $request, Card $card)
    {
        $card->fill($request->request->all());
        $card->active = $request->request->has('active') ? 1 : 0;
        $card->is_locked = $request->request->has('is_locked') ? 1 : 0;
        $this->saveImage($card, $request->file('image'));
        $card->setUpdatedAt($card->freshTimestamp());
        $card->save();
        if ($card->id !== null) {
            $this->createContent($card->id, 'ru', $request->input('content.ru') ?? []);
            $this->createContent($card->id, 'en', $request->input('content.en') ?? []);
        }

        return back()->with('success', 'Updated');
    }

    public function destroy(Card $card)
    {
        $this->removeImage($card->image);
        $card->delete();
        return redirect()->route('admin.cards.index')->with('success', 'Deleted');
    }
}
