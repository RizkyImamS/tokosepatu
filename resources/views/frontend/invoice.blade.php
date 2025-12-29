<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $order_id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .invoice-box {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        @media print {
            .no-print {
                display: none;
            }

            .invoice-box {
                box-shadow: none;
                margin: 0;
                width: 100%;
            }

            body {
                background-color: #fff;
            }
        }
    </style>
</head>

<body>

    <div class="container no-print mt-3 text-center">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Print Invoice
        </button>
        <a href="{{ url('/') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="invoice-box">
        <div class="row mb-4">
            <div class="col-6">
                <h2 class="fw-bold text-primary">SHOESTORE</h2>
                <p class="text-muted small">Jl. Bojong Gede, West Java, Indonesia</p>
            </div>
            <div class="col-6 text-end">
                <h4 class="fw-bold">INVOICE</h4>
                <p class="mb-0">ID: #{{ $order_id }}</p>
                <p>Tanggal: {{ $date }}</p>
            </div>
        </div>

        <hr>

        <div class="row mb-4">
            <div class="col-12">
                <h6>Tujuan Pengiriman:</h6>
                <strong>Pelanggan Setia ShoeStore</strong><br>
                <p class="text-muted">Alamat telah terekam di sistem kami.</p>
            </div>
        </div>

        <table class="table table-borderless">
            <thead class="bg-light">
                <tr>
                    <th>Item</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-end">Harga</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                {{-- Karena data produk ada di session/DB, ini adalah placeholder --}}
                <tr>
                    <td>Sepatu Pilihan</td>
                    <td class="text-center">1</td>
                    <td class="text-end">Rp {{ number_format(session('total_terakhir') ?? 0, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format(session('total_terakhir') ?? 0, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="border-top">
                    <td colspan="3" class="text-end fw-bold">Total Bayar</td>
                    <td class="text-end fw-bold text-primary">Rp {{ number_format(session('total_terakhir') ?? 0, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="mt-5 text-center">
            <p class="small text-muted">Terima kasih telah berbelanja di ShoeStore!</p>
            <div class="badge bg-success p-2">PEMBAYARAN LUNAS (SETTLEMENT)</div>
        </div>
    </div>

</body>

</html>