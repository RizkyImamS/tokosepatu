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

        <hr>
        <div class="mb-4">
            <label class="fw-bold d-block mb-2">Stok per Ukuran</label>
            <div class="row g-3 bg-light p-3 rounded border">
                @foreach(['37', '38', '39', '40', '41', '42', '43'] as $size)
                <div class="col-md-3 col-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white">Size {{ $size }}</span>
                        {{-- Ambil value dari array stok_per_ukuran berdasarkan index size --}}
                        <input type="number"
                            name="stok_per_ukuran[{{ $size }}]"
                            class="form-control"
                            value="{{ $sepatu->stok_per_ukuran[$size] ?? 0 }}"
                            min="0">
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
<script>
    const hargaRupiah = document.getElementById('harga_rupiah');
    const hargaHidden = document.getElementById('harga');

    hargaRupiah.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, "");

        if (value) {
            hargaHidden.value = value;
            let formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            e.target.value = "Rp. " + formatted;
        } else {
            hargaHidden.value = "";
            e.target.value = "";
        }
    });

    // Jalankan format saat halaman dimuat pertama kali agar muncul Rp.
    window.addEventListener('load', () => {
        if (hargaRupiah.value) {
            let val = hargaRupiah.value.replace(/\D/g, "");
            hargaRupiah.value = "Rp. " + val.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    });
</script>
@endsection