<?php

namespace App\Models;

use App\Http\Controllers\GenerateCodeAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'kd_barang';
    protected $table = 'barangs';
    public  $timestamps = true;
    public $incrementing = false;


    // insert data
    public static function insertBarang(array $data = [])
    {
        $data['kd_barang'] = GenerateCodeAuto::generateCode('BRG-', Barang::class, 'kd_barang');
        return static::create($data);
    }
    // insert data
    public static function updateBarang(array $data = [], $id)
    {
        return static::where('kd_barang', $id)->update($data);
    }
    public static function deleteBarang($id)
    {
        return static::where('kd_barang', $id)->delete();
    }
    public function setAttribute($key, $value)
    {
        return parent::setAttribute($key, strtoupper($value));
    }

    // relasi
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
