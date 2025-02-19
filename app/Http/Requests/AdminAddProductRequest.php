<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminAddProductRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    //Function that validates the request to add a stock option.
    public function rules(): array
    {
        return [
            //Product request
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['string', 'max:255', 'required'],
            'price' => ['numeric', 'min:0', 'required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'label' => ['string', 'max:255', 'required'],
            'description' => ['string', 'max:255', 'required'],
            'cat_or_dog' => ['string', 'in:cat,dog,both', 'max:255'],
            'type' => ['string', 'in:clothes,food,toy,hygiene', 'max:255'],

            //Product option request
            'size' => ['nullable', 'string', 'max:255',],
            'flavor' => ['nullable', 'string', 'max:255',],
            'stock' => ['required', 'integer', 'min:0', 'required'],
        ];
    }
}
