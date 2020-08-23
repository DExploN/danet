<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'image' => ['image', 'file', 'size:1024']
        ];
    }

    public function attributes()
    {
        return ['content.ru.title' => 'title ru'];
    }
}
