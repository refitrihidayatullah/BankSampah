@extends('layout.main')
@section('title','Data barang | Create barang')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-4 pb-2">
                <form action="{{url('/barang/store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama barang*</label>
                        <input type="text" class="form-control p-2 @error('nama_barang') is-invalid @enderror" value="{{old('nama_barang')}}" id="nama_barang" name="nama_barang" placeholder="masukkan nama barang..">
                        @error('nama_barang')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori*</label>
                        <select class="form-select" name="kategori_id" id="kategori_id" aria-label="Default select example">
                            <option value=""> -- Pilih kategori --</option>
                            @foreach ($data_kategori as $kategori)
                            <option value="{{$kategori->kd_kategori}}" {{old('kategori_id') == $kategori->kd_kategori ?'selected':''}} >{{$kategori->nama_kategori}}</option>
                            @endforeach
                          </select>
                          @error('kategori_id')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga(Kg) *</label>
                        <input type="float" class="form-control p-2 @error('harga') is-invalid @enderror"  id="harga" value="{{old('harga')}}" name="harga" placeholder="masukkan harga beli barang..">
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
                        <textarea class="form-control p-2" name="deskripsi" id="deskripsi" placeholder="deskripsi.." rows="3"></textarea>
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