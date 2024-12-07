<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMahasiswaRequest extends FormRequest
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
            //
            'nim' => 'required|string|max:10',
            'nama_mahasiswa' => 'required|string|max:255',
            'email' => 'required|email',
            'jurusan' => 'required|string|max:100',
            'dosen_id' => 'required|exists:dosens,id',
        ];
    }
}
