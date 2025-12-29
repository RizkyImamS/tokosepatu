@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Sepatu</h2>
    <a href="{{ route('sepatu.create') }}" class="btn btn-primary">Tambah Sepatu</a>
</div>

<table class="table table-bordered bg-white shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama Sepatu</th>
            <th>Harga</th>
            <th>Ukuran</th>
            <th>Warna</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sepatu as $no => $item)
        <tr>
            <td>{{ $no + 1 }}</td>
            <td>
                @if($item->gambar)
                <img src="{{ asset('storage/'.$item->gambar) }}" width="80">
                @else
                <span class="text-muted">No Image</span>
                @endif
            </td>
            <td>{{ $item->nama_sepatu }}</td>
            <td>{{ $item->harga }}</td>
            <td>{{ $item->ukuran }}</td>
            <td>{{ $item->warna }}</td>
            <td>{{ $item->kategori->nama_kategori ?? 'Umum' }}</td>
            <td>{{ $item->deskripsi }}</td>
            <td>
                <div class="d-flex gap-1">
                    <a href="{{ route('sepatu.edit', $item->id) }}" class="btn btn-sm btn-warning text-white mr-2">Edit</a>

                    <form action="{{ route('sepatu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection