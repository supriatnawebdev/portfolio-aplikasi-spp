<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
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
                // 'wali_id' => 'nullable',
                'name'  => 'required',
                'email' => 'required|email',
                'nisn' => 'required|unique:siswas',
                'nis' => 'required|unique:siswas',
                'kelas_id' => 'required',
                'angkatan' => 'required',
                'no_hp'  => 'required',
                'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:5000',
                'alamat'  => 'required',

        ];
    }
}
