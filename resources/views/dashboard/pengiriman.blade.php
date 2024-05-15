@extends('layouts.main')
@section('title')
    Pengiriman
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}" />
@endpush
@section('container')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tabel Pengiriman</h5>
                <button class="btn btn-primary float-end me-3" data-bs-toggle="modal" data-bs-target="#add">Tambah</button>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Pesanan</th>
                            <th>Total Harga</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Estimasi</th>
                            <th>Tanggal Tiba</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengiriman as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
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
                                    {{ $item->status }}
                                </td>
                                <td>
                                    <button class="btn icon btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#bukti{{ $item->id }}"><i class="bi bi-receipt"></i></button>
                                </td>
                                <td>
                                    <button class="btn icon btn-info" data-bs-toggle="modal"
                                        data-bs-target="#info{{ $item->id }}"><i class="bi bi-info-circle"></i></button>
                                    <button class="btn icon btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#update{{ $item->id }}"><i class="bi bi-pencil"></i></button>
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
