<?php

namespace App\Http\Requests\Specialist\Organizations;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class StoreOrganizationRequest extends FormRequest
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
            'name' => [ 'string', 'max:255'],
            'inn' => [ 'string', 'unique:organizations','max:255'],
            'region_id' => [ 'numeric', 'max:255'],
            'district_id' => [ 'numeric', 'max:255'],
            'deleted_at' => [ 'in:1,0'],
            'address' => ['string']
        ];
    }
}