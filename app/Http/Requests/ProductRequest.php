<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required|string|min:5|max:500',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'tag_id.*' =>  'required|integer',
        ];
    }
}
