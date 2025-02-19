<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUpdateProductRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    //Function that validates the request to update product details.
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'price' => ['numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'label' => ['string', 'max:255'],
            'description' => ['string', 'max:255'],
            'cat_or_dog' => ['string', 'in:cat,dog,both', 'max:255'],
            'type' => ['string', 'in:clothes,food,toy,hygiene', 'max:255'],
        ];
    }
}

