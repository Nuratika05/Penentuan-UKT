<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Penentuan UKT Politani Samarinda</title>

    <!-- Favicons -->
    <link href="{{ asset('logo_politani.png') }}" rel="icon">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: MyBiz
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/mybiz-free-business-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Top Bar ======= -->

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <h2><img src="{{ asset('logo_politani.png') }}" alt="">POLITANI</a></h2>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
                    @if (Auth::guard('mahasiswa')->check())
                        <li><a class="nav-link scrollto" href="{{ route('mahasiswa.home') }}">Profile</a></li>
                        <br>
                    @elseif (Auth::guard('admin')->check())
                        <li><a class="nav-link scrollto" href="{{ route('admin.home') }}">Dashboard</a></li>
                    @else
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown">Login</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('mahasiswa.login') }}">Mahasiswa</a></li>
                                <li><a href="{{ route('admin.login') }}">Admin</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner" role="listbox">

                    <!-- Slide 1 -->
                    <div class="carousel-item active" style="background-image: url(frontend/img/slide/slide-3.jpg);">
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2 class="animate__animated animate__fadeInDown">Selamat Datang <span>di<br>Penentuan
                                        UKT<br>Politeknik Pertanian Negeri Samarinda</span></h2>
                            </div>
                        </div>
                    </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">
                <br>
                <div class="row content" style="width: 90%; margin: 0 auto;">
                    <div class=" col-lg-6 pt-4 pt-lg-0">
                        <div class="card p-4 bg-dark text-white">
                            <h2 style="text-align: center">Tentang Penentuan UKT</h2>
                            <h5 style="text-align: justify">Penentuan UKT ini dirancang untuk membantu Anda menentukan
                                besaran Uang Kuliah Tunggal (UKT) berdasarkan informasi yang Anda berikan.
                                Secara sederhana, penentuan UKT ini bekerja dengan cara mengumpulkan informasi atau data
                                mengenai kondisi ekonomi mahasiswa dan faktor-faktor lain yang dapat memengaruhi
                                kemampuannya untuk membayar uang kuliah. Aplikasi ini kemudian melakukan perhitungan
                                berdasarkan parameter-parameter yang telah ditetapkan oleh perguruan tinggi untuk
                                menentukan
                                besaran UKT yang sesuai dengan situasi finansial mahasiswa tersebut.
                            </h5>
                        </div>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <div class="card p-3">
                            <h5>Panduan pengguna bisa dilihat pada pdf berikut!
                            </h5>
                            <p>
                                @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
                                    <a href="{{ asset('storage/PanduanPenggunaAdmin.pdf') }}" target="_blank"><img
                                            src="{{ asset('assets/img/pdf.png') }}" style="width: 30px">Panduan
                                        Pengguna</a>
                                @elseif (Auth::guard('admin')->check() && Auth::user()->role == 'verifikator')
                                    <a href="{{ asset('storage/PanduanPenggunaVerifikator.pdf') }}"
                                        target="_blank"><img src="{{ asset('assets/img/pdf.png') }}"
                                            style="width: 30px">Panduan Pengguna</a>
                                @else
                                    <a href="{{ asset('storage/PanduanPenggunaMahasiswa.pdf') }}"
                                        target="_blank"><img src="{{ asset('assets/img/pdf.png') }}"
                                            style="width: 30px">Panduan
                                        Pengguna</a>
                                @endif
                            </p>
                        </div>
                    </div>

        </section><!-- End About Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">
                <div class="section-title">
                    <h2>KONTAK</h2>
                </div>
            </div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-4 info mt-4 mt-lg-0">
                        <div class="card p-4"
                            style="width: 100%; background-color: #f8f9fa; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1); border: none;">
                            <i class="ri-map-pin-line" style="font-size: 50px;"></i>
                            <div class="ms-3">
                                <h4>Lokasi:</h4>
                                Jl. Samratulangi, Sungai keledang, Kec. Samarinda Seberang, Kota
                                Samarinda, Prov. Kalimantan Timur, 75131
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 info mt-4 mt-lg-0">
                        <div class="card p-4"
                            style="width: 100%; background-color: #f8f9fa; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1); border: none;">
                            <i class="ri-mail-line" style="font-size: 50px;"></i>
                            <div class="ms-3">
                                <h4>Email:</h4>
                                <li>info@politanisamarinda.ac.id</li>
                                <li>politanismd@gmail.com</li>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 info mt-4 mt-lg-0">
                        <div class="card p-4"
                            style="width: 100%; background-color: #f8f9fa; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1); border: none;">
                            <i class="ri-phone-line" style="font-size: 50px;"></i>
                            <div class="ms-3">
                                <h4>Telepon:</h4>
                                <li>(0541) 260421, 260680</li>
                                <li>(0541) 260680</li>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </div>
            </div>

        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>MyBiz</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mybiz-free-business-bootstrap-theme/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Template Main JS File -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

</body>

</html>
