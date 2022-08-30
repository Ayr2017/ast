<?php

namespace App\Http\Requests\Admin\FormFields;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;
use phpDocumentor\Reflection\Types\Nullable;

class StoreFormFieldRequest extends FormRequest
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
            'name' => ['required','string', 'unique:form_fields'],
            'type' => ['required','in:text,number,select,checkbox,radio'],
            'unit' => ['string','nullable'],
            'form_id' => ['required'],
            'field_category_id' => ['required','numeric'],
            'operator_a' => ['required','string'],
            'operator_b' => ['required','string'],
            'operator_c' => ['required','string'],
            'select_fields' => [new RequiredIf(in_array($this->type,['select', 'checkbox','radio'] )), 'string','nullable' ],
        ];
    }
}
