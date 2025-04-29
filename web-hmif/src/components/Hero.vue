<template>
  <section id="hero" class="hero section dark-background">
    <div
      id="hero-carousel"
      class="carousel slide carousel-fade"
      data-bs-ride="carousel"
      data-bs-interval="5000"
    >
      <div class="carousel-item active">
        <img :src="FotoBersama" alt="" />
        <div class="carousel-container">
          <h2>
            We Are <br />
            HMIF SMI MALANG
          </h2>
          <p>
            Selamat datang di website resmi HMIF SMI MALANG! Kami adalah
            Himpunan Mahasiswa Informatika Sekolah Tinggi Teknik Multimedia
            Internasional Malang, atau dikenal sebagai HMIF SMI MALANG Sebagai
            organisasi yang mewadahi mahasiswa dari segala jurusan di SMI
            MALANG, HMIF SMI MALANG memiliki tujuan untuk mengembangkan dan
            meningkatkan kualitas serta kemampuan mahasiswa dalam bidang
            teknologi dan informatika.
          </p>
          <!-- <a href="#featured-services" class="btn-get-started">Get Started</a> -->
        </div>
      </div>
      <!-- End Carousel Item -->

      <div class="carousel-item">
        <img :src="Futsal_2" alt="" />
        <div class="carousel-container">
          <h2>
            We Are <br />
            HMIF SMI MALANG
          </h2>
          <p>
            Selamat datang di website resmi HMIF SMI MALANG! Kami adalah
            Himpunan Mahasiswa Informatika Sekolah Tinggi Teknik Multimedia
            Internasional Malang, atau dikenal sebagai HMIF SMI MALANG Sebagai
            organisasi yang mewadahi mahasiswa dari segala jurusan di SMI
            MALANG, HMIF SMI MALANG memiliki tujuan untuk mengembangkan dan
            meningkatkan kualitas serta kemampuan mahasiswa dalam bidang
            teknologi dan informatika.
          </p>
          <!-- <a href="#featured-services" class="btn-get-started">Get Started</a> -->
        </div>
      </div>
      <!-- End Carousel Item -->

      <div class="carousel-item">
        <img :src="FotoBersama_2" alt="" />
        <div class="carousel-container">
          <h2>
            We Are <br />
            HMIF SMI MALANG
          </h2>
          <p>
            Selamat datang di website resmi HMIF SMI MALANG! Kami adalah
            Himpunan Mahasiswa Informatika Sekolah Tinggi Teknik Multimedia
            Internasional Malang, atau dikenal sebagai HMIF SMI MALANG Sebagai
            organisasi yang mewadahi mahasiswa dari segala jurusan di SMI
            MALANG, HMIF SMI MALANG memiliki tujuan untuk mengembangkan dan
            meningkatkan kualitas serta kemampuan mahasiswa dalam bidang
            teknologi dan informatika.
          </p>
          <!-- <a href="#featured-services" class="btn-get-started">Get Started</a> -->
        </div>
      </div>
      <!-- End Carousel Item -->

      <a
        class="carousel-control-prev"
        href="#hero-carousel"
        role="button"
        data-bs-slide="prev"
      >
        <span
          class="carousel-control-prev-icon bi bi-chevron-left"
          aria-hidden="true"
        ></span>
      </a>

      <a
        class="carousel-control-next"
        href="#hero-carousel"
        role="button"
        data-bs-slide="next"
      >
        <span
          class="carousel-control-next-icon bi bi-chevron-right"
          aria-hidden="true"
        ></span>
      </a>

      <ol class="carousel-indicators"></ol>
    </div>
  </section>
</template>

<script setup>
    import FotoBersama from '../assets/img/kegiatan/IMG_1056.JPG';
    import FotoBersama_2 from '../assets/img/kegiatan/IMG_1036.JPG';
    import Futsal_2 from '../assets/img/kegiatan/Futsal (2).jpg';
</script>

<style scoped>
  h2 {
    text-align: center;
  }

  p {
    text-align: center;
  }
</style>
