<template>
  <section id="hero" class="hero section dark-background">
    <div
      id="hero-carousel"
      class="carousel slide carousel-fade"
      data-bs-ride="carousel"
      data-bs-interval="5000"
    >
      <div
        class="carousel-item active"
        v-for="(item, index) in carouselItems"
        :key="index"
      >
        <img :src="item.imgSrc" alt="" />
        <div class="carousel-container">
          <h2 class="text-center">{{ item.title }}</h2>
          <p class="text-center">{{ item.description }}</p>
        </div>
      </div>
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
    </div>
  </section>
</template>

<script>
export default {
  name: "HeroSection",
  data() {
    return {
      carouselItems: [
        {
          imgSrc: new URL("@/assets/img/kegiatan/IMG_1056.JPG", import.meta.url)
            .href,
          title: "We Are\nHMIF SMI MALANG",
          description:
            "Selamat datang di website resmi HMIF SMI MALANG! Kami adalah Himpunan Mahasiswa Informatika Sekolah Tinggi Teknik Multimedia Internasional Malang.",
        },
        {
          imgSrc: new URL(
            "@/assets/img/kegiatan/Futsal (2).jpg",
            import.meta.url
          ).href,
          title: "We Are\nHMIF SMI MALANG",
          description:
            "Selamat datang di website resmi HMIF SMI MALANG! Kami adalah Himpunan Mahasiswa Informatika Sekolah Tinggi Teknik Multimedia Internasional Malang.",
        },
        {
          imgSrc: new URL("@/assets/img/kegiatan/IMG_1036.JPG", import.meta.url)
            .href,
          title: "We Are\nHMIF SMI MALANG",
          description:
            "Selamat datang di website resmi HMIF SMI MALANG! Kami adalah Himpunan Mahasiswa Informatika Sekolah Tinggi Teknik Multimedia Internasional Malang.",
        },
      ],
    };
  },
};
</script>
