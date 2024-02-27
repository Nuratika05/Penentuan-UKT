<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Aplikasi Penentuan UKT Politani Samarinda</title>

  <!-- Favicons -->
  <link href="{{ asset('logo_politani.png') }}" rel="icon">
  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

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
        <h2><img src="{{asset('logo_politani.png')}}" alt="">POLITANI</a></h2>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
          @if (Auth::guard('mahasiswa')->check())
          <li><a class="nav-link scrollto" href="{{ route('mahasiswa.home') }}">Profil</a></li>
          <br>
          @elseif (Auth::guard('admin')->check())
          <li><a class="nav-link scrollto" href="{{ route('admin.home') }}">Dashboard</a></li>
          @else
            <li><a href="{{ route('mahasiswa.login') }}">Login</a></li>
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
                <h2 class="animate__animated animate__fadeInDown">Selamat Datang <span>di<br>Penentuan UKT<br>Politeknik Pertanian Negeri Samarinda</span></h2>
            </div>
            </div>
          </div>
              </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <br>
        <div class="row content">
            <div class="col-lg-6">
              <h2 style="text-align: center">Tentang Penentuan UKT</h2>
                <h5 style="text-align: justify">Penentuan UKT ini dirancang untuk membantu Anda menentukan besaran Uang Kuliah Tunggal (UKT) berdasarkan informasi yang Anda berikan.
                </h5></div>
            <div class="col-lg-6 pt-4 pt-lg-0">
              <h5 style="text-align: justify">
                Secara sederhana, penentuan UKT ini bekerja dengan cara mengumpulkan informasi atau data mengenai kondisi ekonomi mahasiswa dan faktor-faktor lain yang dapat memengaruhi kemampuannya untuk membayar uang kuliah. Aplikasi ini kemudian melakukan perhitungan berdasarkan parameter-parameter yang telah ditetapkan oleh perguruan tinggi untuk menentukan besaran UKT yang sesuai dengan situasi finansial mahasiswa tersebut.
              </h5>
              <h3>Panduan pengguna bisa dilihat pada pdf berikut!
              </h3>
              <p>
                @if (Auth::guard('mahasiswa')->check())
                <a href="{{ asset('storage/pdf/Panduan Pengguna.pdf')}}" target="_blank"><img src="{{asset('assets/img/pdf.png')}}" style="width: 30px">Panduan Pengguna</a>
                @elseif (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
                <a href="{{ asset('storage/pdf/Panduan Pengguna Admin.pdf')}}" target="_blank"><img src="{{asset('assets/img/pdf.png')}}" style="width: 30px">Panduan Pengguna</a>
                @else
                <a href="{{ asset('storage/pdf/Panduan Pengguna Verifikator.pdf')}}" target="_blank"><img src="{{asset('assets/img/pdf.png')}}" style="width: 30px">Panduan Pengguna</a>
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

        <div class="info-wrap mt-5">
          <div class="row">
            <div class="col-lg-4 info">
              <i class="ri-map-pin-line"></i>
              <h4>Location:</h4>
              <p>Jl. Samratulangi, Sungai keledang, Kec. Samarinda Seberang, Kota Samarinda<br>Kalimantan Timur, 75131</p>
            </div>

            <div class="col-lg-4 info mt-4 mt-lg-0">
              <i class="ri-mail-line"></i>
              <h4>Email:</h4>
              <p>info@politanisamarinda.ac.id<br>politanismd@gmail.com</p>
            </div>

            <div class="col-lg-4 info mt-4 mt-lg-0">
              <i class="ri-phone-line"></i>
              <h4>Call:</h4>
              <p>(0541) 260421, 260680</p>
              <p>(0541) 260680</p>
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
        <div class="row">


        </div>
      </div>
    </div>

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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Template Main JS File -->
  <script src="{{ asset('frontend/js/main.js')}}"></script>

</body>

</html>
