@extends('admin.layout')

@section('content')
<div class="mb-4">
    <h2>Dashboard</h2>
    <p class="text-muted">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>.</p>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card bg-primary text-white shadow-sm border-0 mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Sepatu</h5>
                <h2 class="display-4 fw-bold">{{ \App\Models\Sepatu::count() }}</h2>
                <a href="{{ route('sepatu.index') }}" class="text-white text-decoration-none small">Lihat Detail →</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white shadow-sm border-0 mb-3">
            <div class="card-body">
                <h5 class="card-title">Kategori</h5>
                <h2 class="display-4 fw-bold">{{ \App\Models\KategoriSepatu::count() }}</h2>
                <p class="small mb-0">Kategori aktif saat ini</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-dark shadow-sm border-0 mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Admin</h5>
                <h2 class="display-4 fw-bold">{{ \App\Models\User::count() }}</h2>
                <a href="{{ route('user.index') }}" class="text-dark text-decoration-none small">Kelola User →</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0">Sepatu Terbaru</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nama Sepatu</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Sepatu::latest()->take(5)->get() as $b)
                        <tr>
                            <td>{{ $b->nama_sepatu }}</td>
                            <td>{{ $b->created_at->format('d M Y') }}</td>
                            <td><span class="badge bg-info text-dark">Dipublish</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center p-4">Belum ada data berita.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection