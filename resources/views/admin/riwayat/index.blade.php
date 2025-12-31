@extends('admin.layout')

@section('title', 'Riwayat Pembelian')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Riwayat Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Manajemen seluruh transaksi pelanggan</li>
    </ol>

    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span><i class="fas fa-table me-1"></i> Data Transaksi</span>
            <span class="badge bg-light text-dark">Total: {{ \App\Models\Order::count() }} Pesanan</span>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if($orders->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-3x text-secondary mb-3"></i>
                <p class="text-muted">Belum ada riwayat pesanan yang masuk.</p>
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>ID Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Tanggal Transaksi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</td>
                            <td><code class="fw-bold">{{ $order->order_id }}</code></td>
                            <td>
                                <div class="fw-bold">{{ $order->customer_name }}</div>
                                <small class="text-muted">{{ $order->phone }}</small>
                            </td>
                            <td class="fw-bold text-primary">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td>
                                @php
                                $badgeColor = [
                                'settlement' => 'bg-success',
                                'pending' => 'bg-warning text-dark',
                                'expire' => 'bg-danger',
                                'cancel' => 'bg-secondary'
                                ][$order->status] ?? 'bg-info';

                                $statusText = ($order->status == 'settlement') ? 'Lunas' : ucfirst($order->status);
                                @endphp
                                <span class="badge {{ $badgeColor }}">
                                    {{ $statusText }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $order->id }}">
                                    <i class="fas fa-search-plus"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>

@foreach($orders as $order)
<div class="modal fade" id="detailModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Rincian Pesanan #{{ $order->order_id }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small uppercase d-block">Informasi Pelanggan</label>
                        <p class="mb-1 fw-bold">{{ $order->customer_name }}</p>
                        <p class="mb-1">{{ $order->phone }}</p>
                        <p class="mb-0 text-muted">{{ $order->address }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <label class="text-muted small uppercase d-block">Status Pembayaran</label>
                        <h4 class="text-uppercase">{{ $order->status }}</h4>
                        <small>{{ $order->created_at->format('d F Y, H:i') }}</small>
                    </div>
                </div>

                <hr>

                <table class="table table-sm">
                    <thead>
                        <tr class="text-muted small">
                            <th>PRODUK</th>
                            <th class="text-center">QTY</th>
                            <th class="text-end">HARGA</th>
                            <th class="text-end">SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->sepatu->nama_sepatu ?? 'Produk Dihapus' }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-end">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold fs-5">
                            <td colspan="3" class="text-end text-muted">Total Bayar:</td>
                            <td class="text-end text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('order.invoice', $order->order_id) }}" target="_blank" class="btn btn-primary">
                    <i class="fas fa-print"></i> Cetak Invoice
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection