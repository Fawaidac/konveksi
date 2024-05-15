@extends('layouts.main-landing')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
@section('content')
    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center"
            data-background="{{ asset('assets/img/hero/h1_hero.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Checkout</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_padding">
        <div class="container">
            <div class="billing_details">
                <form action="{{ route('checkout-store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-8">
                            <h3>Detail Pemesanan</h3>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="first"
                                    value="{{ auth()->user()->name }}" />
                            </div>
                            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                            <input type="hidden" value="{{ $produk->id }}" name="produk_id">
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="number"
                                    value="{{ auth()->user()->notelp }}" />
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="email"
                                    value="{{ auth()->user()->email }}" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add1"
                                    value="{{ auth()->user()->alamat }}" />
                            </div>
                            <div class="col-md-12">
                                <div class="input-group-icon mt-10 form-group">
                                    <div class="icon"><i class="fa fa-paint-brush" aria-hidden="true"></i></div>
                                    <div class="form-select" id="default-select">
                                        <select required name="color_id">
                                            <option selected>Pilih Warna</option>
                                            @foreach ($warna as $item)
                                                <option value="{{ $item->color->id }}">{{ $item->color->name_color }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="form-control" name="detail_alamat" id="message" rows="3" required
                                    placeholder="Tambah detail alamat anda"></textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="form-control" required name="detail_pesanan" id="message" rows="3"
                                    placeholder="Detail pesanan"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Pesanan Anda</h2>
                                <ul class="list">
                                    <li>
                                        <a href="#">Produk
                                            <span>Total</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">{{ $produk->nama }}
                                            <span class="middle">x {{ $qty }}</span>
                                            <input type="hidden" name="qty" value="{{ $qty }} ">
                                            <!-- Tampilkan nilai qty di sini -->
                                            <span class="last">Rp.
                                                {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                            <!-- Hitung harga total berdasarkan qty -->
                                        </a>
                                    </li>
                                </ul>
                                <ul class="list list_2">
                                    <li>
                                        <a href="#">Total
                                            <span>Rp. {{ number_format($produk->harga * $qty, 0, ',', '.') }}</span>
                                            <!-- Tampilkan harga total berdasarkan qty -->
                                            <input type="hidden" name="grand_total" value="{{ $produk->harga * $qty }} ">
                                        </a>
                                    </li>
                                </ul>
                                <div class="payment_item">
                                    <div class="form-group mt-2">
                                        <label for="bukti" style="font-size: 12px">Upload Bukti pembayaran</label>
                                        <input type="file" class="form-control" id="bukti" required name="bukti" />
                                    </div>
                                    <p>
                                        Silahkan lakukan pembayaran dengan DP 50% atau bisa langsung melunasi total harga
                                        agar
                                        pesanan segera diproses
                                    </p>
                                    @foreach ($bank as $item)
                                        <p>{{ $item->nama }} = {{ $item->no_rekening }}</p>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn_3"">Pesan Sekarang</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection
