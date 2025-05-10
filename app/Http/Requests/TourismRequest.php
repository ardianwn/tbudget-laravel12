<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourismRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'entrance_fee' => 'nullable|numeric',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('facilities') && is_string($this->facilities)) {
            $this->merge([
                'facilities' => array_map('trim', explode(',', $this->facilities))
            ]);
        }
    }
}