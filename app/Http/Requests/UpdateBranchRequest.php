<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required',
            'brand_id' => 'sometimes|required|exists:brands,id',
            'region_id' => 'sometimes|required|exists:regions,id',
            'district_id' => 'sometimes|required|exists:districts,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,jpg,png',
        ];
    }
}
