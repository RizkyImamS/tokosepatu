@extends('admin.layout')

@section('content')
<h2>Tambah Sepatu Baru</h2>

<div class="card p-4 shadow-sm">
    <form action="{{ route('sepatu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="nama_sepatu">Nama Sepatu</label>
            <input type="text" name="nama_sepatu" id="nama_sepatu" class="form-control @error('nama_sepatu') is-invalid @enderror" value="{{ old('nama_sepatu') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="slug">Slug (URL Otomatis)</label>
            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" readonly>
            <small class="text-muted">Slug akan terisi otomatis saat Anda mengetik judul.</small>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_sepatu_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoriSepatu as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Merk</label>
            <input type="text" name="merk" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="text" id="harga_rupiah" class="form-control">
            <input type="hidden" name="harga" id="harga">
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ukuran</label>
            <input type="text" name="ukuran" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Warna</label>
            <input type="text" name="warna" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan Sepatu</button>
        <a href="{{ route('sepatu.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    const judul = document.querySelector('#nama_sepatu');
    const slug = document.querySelector('#slug');

    judul.addEventListener('keyup', function() {
        let preslug = judul.value;
        preslug = preslug.replace(/[^a-zA-Z0-9\s]/g, ""); // Hapus karakter spesial
        preslug = preslug.toLowerCase();
        preslug = preslug.replace(/\s+/g, '-'); // Ganti spasi dengan tanda hubung
        slug.value = preslug;
    });
    const hargaRupiah = document.getElementById('harga_rupiah');
    const hargaHidden = document.getElementById('harga');
    hargaRupiah.addEventListener('input', function(e) {
        let value = e.target.value;
        value = value.replace(/[^,\d]/g, '').toString();
        const split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            const separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        e.target.value = rupiah ? 'Rp. ' + rupiah : '';
        hargaHidden.value = value.replace(/\./g, '');
    });
</script>
@endsection