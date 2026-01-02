@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Daftar Sepatu</h2>
    <a href="{{ route('sepatu.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus"></i> Tambah Sepatu
    </a>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle bg-white shadow-sm border">
        <thead class="table-dark">
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="10%">Gambar</th>
                <th>Nama Sepatu</th>
                <th>Harga</th>
                <th width="20%">Stok & Ukuran</th>
                <th>Warna</th>
                <th>Kategori</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($sepatu as $no => $item)
            <tr>
                {{-- Nomor --}}
                <td class="text-center">{{ $no + 1 }}</td>

                {{-- Gambar --}}
                <td>
                    @if ($item->gambar)
                    <img
                        src="{{ asset('storage/' . $item->gambar) }}"
                        class="rounded shadow-sm"
                        width="80"
                        height="80"
                        style="object-fit: cover;">
                    @else
                    <div
                        class="bg-light text-muted d-flex align-items-center justify-content-center rounded"
                        style="width: 80px; height: 80px; font-size: 0.7rem;">
                        No Image
                    </div>
                    @endif
                </td>

                {{-- Nama & Merk --}}
                <td>
                    <span class="fw-bold">{{ $item->nama_sepatu }}</span><br>
                    <small class="text-muted">{{ $item->merk }}</small>
                </td>

                {{-- Harga --}}
                <td class="fw-bold text-success">
                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                </td>

                {{-- Stok per Ukuran --}}
                <td>
                    @if ($item->stok_per_ukuran)
                    <div class="d-flex flex-wrap gap-1">
                        @foreach ($item->stok_per_ukuran as $size => $stock)
                        <span
                            class="badge {{ $stock > 0 ? 'bg-info text-dark' : 'bg-light text-muted' }} border"
                            style="font-size: 0.75rem;">
                            {{ $size }} : <strong>{{ $stock }}</strong>
                        </span>
                        @endforeach
                    </div>
                    @else
                    <span class="text-danger small">Stok belum diatur</span>
                    @endif
                </td>

                {{-- Warna --}}
                <td>{{ $item->warna }}</td>

                {{-- Kategori --}}
                <td>
                    <span class="badge bg-info text-white">
                        {{ $item->kategori->nama_kategori ?? 'Umum' }}
                    </span>
                </td>

                {{-- Aksi --}}
                <td style="width: 130px;">
                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('sepatu.show', $item->id) }}"
                            class="btn btn-sm btn-info text-white shadow-sm py-2 badge mb-2">
                            <i class="fas fa-eye me-2"></i>Detail
                        </a>

                        <a href="{{ route('sepatu.edit', $item->id) }}"
                            class="btn btn-sm btn-warning text-white shadow-sm py-2 badge mb-2">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>

                        <form action="{{ route('sepatu.destroy', $item->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus sepatu ini?')"
                            class="w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100 shadow-sm py-2 badge mb-2">
                                <i class="fas fa-trash me-2"></i>Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection