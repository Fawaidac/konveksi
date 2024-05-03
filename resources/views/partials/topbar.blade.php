<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="">FAQs</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Help</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Support</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2" href="">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="" class="text-decoration-none">
                <h1 class="m-2"><span class="text-primary font-weight-bold border px-3 mr-1">Sentral</span></h1>
            </a>
            <p class="ml-4">Konveksi Jember</p>
        </div>
        <div class="col-lg-5 col-4 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        @if (auth()->check() && auth()->user()->is_admin == 0)
            <div class="col-lg-3 col-6 text-right">
                <div class="avatar bg-primary dropdown">
                    <a href="#" class="avatar-content dropdown-toggle" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </a>
                    <span class="avatar-status bg-success"></span>
                    <div class="dropdown-menu rounded-0 m-0" aria-labelledby="dropdownMenuButton">
                        <a href="cart.html" class="dropdown-item">Akun Saya</a>
                        <a href="checkout.html" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
