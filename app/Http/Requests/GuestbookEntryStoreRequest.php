<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestbookEntryStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>[
                'required',
                'string',
                'max:255',
            ],
            'content'=>[
                'required',
                'string',
            ],
            'email'=>[
                'required',
                'email',
                'max:255',
            ],
            'name'=>[
                'required',
                'string',
                'max:255',
            ],
            'real_name'=>[
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }
}
