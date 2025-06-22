<template>
  <header id="header" class="header d-flex align-items-center fixed-top bg-white shadow-sm">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between position-relative">
      <!-- Logo -->
      <a href="/" class="logo d-flex align-items-center">
        <img :src="logo" alt="Logo HMIF STT MALANG" />
        <span class="fw-bold text-dark ms-2">HMIF SMI MALANG</span>
      </a>

      <!-- Desktop Nav -->
      <nav id="navmenu" class="navmenu d-none d-xl-flex">
        <ul>
          <li><a href="#hero" class="active" @click.prevent="scrollTo('hero')">Beranda</a></li>
          <li><a href="#about" @click.prevent="scrollTo('about')">Tentang Kami</a></li>
          <li><a href="#services" @click.prevent="scrollTo('services')">Program Kerja</a></li>
          <li><a href="#portfolio" @click.prevent="scrollTo('portfolio')">Portfolio</a></li>
          <li><Link href="/posts">Blog</Link></li>
          <li v-if="!currentUser">
            <Link href="/login">Login</Link>
          </li>
          <li
            v-else
            class="dropdown user-dropdown-desktop"
            :class="{ show: desktopDropdownOpen }"
          >
            <a href="#" class="dropdown-toggle" @click="toggleDropdown(false, $event)" :aria-expanded="desktopDropdownOpen" role="button">
              {{ currentUser.name || currentUser.nama }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" :class="{ show: desktopDropdownOpen }">
              <li><Link href="/dashboard">Dashboard</Link></li>
              <li><a href="/logout" @click.prevent="logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </nav>

      <!-- Mobile Nav -->
      <nav id="mobile-navmenu" class="navmenu-mobile d-xl-none" :class="{ 'navmenu-active': isMobileNavActive }">
        <ul>
          <li>
            <a href="#hero" class="active" @click.prevent="scrollTo('hero')" @click="closeMobileNav">Beranda</a>
          </li>
          <li><a href="#about" @click.prevent="scrollTo('about')" @click="closeMobileNav">Tentang Kami</a></li>
          <li><a href="#services" @click.prevent="scrollTo('services')" @click="closeMobileNav">Program Kerja</a></li>
          <li><a href="#portfolio" @click.prevent="scrollTo('portfolio')" @click="closeMobileNav">Portfolio</a></li>
          <li><a href="#team" @click.prevent="scrollTo('team')" @click="closeMobileNav">Tim</a></li>
          <li><Link href="/posts">Blog</Link></li>
          <li v-if="!currentUser"><Link href="/login">Login</Link></li>
          <li
            v-else
            class="dropdown user-dropdown-mobile"
            :class="{ show: mobileDropdownOpen }"
          >
            <a href="#" class="dropdown-toggle" @click="toggleDropdown(true, $event)" :aria-expanded="mobileDropdownOpen" role="button">
              {{ currentUser.name || currentUser.nama }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" :class="{ show: mobileDropdownOpen }">
              <li><Link href="/dashboard" @click="closeMobileNav">Dashboard</Link></li>
              <li><a href="/logout" @click.prevent="logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </nav>

      <!-- Mobile Nav Toggle Button -->
      <i class="mobile-nav-toggle d-xl-none bi" :class="isMobileNavActive ? 'bi-x' : 'bi-list'" @click="toggleMobileNav"></i>
    </div>
  </header>
</template>

<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { ref, computed, onMounted, onBeforeUnmount } from "vue";
import logo from '@/assets/img/logo_hmif.jpg';

const page = usePage();
const currentUser = computed(() => page.props.currentUser);

const isMobileNavActive = ref(false);
const desktopDropdownOpen = ref(false);
const mobileDropdownOpen = ref(false);

// Logic SPA untuk dropdown
function toggleDropdown(isMobile = false, event) {
  if (event) event.preventDefault();
  if (isMobile) {
    mobileDropdownOpen.value = !mobileDropdownOpen.value;
  } else {
    desktopDropdownOpen.value = !desktopDropdownOpen.value;
  }
}
function closeDropdown() {
  desktopDropdownOpen.value = false;
  mobileDropdownOpen.value = false;
}

function handleClickOutside(event) {
  const desktopDropdown = document.querySelector('.user-dropdown-desktop');
  const mobileDropdown = document.querySelector('.user-dropdown-mobile');
  if (desktopDropdown && !desktopDropdown.contains(event.target)) {
    desktopDropdownOpen.value = false;
  }
  if (mobileDropdown && !mobileDropdown.contains(event.target)) {
    mobileDropdownOpen.value = false;
  }
}

onMounted(() => {
  window.addEventListener('click', handleClickOutside);

  // Scroll logic tetap
  sections = document.querySelectorAll("section");
  navLinks = document.querySelectorAll("#navmenu a");
  mobileNavLinks = document.querySelectorAll("#mobile-navmenu a");
  window.addEventListener("scroll", onScroll);
  onScroll();
});
onBeforeUnmount(() => {
  window.removeEventListener('click', handleClickOutside);
  window.removeEventListener("scroll", onScroll);
});

function toggleMobileNav() {
  isMobileNavActive.value = !isMobileNavActive.value;
  closeDropdown();
}
function closeMobileNav() {
  isMobileNavActive.value = false;
  closeDropdown();
}

function logout() {
  router.post('/logout');
}

// Section scroll logic tetap
let sections, navLinks, mobileNavLinks;
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
function scrollTo(id) {
  const el = document.getElementById(id);
  if (el) {
    el.scrollIntoView({ behavior: 'smooth' });
  }
}
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

.dropdown .dropdown-menu { display: none; }
.dropdown.show .dropdown-menu { display: block; }
</style>
