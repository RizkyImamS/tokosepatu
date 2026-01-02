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

        <hr>
        <div class="mb-4">
            <label class="fw-bold d-block mb-2">Stok per Ukuran</label>
            <div class="row g-3 bg-light p-3 rounded border">
                @foreach(['37', '38', '39', '40', '41', '42', '43'] as $size)
                <div class="col-md-3 col-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white">Size {{ $size }}</span>
                        <input type="number" name="stok_per_ukuran[{{ $size }}]" class="form-control" value="0" min="0">
                    </div>
                </div>
                @endforeach
                <div class="col-12">
                    <small class="text-muted">* Isi 0 jika ukuran tersebut tidak tersedia.</small>
                </div>
            </div>
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
    // Logika Auto-Slug
    const judul = document.querySelector('#nama_sepatu');
    const slug = document.querySelector('#slug');

    judul.addEventListener('keyup', function() {
        let preslug = judul.value;
        preslug = preslug.toLowerCase()
            .replace(/[^a-z0-9\s]/g, "") // Hanya huruf, angka, spasi
            .replace(/\s+/g, '-'); // Ganti spasi dengan -
        slug.value = preslug;
    });

    // Logika Format Rupiah & Hidden Input
    const hargaRupiah = document.getElementById('harga_rupiah');
    const hargaHidden = document.getElementById('harga');

    hargaRupiah.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ""); // Ambil hanya angka saja

        if (value) {
            hargaHidden.value = value; // Simpan angka bersih ke input hidden

            // Format angka menjadi ribuan (titik)
            let formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            e.target.value = formatted;
        } else {
            hargaHidden.value = "";
            e.target.value = "";
        }
    });
</script>
@endsection