<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseLicenseStoreRequest extends FormRequest
{
    protected $redirectRoute  = 'market.licenses';
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
            'package' => 'required',
            'moneda' => 'required',
            'hash' => 'required',
        ];
    }
}
