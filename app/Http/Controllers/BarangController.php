<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Validators\ValidatorRules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_barang = Barang::with('kategori')->orderByDesc('updated_at')->get();
        return view('admin.barang.index_barang', [
            'data_barang' => $data_barang,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_kategori = Kategori::getAllKategori();
        return view(
            'admin.barang.create_barang',
            [
                'data_kategori' => $data_kategori,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = ValidatorRules::barangRules($request->all());
        if ($validator->fails()) {
            return redirect('/barang/create')->withErrors($validator)->withInput();
        }
        try {
            $data = $request->all();
            $image_file = $request->file('foto');
            $image_extension = $image_file->extension();
            $image_rename = "Sampah" . "_" . date('d_m_y_h_i') . "_" . Str::random(10) . "." . $image_extension;
            $image_file->move(public_path('sampah_images'), $image_rename);
            $data['foto'] = $image_rename;
            $data['harga'] = str_replace('.', '', $request->harga);
            Barang::insertBarang($data);
            return redirect('/barang')->with('success', 'berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/barang')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::with('kategori')->where('kd_barang', decrypt($id))->first();
        $data_kategori = Kategori::getAllKategori();
        return view(
            'admin.barang.edit_barang',
            [
                'barang' => $barang,
                'data_kategori' => $data_kategori,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('foto')) {
            $data = $request->except('_token', '_method');
            $image_file = $request->file('foto');
            $image_extension = $image_file->extension();
            $image_rename = "Sampah" . "_" . date('d_m_y_h_i') . "_" . Str::random(10) . "." . $image_extension;
            $image_file->move(public_path('sampah_images'), $image_rename);
            $data['foto'] = $image_rename;
            $data['harga'] = str_replace('.', '', $request->harga) ?: $request->harga;

            // jika ada foto baru maka hapus foto lama
            $data_images = DB::table('barangs')->where('kd_barang', decrypt($id))->first();
            File::delete(public_path('sampah_images') . '/' . $data_images->foto);
            Barang::updateBarang($data, decrypt($id));
            return redirect('/barang')->with('success', 'berhasil diupdate');
        } else {
            $data = $request->except('_token', '_method');
            $data['harga'] = str_replace('.', '', $request->harga) ?: $request->harga;
            Barang::updateBarang($data, decrypt($id));
            return redirect('/barang')->with('success', 'berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data_images = DB::table('barangs')->where('kd_barang', decrypt($id))->first();
            File::delete(public_path('sampah_images') . '/' . $data_images->foto);
            Barang::deleteBarang(decrypt($id));
            return redirect('/barang')->with('success', 'berhasil didelete');
        } catch (\Exception $e) {
            return redirect('/barang')->with('failed', 'terjadi kesalahan' . $e->getMessage());
        }
    }
}
