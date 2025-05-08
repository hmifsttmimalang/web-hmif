<template>
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div
      class="container-fluid container-xl d-flex align-items-center justify-content-between position-relative"
    >
      <!-- Logo -->
      <a href="/" class="logo d-flex align-items-center">
        <img src="/assets/img/logo_hmif.jpg" alt="Logo HMIF STT MALANG" />
        <span class="fw-bold text-dark ms-2">HMIF SMI MALANG</span>
      </a>

      <!-- Navigation -->
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

        <!-- Toggle Button (mobile only) -->
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

function onScroll() {
  const sections = document.querySelectorAll("section");
  const navLinks = document.querySelectorAll("#navmenu a");
  const scrollY = window.pageYOffset;

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

onMounted(() => {
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

/* Mobile Navigation Styles */
@media (max-width: 768px) {
  .navmenu {
    display: none;
    position: absolute;
    top: 60px;
    right: 20px;
    background-color: white;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 999;
    flex-direction: column;
    align-items: flex-start;
    width: 200px;
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
    margin-bottom: 0.5rem;
    width: 100%;
  }

  .navmenu ul li a {
    color: #000;
    display: block;
    width: 100%;
    padding: 0.5rem;
    border-radius: 4px;
  }

  .navmenu ul li a:hover {
    background-color: #f0f0f0;
  }

  .mobile-nav-toggle {
    font-size: 1.5rem;
    cursor: pointer;
    margin-top: 0.5rem;
  }
}
</style>
