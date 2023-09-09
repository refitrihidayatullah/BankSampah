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
    public static function barangRules(array $data = [])
    {
        return Validator::make(
            $data,
            [
                'nama_barang' => 'required',
                'kategori_id' => 'required',
                'harga' => 'required|numeric|min:0|not_in:-0',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'nama_barang.required' => 'nama barang harus diisi',
                'kategori_id.required' => 'kategori harus diisi',
                'harga.required' => 'harga harus diisi',
                'harga.numeric' => 'harga harus angka',
                'harga.min' => 'harga beli minimal 0 tidak boleh negatif',
                'harga.not_in' => 'harga beli minimal 0 tidak boleh negatif',
            ]
        );
    }
    public static function registerRules(array $data = [])
    {
        return Validator::make(
            $data,
            [
                'name' => 'required',
                'username' => 'required|unique:Users,username',
                'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\-])/',
                'password_confirm' => 'required|same:password',
            ],
            [
                'name.required' => 'name harus diisi',
                'username.required' => 'username harus diisi',
                'username.unique' => 'username sudah terdaftar',
                'password.required' => 'password harus diisi',
                'password.min' => 'password minimal 8 karakter',
                'password.regex' => 'password harus mengandung huruf kapital, angka dan simbol',
                'password_confirm.required' => 'password confirm harus diisi',
                'password_confirm.same' => 'password tidak sama',
            ]
        );
    }
    public static function loginRules(array $data = [])
    {
        return Validator::make(
            $data,
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'username harus diisi',
                'password.required' => 'password harus diisi',
            ]
        );
    }
}
