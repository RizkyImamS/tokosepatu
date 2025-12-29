@extends('admin.layout')

@section('content')
<h2>Edit Sepatu</h2>

<div class="card p-4 shadow-sm">
    <form action="{{ route('sepatu.update', $sepatu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Sepatu</label>
            <input type="text" name="nama_sepatu" class="form-control" value="{{ $sepatu->nama_sepatu }}" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_sepatu_id" class="form-control" required>
                @foreach($kategoriSepatu as $k)
                <option value="{{ $k->id }}" {{ $sepatu->kategori_sepatu_id == $k->id ? 'selected' : '' }}>
                    {{ $k->nama_kategori }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>merk</label>
            <input name="merk" class="form-control" value="{{ $sepatu->merk }}" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="text" id="harga_rupiah" class="form-control" value="{{ number_format($sepatu->harga, 0, ',', '.') }}">
            <input type="hidden" name="harga" id="harga" value="{{ $sepatu->harga }}">
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $sepatu->stok }}" required>
        </div>

        <div class="mb-3">
            <label>Ukuran</label>
            <input type="text" name="ukuran" class="form-control" value="{{ $sepatu->ukuran }}" required>
        </div>

        <div class="mb-3">
            <label>Warna</label>
            <input type="text" name="warna" class="form-control" value="{{ $sepatu->warna }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $sepatu->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Gambar (Biarkan kosong jika tidak diganti)</label>
            <br>
            @if($sepatu->gambar)
            <img src="{{ asset('storage/'.$sepatu->gambar) }}" width="150" class="mb-2 rounded">
            @endif
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Sepatu</button>
        <a href="{{ route('sepatu.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection