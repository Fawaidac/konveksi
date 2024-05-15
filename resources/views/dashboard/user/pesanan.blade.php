@extends('dashboard.user.dashboard')
@section('title-user')
    Pesanan
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}" />
@endpush
@section('user')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tabel Pesanan</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga Produk</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                            <th>Tanggal Pesan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $item->produk->nama }}
                                </td>
                                <td>
                                    Rp. {{ number_format($item->produk->harga, 0, ',', '.') }}
                                </td>
                                <td>
                                    {{ $item->qty }}
                                </td>
                                <td>
                                    Rp. {{ number_format($item->grand_total, 0, ',', '.') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
                                </td>
                                <td>
                                    {{ $item->status }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/simple-datatables.js') }}"></script>
@endpush
