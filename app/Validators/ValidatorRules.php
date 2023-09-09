<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class ValidatorRules
{
    public static function kategoriRules(array $data = [])
    {
        return Validator::make(
            $data,
            [
                'nama_kategori' => 'required|regex:/^[a-zA-Z\s]+$/',
            ],
            [
                'nama_kategori.required' => 'nama kategori harus diisi',
                'nama_kategori.regex' => 'nama kategori tidak boleh mengandung angka atau simbol',
            ]
        );
    }
}
