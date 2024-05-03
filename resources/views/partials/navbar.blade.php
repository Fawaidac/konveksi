<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">

        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <img class="mr-1" src="assets/img/logo-rbg.png" height="50px"></img>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="/" class="nav-item nav-link {{ Route::is('home') ? 'active' : '' }}">Home</a>
                        <a href="/shop" class="nav-item nav-link {{ Route::is('shop') ? 'active' : '' }}">Produk</a>
                        <a href="detail.html" class="nav-item nav-link">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                <a href="checkout.html" class="dropdown-item">Checkout</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        @guest
                            <a href="/login" class="nav-item nav-link {{ Route::is('login') ? 'active' : '' }}">Login</a>
                            <a href="/register"
                                class="nav-item nav-link {{ Route::is('register') ? 'active' : '' }}">Register</a>
                        @endguest
                    </div>

                </div>
            </nav>

        </div>
    </div>
</div>
