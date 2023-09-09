@extends('layout.main')
@section('title','Data barang | Edit barang')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-4 pb-2">
                <form action="{{url("/barang/".encrypt($barang->kd_barang))}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama barang*</label>
                        <input type="text" class="form-control p-2 @error('nama_barang') is-invalid @enderror" value="{{old('nama_barang')?:$barang->nama_barang}}" id="nama_barang" name="nama_barang" placeholder="masukkan nama barang..">
                        @error('nama_barang')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori*</label>
                        <select class="form-select" name="kategori_id" id="kategori_id" aria-label="Default select example">
                            @foreach ($data_kategori as $kategori)
                            <option value="{{$barang->kategori_id == $kategori->kd_kategori ? $barang->kategori_id:$kategori->kd_kategori}}" {{$barang->kategori_id == $kategori->kd_kategori ?'selected':''}} >{{$kategori->nama_kategori}}</option>
                            @endforeach
                          </select>
                          @error('kategori_id')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga(Kg) *</label>
                        <input type="float" class="form-control p-2 @error('harga') is-invalid @enderror"  id="harga" value="{{old('harga')?: $barang->harga}}" name="harga" placeholder="masukkan harga beli barang..">
                        @error('harga')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto*</label>
                        <input class="form-control p-2 @error('foto') is-invalid @enderror" type="file" name="foto" id="foto">
                        @error('foto')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">deskripsi</label>
                        <textarea class="form-control p-2" name="deskripsi" id="deskripsi" placeholder="deskripsi.." rows="3">{{$barang->deskripsi}}</textarea>
                        @error('deskripsi')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
  
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{url('/barang')}}"  class="btn btn-primary">Back</a>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection