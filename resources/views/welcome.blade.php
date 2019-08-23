@extends('layouts.app')

@section('content')
    
      <section class="welcome_area bg-img background-overlay" style="background-image: url(template/img/IF.jpg);">
  <div class="container h-100">
    <div class="row h-100 align-items-center">
        <div class="col-12">
          <div class="hero-content">
            <h6 id="top" style="color:white">Selamat Datang di Laboratorium</h6>
            <h2 style="color:white">Arsitektur dan Jaringan Komputer</h2>
            <a href="#lanjut" class="btn essence-btn">Lihat Pengumuman</a>
          </div>
        </div>
    </div>
  </div>
</section>
  
      <section>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2">
              <div class="p-5">
                <img class="img-fluid rounded-circle" src="{{ asset('template/img/Network2.jpg') }}" alt="">
              </div>
            </div>
            <div class="col-lg-6 order-lg-1">
              <div class="p-5">
                <h2 class="display-4">Berfokus di Bidang Jaringan!</h2>
                <p>Di zaman modern ini semua bisa dilakukan secara terhubung karena jaringan. Lab ini tahu cara merancang, membuat, dan memperbaiki jaringan</p>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <section>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="p-5">
                <img class="img-fluid rounded-circle" src="{{ asset('template/img/Anonymous.jpg') }}" alt="">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="p-5">
                <h2 class="display-4">Penuh dengan Prestasi!</h2>
                <p>Terdapat berbagai banyak penghargaan seperti pemenang piala LBE terbaik maupun kompetisi di bidang jaringan!</p>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <section>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2">
              <div class="p-5">
                <img class="img-fluid rounded-circle" src="{{ asset('template/img/03.jpg') }}" alt="">
              </div>
            </div>
            <div class="col-lg-6 order-lg-1">
              <div class="p-5">
                <h2 class="display-4">Masih ragu untuk masuk ke lab AJK?</h2>
                <p>Ayo segera daftar ke website ini!</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <br>
      <section id="lanjut" style="text-align:center;">
          <br><br><br><br><br><br><br><br>
          <a href="/pengumuman" class="btn btn-primary btn-xl rounded-pill mt-5">Lihat Pengumuman</a>
          <br><br><br><br>
      </section>
      <br>
      
@endsection
    