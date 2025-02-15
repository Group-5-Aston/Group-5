<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminAddOptionRequest extends FormRequest
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
            'size' => ['string', 'max:255'],
            'flavor' => ['string', 'max:255',],
            'stock' => ['required', 'integer', 'min:0'],
        ];
    }
}

