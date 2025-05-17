<template>
  <header
    id="header"
    class="header d-flex align-items-center fixed-top bg-white shadow-sm"
  >
    <div
      class="container-fluid container-xl d-flex align-items-center justify-content-between position-relative"
    >
      <!-- Logo -->
      <router-link to="/" class="logo d-flex align-items-center">
        <img src="/assets/img/logo_hmif.jpg" alt="Logo HMIF STT MALANG" />
        <span class="fw-bold text-dark ms-2">HMIF SMI MALANG</span>
      </router-link>

      <!-- Desktop Nav -->
      <nav id="navmenu" class="navmenu d-none d-xl-flex">
        <ul>
          <li><router-link to="/" exact>Beranda</router-link></li>
          <li><router-link to="/post">Blog</router-link></li>
        </ul>
      </nav>

      <!-- Mobile Nav -->
      <nav
        id="mobile-navmenu"
        class="navmenu-mobile d-xl-none"
        :class="{ 'navmenu-active': isMobileNavActive }"
      >
        <ul>
          <li>
            <router-link to="/" exact @click="closeMobileNav"
              >Beranda</router-link
            >
          </li>
          <li><router-link to="/post">Blog</router-link></li>
        </ul>
      </nav>

      <!-- Mobile Nav Toggle Button -->
      <i
        class="mobile-nav-toggle d-xl-none bi"
        :class="isMobileNavActive ? 'bi-x' : 'bi-list'"
        @click="toggleMobileNav"
      ></i>
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";

const isMobileNavActive = ref(false);
let sections;
let navLinks;
let mobileNavLinks;

function toggleMobileNav() {
  isMobileNavActive.value = !isMobileNavActive.value;
}

function closeMobileNav() {
  isMobileNavActive.value = false;
}

function onScroll() {
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
      mobileNavLinks.forEach((link) => {
        link.classList.remove("active");
        if (link.getAttribute("href") === `#${id}`) {
          link.classList.add("active");
        }
      });
    }
  });
}

onMounted(() => {
  sections = document.querySelectorAll("section");
  navLinks = document.querySelectorAll("#navmenu a");
  mobileNavLinks = document.querySelectorAll("#mobile-navmenu a");
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

.navmenu ul {
  display: flex;
  gap: 0.5rem;
  list-style: none;
  margin: 0;
  padding: 0;
}

.navmenu ul li a {
  padding: 0.5rem 1rem;
  border-radius: 4px;
}

.navmenu ul li a.active,
.navmenu ul li a:hover {
  background-color: #1bbca1;
  color: #fff;
}

/* Mobile Nav Base: hidden by default */
.navmenu-mobile {
  display: none;
}

/* Mobile Nav Active State */
.navmenu-mobile.navmenu-active {
  display: flex;
  position: absolute;
  top: 60px;
  right: 20px;
  background: #fff;
  width: 200px;
  border-radius: 8px;
  padding: 1rem;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  flex-direction: column;
  z-index: 999;
}

/* Mobile Nav Items */
.navmenu-mobile ul {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  margin: 0;
  padding: 0;
  list-style: none;
}

.router-link-active {
  color: #fff;
  background-color: #1bbca1;
  border-radius: 4px;
}

.router-link-exact-active {
  color: #fff;
  background-color: #1bbca1;
  border-radius: 4px;
}

.navmenu-mobile .router-link-active {
  color: #fff;
  background-color: #1bbca1;
  border-radius: 4px;
}

.navmenu-mobile .router-link-exact-active {
  color: #fff;
  background-color: #1bbca1;
  border-radius: 4px;
}

.navmenu-mobile ul li a {
  display: block;
  width: 100%;
  padding: 0.5rem;
  color: #000;
  border-radius: 4px;
  background-color: transparent;
}

.navmenu-mobile ul li a:hover,
.navmenu-mobile ul li a.active {
  background-color: #1bbca1;
  color: #fff;
}

.mobile-nav-toggle {
  font-size: 1.8rem;
  cursor: pointer;
  z-index: 1000;
}
</style>
