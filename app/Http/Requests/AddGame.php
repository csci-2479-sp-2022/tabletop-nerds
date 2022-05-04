<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddGame extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'complexity_rating' => 'required|numeric',
            'cost' => 'required|numeric',
            'release_year' => 'required|date_format:Y',
            'playing_time_minutes' => 'required|numeric',
            'min_number_players' => 'required|integer',
            'max_number_players' => 'required|integer',
            'description' => 'required|string',
            'img_url' => 'required|url',
            'publisher_id' => 'required|integer'
        ];
    }
}
