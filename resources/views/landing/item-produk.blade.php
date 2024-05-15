@extends('layouts.main-landing')

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
                            <h2>Detail Produk</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="product_img_slide owl-carousel">
                        <div class="single_product_img">
                            <img src="{{ asset('foto/product/' . $produk->image) }}" alt="#" class="img-fluid">
                        </div>

                    </div>

                </div>

                <div class="col-lg-8">
                    <div class="single_product_text text-center">
                        <h3>{{ $produk->nama }}<br>
                        </h3>
                        <div class="product_count_area mb-2">
                            <div class="button-group-area">
                                @foreach ($produk->detail as $detail)
                                    <a class="genric-btn disable"
                                        style="background: {{ $detail->color->code_color }}">{{ $detail->color->name_color }}</a>
                                @endforeach
                            </div>
                        </div>
                        <p>
                            {{ $produk->deskripsi }}
                        </p>
                        <p>Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        <form action="{{ route('checkout', ['id' => $produk->id]) }}" method="GET">
                            <div class="card_area">
                                <div class="product_count d-inline-block">
                                    <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                                    <input name="qty" class="product_count_item input-number" type="text"
                                        value="1" min="1" max="">
                                    <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                                </div>
                                <div class="add_to_cart">
                                    <button type="submit" class="btn_3">CheckOut</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->
    <!-- subscribe part here -->
    <section class="subscribe_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="subscribe_part_content">
                        <h2>Get promotions & updates!</h2>
                        <p>Seamlessly empower fully researched growth strategies and interoperable internal or “organic”
                            sources credibly innovate granular internal .</p>
                        <div class="subscribe_form">
                            <input type="email" placeholder="Enter your mail">
                            <a href="#" class="btn_1">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- subscribe part end -->
@endsection
