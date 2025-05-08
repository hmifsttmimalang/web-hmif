<template>
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div
      class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between"
    >
      <a href="/" class="logo d-flex align-items-center">
        <img src="/assets/img/logo_hmif.jpg" alt="Logo HMIF STT MALANG" />
        <span class="fw-bold text-dark">HMIF SMI MALANG</span>
      </a>

      <nav
        id="navmenu"
        class="navmenu"
        :class="{ 'navmenu-active': isMobileNavActive }"
      >
        <ul>
          <li>
            <a href="#hero" class="active" @click="closeMobileNav">Beranda</a>
          </li>
          <li><a href="#about" @click="closeMobileNav">Tentang Kami</a></li>
          <li><a href="#services" @click="closeMobileNav">Program Kerja</a></li>
          <li><a href="#portfolio" @click="closeMobileNav">Portfolio</a></li>
          <li><a href="#team" @click="closeMobileNav">Tim</a></li>
        </ul>
        <i
          class="mobile-nav-toggle d-xl-none bi"
          :class="isMobileNavActive ? 'bi-x' : 'bi-list'"
          @click="toggleMobileNav"
        ></i>
      </nav>
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";

const isMobileNavActive = ref(false);

function toggleMobileNav() {
  isMobileNavActive.value = !isMobileNavActive.value;
}

function closeMobileNav() {
  isMobileNavActive.value = false;
}

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
  onScroll();
});

onBeforeUnmount(() => {
  window.removeEventListener("scroll", onScroll);
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

@media (max-width: 768px) {
  .navmenu {
    display: none;
    position: absolute;
    top: 60px;
    right: 20px;
    background: white;
    padding: 1rem;
    border-radius: 5px;
    z-index: 999;
    flex-direction: column;
    align-items: flex-start;
  }

  .navmenu.navmenu-active {
    display: flex !important;
  }

  .navmenu ul {
    list-style: none;
    padding: 0;
    margin: 0;
    width: 100%;
  }

  .navmenu ul li {
    width: 100%;
    margin-bottom: 0.5rem;
  }

  .navmenu ul li a {
    color: #000;
    display: block;
    width: 100%;
    padding: 0.5rem;
  }
}
</style>
