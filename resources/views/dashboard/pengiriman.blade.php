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
                                <td>{{ $item->pesanan->user->name }}</td>
                                <td>
                                    {{ $item->pesanan->produk->nama }} x {{ $item->pesanan->qty }}
                                </td>
                                <td>
                                    Rp. {{ number_format($item->pesanan->grand_total, 0, ',', '.') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal_pengiriman)->format('d F Y') }}
                                </td>
                                <td> {{ $item->estimasi }} </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal_tiba)->format('d F Y') }}
                                </td>
                                <td>
                                    {{ $item->status }}
                                </td>
                                <td>
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

    {{-- modal add --}}
    <div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Tambah Data Pengiriman</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('pengiriman.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pesanan">Pesanan</label>
                            <select class="choices form-select" id="pesanan" name="pesanan_id" required>
                                <optgroup label="Pesanan">
                                    @foreach ($pesanan as $item)
                                        <option value="{{ $item->id }}">{{ $item->user->name }} -
                                            {{ $item->produk->nama }} x {{ $item->qty }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pesanan">Status</label>
                            <select class="choices form-select" id="pesanan" name="status" required>
                                <optgroup label="Status">
                                    <option value="proses">Proses</option>
                                    <option value="dalam perjalanan">Dalam Perjalanan</option>
                                    {{-- <option value="sampai">Sampai</option> --}}
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="first-name-vertical">Tanggal Pengiriman</label>
                            <input type="date" id="first-name-vertical" required class="form-control"
                                name="tanggal_pengiriman" required />
                        </div>
                        <div class="form-group">
                            <label for="first-name-vertical">Estimasi Sampai</label>
                            <input type="text" id="first-name-vertical" required class="form-control" name="estimasi"
                                placeholder="0 hari" required />
                        </div>
                        <div class="form-group">
                            <label for="first-name-vertical">Tanggal Tiba</label>
                            <input type="date" id="first-name-vertical" required class="form-control" name="tanggal_tiba"
                                required />
                        </div>
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
    {{-- modal edit --}}
    @foreach ($pengiriman as $item)
        <div class="modal fade text-left" id="update{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" data-bs-backdrop="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Tambah Data Pengiriman</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ route('pengiriman.update', $item->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="pesanan">Status</label>
                                <select class="choices form-select" id="pesanan" name="status" required>
                                    <optgroup label="Status">
                                        <option value="proses" {{ $item->status == 'proses' ? 'selected' : '' }}>
                                            Proses
                                        </option>
                                        <option value="dalam perjalanan"
                                            {{ $item->status == 'dalam perjalanan' ? 'selected' : '' }}>Dalam Perjalanan
                                        </option>
                                        {{-- <option value="sampai">Sampai</option> --}}
                                    </optgroup>
                                </select>
                            </div>
                            @if ($item->pesanan->pengiriman === 'pengiriman')
                                <div class="form-group">
                                    <label for="first-name-vertical">Jasa Ekspedisi</label>
                                    <input type="text" required class="form-control" name="jasa_ekspedisi" required
                                        value="{{ $item->pesanan->jasa_ekspedisi }}" />
                                </div>
                                <div class="form-group">
                                    <label for="first-name-vertical">Total Ongkir</label>
                                    <input type="number" required class="form-control" name="harga_ongkir"
                                        value="{{ $item->pesanan->harga_ongkir }}" required />
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="first-name-vertical">Tanggal Pengiriman</label>
                                <input type="date" id="first-name-vertical" required class="form-control"
                                    name="tanggal_pengiriman" value="{{ $item->tanggal_pengiriman }}" required />
                            </div>
                            <div class="form-group">
                                <label for="first-name-vertical">Estimasi Sampai</label>
                                <input type="text" id="first-name-vertical" required class="form-control"
                                    name="estimasi" placeholder="0 hari" value="{{ $item->estimasi }}" required />
                            </div>
                            <div class="form-group">
                                <label for="first-name-vertical">Tanggal Tiba</label>
                                <input type="date" id="first-name-vertical" required class="form-control"
                                    name="tanggal_tiba" value="{{ $item->tanggal_tiba }}" required />
                            </div>
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
@endpush
