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
                    <td>
                        <div class="input-group input-group-sm" style="width: 120px;">
                            <button class="btn btn-outline-secondary update-cart"
                                type="button"
                                data-id="{{ $id }}"
                                data-action="decrease">
                                <i class="fas fa-minus"></i>
                            </button>

                            <input type="text"
                                class="form-control text-center bg-white quantity-input-{{ $id }}"
                                value="{{ $details['quantity'] }}"
                                readonly>

                            <button class="btn btn-outline-secondary update-cart"
                                type="button"
                                data-id="{{ $id }}"
                                data-action="increase">
                                <i class="fas fa-plus"></i>
                            </button>

                        </div>
                    </td>
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
    <div class="mt-5 pt-4 border-top">
        <a href="{{ url('/') }}" class="text-decoration-none text-primary fw-bold">
            <i class="fas fa-arrow-left me-2"></i> Kembali Belanja
        </a>
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-shopping-basket fa-5x text-secondary opacity-25 mb-3"></i>
        <h4>Keranjang Anda masih kosong.</h4>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
    </div>
    @endif
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        // Debugging: Cek apakah script jalan
        console.log('Script Keranjang Siap!');

        $('.update-cart').on('click', function(e) {
            e.preventDefault();

            let btn = $(this);
            let id = btn.data('id');
            let action = btn.data('action');

            // Debugging: Cek data sebelum dikirim
            console.log('Klik ID:', id, 'Action:', action);

            $.ajax({
                url: "{{ route('cart.changeQuantity') }}", // Panggil route baru
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    action: action
                },
                beforeSend: function() {
                    // Efek loading (opsional)
                    btn.prop('disabled', true);
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Reload halaman agar angka dan total harga terupdate
                        window.location.reload();
                    } else {
                        alert('Gagal: ' + response.message);
                        btn.prop('disabled', false);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan sistem. Cek Console.');
                    btn.prop('disabled', false);
                }
            });
        });
    });
</script>
@endsection