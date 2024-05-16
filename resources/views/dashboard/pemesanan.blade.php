@extends('layouts.main')
@section('title')
    Pesanan
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}" />
@endpush
@section('container')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tabel Pesanan</h5>
                <button class="btn btn-primary float-end me-3" data-bs-toggle="modal" data-bs-target="#add">Tambah</button>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Produk</th>
                            <th>Harga Produk</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Bukti Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $item)
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
                                    @if ($item->status === 'dalam pengiriman')
                                        <a href="{{ route('pesanan-nota', ['id' => $item->id]) }}"
                                            class="btn icon btn-danger" target="_blank">
                                            <i class="bi bi-receipt"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- modal info --}}
    @foreach ($pesanan as $item)
        <div class="modal fade text-left" id="info{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" data-bs-backdrop="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-full" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Info Detail Pesanan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Nama Pelanggan</label>
                                    <input type="text" id="first-name-vertical" required value="{{ $item->user->name }}"
                                        class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">No Telepon Pelanggan</label>
                                    <input type="text" id="first-name-vertical" required
                                        value="{{ $item->user->notelp }}" class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Alamat Pelanggan</label>
                                    <input type="text" id="first-name-vertical" required
                                        value="{{ $item->user->alamat }}" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Detail Alamat</label>
                                    <input type="text" id="first-name-vertical" required
                                        value="{{ $item->detail_alamat }}" class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Produk</label>
                                    <input type="text" id="first-name-vertical" required
                                        value="{{ $item->produk->nama }}" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Harga Produk</label>
                                    <input type="text" id="first-name-vertical" required
                                        value="Rp. {{ number_format($item->produk->harga, 0, ',', '.') }}"
                                        class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Warna</label>
                                    <input type="text" id="first-name-vertical" required
                                        value="{{ $item->color->name_color }}" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kode Warna</label>
                                    <input type="text" id="first-name-vertical" required
                                        value="{{ $item->color->code_color }}" class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Qty</label>
                                    <input type="text" id="first-name-vertical" required value="{{ $item->qty }}"
                                        class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Total Harga Produk</label>
                                    <input type="text" id="first-name-vertical" required
                                        value="Rp. {{ number_format($item->grand_total, 0, ',', '.') }}"
                                        class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Detail Pesanan</label>
                                    <input type="text" id="first-name-vertical" required
                                        value="{{ $item->detail_pesanan }}" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Status Pesanan</label>
                                    <input type="text" id="first-name-vertical" required value="{{ $item->status }}"
                                        class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Status Pembayaran</label>
                                    <input type="text" id="first-name-vertical" required
                                        value="{{ $item->status_pembayaran }}" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Tanggal Pesan</label>
                                    <input type="text" id="first-name-vertical" required
                                        value="{{ $item->created_at }}" class="form-control" readonly />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tutup</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- modal bukti --}}
    @foreach ($pesanan as $item)
        <div class="modal fade text-left" id="bukti{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" data-bs-backdrop="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Info Pembayaran</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('foto/bukti/' . $item->bukti) }}" alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tutup</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- modal update --}}
    @foreach ($pesanan as $item)
        <div class="modal fade text-left" id="update{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" data-bs-backdrop="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Edit Data Pesanan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ route('pesanan-update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <fieldset class="form-group">
                                <label for="basicSelect">Status Pembayaran</label>
                                <select name="status_pembayaran" class="form-select" id="basicSelect">
                                    <option value="belum_bayar"
                                        {{ $item->status_pembayaran == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar
                                    </option>
                                    <option value="lunas" {{ $item->status_pembayaran == 'lunas' ? 'selected' : '' }}>
                                        Lunas</option>
                                    <option value="dp" {{ $item->status_pembayaran == 'dp' ? 'selected' : '' }}>Dp 50%
                                    </option>
                                </select>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="basicSelect">Status Pesanan</label>
                                <select name="status" class="form-select" id="basicSelect">
                                    <option value="menunggu konfirmasi"
                                        {{ $item->status == 'menunggu konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi
                                    </option>
                                    <option value="proses" {{ $item->status == 'proses' ? 'selected' : '' }}>Proses
                                    </option>
                                    {{-- <option value="dalam pengiriman"
                                        {{ $item->status == 'dalam pengiriman' ? 'selected' : '' }}>Dalam Pengiriman
                                    </option> --}}
                                    <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                            </fieldset>
                            {{-- <div id="bahanBakuContainer{{ $item->id }}">
                                @foreach ($item->detailPesanan as $detail)
                                    <div class="bahan-baku-item">
                                        <fieldset class="form-group">
                                            <label for="basicSelect">Bahan Baku</label>
                                            <select name="bahan_baku_id[]" class="form-select" id="basicSelect">
                                                @foreach ($bahan as $itemBahan)
                                                    <option value="{{ $itemBahan->id }}"
                                                        {{ $detail->bahan_baku_id == $itemBahan->id ? 'selected' : '' }}>
                                                        {{ $itemBahan->nama }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        <div class="form-group">
                                            <label for="first-name-vertical">Jumlah Bahan</label>
                                            <input type="number" required class="form-control" name="qty[]"
                                                value="{{ $detail->bahanBaku->transaksiKeluar->sum('qty') }}" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="addBahanBaku{{ $item->id }}" class="btn btn-secondary">Tambah
                                Bahan Baku</button> --}}
                            <div id="bahanBakuContainer{{ $item->id }}">
                                @if ($item->detailPesanan->isEmpty())
                                    <div class="bahan-baku-item">
                                        <fieldset class="form-group">
                                            <label for="basicSelect">Bahan Baku</label>
                                            <select name="bahan_baku_id[]" class="form-select" id="basicSelect">
                                                @foreach ($bahan as $itemBahan)
                                                    <option value="{{ $itemBahan->id }}">{{ $itemBahan->nama }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        <div class="form-group">
                                            <label for="first-name-vertical">Jumlah Bahan</label>
                                            <input type="number" required class="form-control" name="qty[]" />
                                        </div>
                                    </div>
                                @else
                                    @foreach ($item->detailPesanan as $detail)
                                        <div class="bahan-baku-item">
                                            <fieldset class="form-group">
                                                <label for="basicSelect">Bahan Baku</label>
                                                <select name="bahan_baku_id[]" class="form-select" id="basicSelect">
                                                    @foreach ($bahan as $itemBahan)
                                                        <option value="{{ $itemBahan->id }}"
                                                            {{ $detail->bahan_baku_id == $itemBahan->id ? 'selected' : '' }}>
                                                            {{ $itemBahan->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Jumlah Bahan</label>
                                                <input type="number" required class="form-control" name="qty[]"
                                                    value="{{ $detail->bahanBaku->transaksiKeluar->sum('qty') }}" />
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" id="addBahanBaku{{ $item->id }}" class="btn btn-secondary">Tambah
                                Bahan Baku</button>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Tutup</span>
                            </button>
                            <button type="submit" class="btn btn-primary ms-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('scripts')
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/simple-datatables.js') }}"></script>

    @foreach ($pesanan as $item)
        <script>
            document.getElementById('addBahanBaku{{ $item->id }}').addEventListener('click', function() {
                var container = document.getElementById('bahanBakuContainer{{ $item->id }}');
                var newItem = container.querySelector('.bahan-baku-item').cloneNode(true);
                // Clear the input fields
                newItem.querySelector('select').selectedIndex = 0;
                newItem.querySelector('input').value = '';

                // Check if there are existing detail items
                var existingDetails = container.querySelectorAll('.bahan-baku-item');

                // If no existing detail items, clone the first item
                if (existingDetails.length === 0) {
                    var firstItem = document.querySelector('.bahan-baku-item');
                    newItem = firstItem.cloneNode(true);
                }

                container.appendChild(newItem);
            });
        </script>
    @endforeach


@endpush
{{-- <div id="bahanBakuContainer">
                                <div class="bahan-baku-item">
                                    <fieldset class="form-group">
                                        <label for="basicSelect">Bahan Baku</label>
                                        <select name="bahan_baku_id[]" class="form-select" id="basicSelect">
                                            @foreach ($bahan as $itemBahan)
                                                <option value="{{ $itemBahan->id }}">{{ $itemBahan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                    <div class="form-group">
                                        <label for="first-name-vertical">Jumlah Bahan</label>
                                        <input type="number" required class="form-control" name="qty[]" />
                                    </div>
                                </div>
                            </div> --}}
{{-- <script>
        document.getElementById('addBahanBaku').addEventListener('click', function() {
            var container = document.getElementById('bahanBakuContainer');
            var newItem = container.querySelector('.bahan-baku-item').cloneNode(true);
            container.appendChild(newItem);
        });
    </script> --}}
