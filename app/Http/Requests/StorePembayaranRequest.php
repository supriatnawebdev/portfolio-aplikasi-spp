<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePembayaranRequest extends FormRequest
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
            'tanggal_bayar' => 'required|date',
            'jumlah_dibayar' => 'required|numeric',
            'tagihan_id' => 'required',
            'siswa_id' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        // validasi titik
        $this->merge([
            'jumlah_dibayar' => str_replace('.', '', $this->jumlah_dibayar),
        ]);
    }


}
