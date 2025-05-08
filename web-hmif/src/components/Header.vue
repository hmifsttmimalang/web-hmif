<template>
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div
      class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between"
    >
      <a href="/" class="logo d-flex align-items-center">
        <img src="/assets/img/logo_hmif.jpg" alt="Logo HMIF STT MALANG" />
        <span class="fw-bold text-dark">HMIF SMI MALANG</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Beranda</a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#services">Program Kerja</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Tim</a></li>
          <!-- <li><a href="#contact">Contact</a></li> -->
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>
</template>

<script setup>
import { onMounted } from "vue";

onMounted(() => {
  const sections = document.querySelectorAll("section");
  const navLinks = document.querySelectorAll("#navmenu a");

  function onScroll() {
    let scrollY = window.pageYOffset;

    sections.forEach((section) => {
      const offsetTop = section.offsetTop - 100;
      const offsetBottom = offsetTop + section.offsetHeight;
      const id = section.getAttribute("id");

      if (scrollY >= offsetTop && scrollY < offsetBottom) {
        navLinks.forEach((link) => {
          link.classList.remove("active");
          if (link.getAttribute("href") === `#${id}`) {
            link.classList.add("active");
          }
        });
      }
    });
  }

  window.addEventListener("scroll", onScroll);
});
</script>

<style scoped>
.logo img {
  max-height: 40px;
}

a {
  text-decoration: none;
  color: #000;
}
</style>
