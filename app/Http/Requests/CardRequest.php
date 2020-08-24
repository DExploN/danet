<?php

namespace App\Http\Requests;

use App\Models\Card;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content.ru.title' => ['required', 'max:255', 'min:3'],
            'image' => ['image', 'file', 'max:1024'],
            'difficulty' => ['required', Rule::in(Card::DIFFICULTY)],
            'average_time' => ['integer']
        ];
    }

    public function attributes()
    {
        return ['content.ru.title' => 'title ru'];
    }
}
