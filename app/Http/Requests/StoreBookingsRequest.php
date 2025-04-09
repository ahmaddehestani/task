<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingsRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'package_id'=>['required','exists:packages,id'],
            'customer_name'=>['required','string','max:255'],
            'customer_email'=>['required','email'],
            'travel_date'=>['required','date'],
        ];
    }
}
