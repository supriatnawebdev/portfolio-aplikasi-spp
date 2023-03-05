<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSppRequest extends FormRequest
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
            'nominal' => 'required|numeric'. $this->biaya,
            'tahun' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        // validasi titik
        $this->merge([
            'nominal' => str_replace('.', '', $this->nominal),
        ]);
    }
}
