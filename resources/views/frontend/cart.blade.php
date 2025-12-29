@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4"><i class="fas fa-shopping-cart me-2"></i> Keranjang Belanja</h3>

    @if(session('cart'))
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @foreach($cart as $id => $details)
                @php $total += $details['harga'] * $details['quantity'] @endphp
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/'.$details['gambar']) }}" width="80" class="rounded me-3">
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $details['nama'] }}</h6>
                                <small class="text-muted">{{ $details['merk'] }}</small>
                            </div>
                        </div>
                    </td>
                    <td>Rp {{ number_format($details['harga'], 0, ',', '.') }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td class="fw-bold">Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger btn-remove-cart" data-id="{{ $id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 offset-md-6">
            <div class="card border-0 shadow-sm p-4 bg-light text-end">
                <h5>Total Pembayaran:</h5>
                <h2 class="fw-bold text-primary">Rp {{ number_format($total, 0, ',', '.') }}</h2>
                <hr>
                <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg px-5 rounded-pill">
                    Checkout Sekarang <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-shopping-basket fa-5x text-secondary opacity-25 mb-3"></i>
        <h4>Keranjang Anda masih kosong.</h4>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
    </div>
    @endif
</div>
@endsection