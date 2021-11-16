<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Session;
use Gate;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.products');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('products')->where(function($query) {
                    $query->where('name', $this->name)
                    ->where('brand_id', $this->brand_id)
                    ->where('company_id', Session::get('company_id'));
                })->ignore($this->id)
            ]
        ];
    }
}
