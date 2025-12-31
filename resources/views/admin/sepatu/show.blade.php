@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <div class="card shadow border-0">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detail Sepatu: {{ $sepatu->nama_sepatu }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('storage/'.$sepatu->gambar) }}" class="img-fluid rounded">
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <th>Merk/Nama</th>
                            <td>{{ $sepatu->nama_sepatu }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp {{ number_format($sepatu->harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $sepatu->kategori->nama_kategori ?? 'Umum' }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $sepatu->deskripsi }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('sepatu.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection