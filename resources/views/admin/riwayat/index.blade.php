@extends('admin.layout')

@section('title', 'Riwayat Pembelian')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Riwayat Pembelian</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Daftar semua pesanan pelanggan</li>
    </ol>

    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-history me-1"></i>
            Daftar Pesanan
        </div>
        <div class="card-body">
            @if($orders->isEmpty())
            <div class="alert alert-info text-center">
                Belum ada riwayat pesanan.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>ID Pesanan</th>
                            <th>Pelanggan</th>
                            <th>No. Telp</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $order->order_id }}</strong></td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                @if($order->status == 'settlement')
                                <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Lunas</span>
                                @elseif($order->status == 'pending')
                                <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> Pending</span>
                                @elseif($order->status == 'expire')
                                <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Expired</span>
                                @else
                                <span class="badge bg-secondary text-capitalize">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#detailOrderModal{{ $order->id }}">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="detailOrderModal{{ $order->id }}" tabindex="-1" aria-labelledby="detailOrderModalLabel{{ $order->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title" id="detailOrderModalLabel{{ $order->id }}">Detail Pesanan #{{ $order->order_id }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <strong>Nama Pelanggan:</strong> {{ $order->customer_name }}<br>
                                                <strong>No. Telepon:</strong> {{ $order->phone }}<br>
                                                <strong>Alamat Pengiriman:</strong> {{ $order->address }}<br>
                                            </div>
                                            <div class="col-md-6 text-md-end">
                                                <strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d F Y H:i') }}<br>
                                                <strong>Status:</strong>
                                                @if($order->status == 'settlement')
                                                <span class="badge bg-success">Lunas</span>
                                                @elseif($order->status == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($order->status == 'expire')
                                                <span class="badge bg-danger">Expired</span>
                                                @else
                                                <span class="badge bg-secondary text-capitalize">{{ $order->status }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <h6>Item Pesanan:</h6>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Sepatu</th>
                                                        <th class="text-center">Qty</th>
                                                        <th class="text-end">Harga Satuan</th>
                                                        <th class="text-end">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $subtotalOrder = 0; @endphp
                                                    @foreach($order->items as $item)
                                                    <tr>
                                                        <td>{{ $item->sepatu->nama_sepatu ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $item->quantity }}</td>
                                                        <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                                        <td class="text-end">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                                                    </tr>
                                                    @php $subtotalOrder += ($item->quantity * $item->price); @endphp
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3" class="text-end">TOTAL KESELURUHAN:</th>
                                                        <th class="text-end">Rp {{ number_format($subtotalOrder, 0, ',', '.') }}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        {{-- Tambahkan tombol cetak invoice admin di sini jika diperlukan --}}
                                        <a href="{{ route('order.invoice', $order->order_id) }}" target="_blank" class="btn btn-primary">
                                            <i class="fas fa-print me-1"></i> Cetak Invoice
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection