<?php

namespace App\Models;

use App\Http\Controllers\GenerateCodeAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'kd_kategori';
    protected $table = 'kategoris';
    public  $timestamps = true;
    public $incrementing = false;

    //get all data
    public static function getAllKategori()
    {
        return static::orderByDesc('updated_at')->get();
    }

    // get data byid
    public static function getByIdKategori($id)
    {
        return static::where('kd_kategori', $id)->first();
    }

    // insert data
    public static function insertKategori(array $data = [])
    {
        $data['kd_kategori'] = GenerateCodeAuto::generateCode('KTG-', Kategori::class, 'kd_kategori');
        return static::create($data);
    }

    public function setAttribute($key, $value)
    {
        return parent::setAttribute($key, strtoupper($value));
    }
}
