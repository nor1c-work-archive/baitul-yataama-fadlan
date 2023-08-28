<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="@yield('meta-title')">
    <meta name="description" content="@yield('meta-description')">
    <meta name="keywords" content="@yield('meta-keywords')">

    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('images/logo.png')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('template/css/bootstrap.min.css')}}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{asset('template/css/animate.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('template/css/owl.carousel.min.css')}}">
    <!-- themify CSS -->
    <link rel="stylesheet" href="{{asset('template/css/themify-icons.css')}}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{asset('template/css/flaticon.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('template/css/magnific-popup.css')}}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{asset('template/css/slick.css')}}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{asset('template/css/style.css')}}">

    <style type="text/css">
        .logo-width{
            width: 70px !important;
        }

        .icon-web{
            width: 50px !important;
        }

        @media only screen and (max-width: 600px) {
            .icon-web{
                width: 40px !important;
            }
        }
    </style>

    @yield('userStyle')
</head>

<body>
    @php
    $static_content = App\Http\Controllers\ComproController::getFooterFuction();
    @endphp

    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{route('home')}}"> <img class="logo-width" src="{{asset('images/logo.png')}}" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="ti-menu"></span>
                    </button>

                    @include('template.navbar')
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header part end-->

@yield('content')
@if((request()->route()->getName() != "donasi.konsumen") && (request()->route()->getName() != "donasi.konsumen.detail") && (request()->route()->getName() != "donasi.konsumen.buat_donasi"))
<section class="padding-bottom">
    <div class="container">
        <div class="row ">
            <div class="col-xl-12">
                <div class="section_tittle text-center">
                    <h3>Ayo Kamu Dapat Donasi Mulai Dari Rp. 1000</h3>
                    <a class="btn_1" href="{{route('donasi.konsumen')}}">Donasi Disini</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- footer part start-->
<footer class="footer-area">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-6 col-md-4 col-xl-3">
                <div class="single-footer-widget footer_1">
                    <a href="index.html"> <img src="{{asset('images/logo.png')}}" alt="Logo" width="120px;"> </a>
                    <p>Kami berharap masyarakat dapat terus berkontribusi untuk membantu kami dalam memeberikan yang terbaik kepada yang membutuhkan, mulai dari Rp. 1000 anda sudah dapat ikut serta membantu dan berdonasi di Yayasan Baitul Yataama Fadlan. Semoga Allah SWT membalas kebaikan kita semua, Aamiin ya rabbal’alamin.</p>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4">
                <div class="single-footer-widget footer_2">
                    <h4>Info Selengkapnya</h4>
                    <div class="contact_info">
                        <ul>
                            <li>
                                <a href="#">Cara Berdonasi</a>
                            </li>
                            <li>
                                <a href="#">Kabar/Berita</a>
                            </li>
                            <li>
                                <a href="#">Tentang Kami</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4">
                <div class="single-footer-widget footer_2">
                    <h4>Social Media</h4>
                    <div class="contact_info">
                        <ul>
                            <li>
                                <a href="{{$static_content['profil']->facebook}}" target="_blank"><i class="ti ti-facebook"></i> Facebook</a>
                            </li>
                            <li>
                                <a href="{{$static_content['profil']->youtube}}" target="_blank"><i class="ti ti-youtube"></i> Youtube</a>
                            </li>
                            <li>
                                <a href="{{$static_content['profil']->instagram}}" target="_blank"><i class="ti ti-instagram"></i> Instagram</a>
                            </li>
                            <li>
                                <a href="{{$static_content['profil']->twitter}}" target="_blank"><i class="ti ti-twitter"></i> Twitter</a>
                            </li>
                            <li>
                                <a href="{{'https://api.whatsapp.com/send?phone='.$static_content['profil']->whatsapp.'&text=Assalamaualaikum, saya ingin bertanya'}}" target="_blank"><i class="ti ti-themify-favicon"></i> Whatsapp</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-4">
                <div class="single-footer-widget footer_2">
                    <h4>Hubungi Kami</h4>
                    <div class="contact_info"> 
                        <p>{{$static_content['cabang']->alamat}}</p>
                        <p><span> Telepon :</span> {{$static_content['profil']->no_telfon}}</p>
                        <p><span> Email : </span>{{$static_content['profil']->email}}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright_part_text text-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="footer-text m-0">
                                Hak Cipta &copy;<script>document.write(new Date().getFullYear());</script> Yayasan Baitul Yataama Fadlan</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer part end-->

    <!-- jquery plugins here-->
    <!-- jquery -->
    <script src="{{asset('template/js/jquery-1.12.1.min.js')}}"></script>
    <!-- popper js -->
    <script src="{{asset('template/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('template/js/bootstrap.min.js')}}"></script>
    <!-- easing js -->
    <script src="{{asset('template/js/jquery.magnific-popup.js')}}"></script>
    <!-- swiper js -->
    <script src="{{asset('template/js/swiper.min.js')}}"></script>
    <!-- isotope js -->
    <script src="{{asset('template/js/isotope.pkgd.min.js')}}"></script>
    <!-- particles js -->
    <script src="{{asset('template/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.nice-select.min.js')}}"></script>
    <!-- swiper js -->
    <script src="{{asset('template/js/slick.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('template/js/waypoints.min.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('template/js/custom.js')}}"></script>
    <script src="//code.jivosite.com/widget/OYvpuNOZtq" async></script>
    @yield('userScript')
</body>

</html>