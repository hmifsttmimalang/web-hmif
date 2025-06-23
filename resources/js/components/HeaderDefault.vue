<template>
  <header id="header" class="header d-flex align-items-center fixed-top bg-white shadow-sm">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between position-relative">
      <!-- Logo -->
      <Link href="/" class="logo d-flex align-items-center">
        <img :src="logoUrl" alt="Logo HMIF STT MALANG" />
        <span class="fw-bold text-dark ms-2">HMIF SMI MALANG</span>
      </Link>

      <!-- Desktop Nav -->
      <nav id="navmenu" class="navmenu d-none d-xl-flex">
        <ul>
          <li><Link href="/" :class="{ active: isActive('/') }">Beranda</Link></li>
          <li><Link href="/posts" :class="{ active: isActive('/posts') }">Blog</Link></li>
          <li v-if="!currentUser">
            <Link href="/login" :class="{ active: isActive('/login') }">Login</Link>
          </li>
          <li v-else class="dropdown user-dropdown-desktop" :class="{ show: desktopDropdownOpen }">
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
            <Link href="/" :class="{ active: isActive('/') }" @click="closeMobileNav">Beranda</Link>
          </li>
          <li>
            <Link href="/posts" :class="{ active: isActive('/posts') }" @click="closeMobileNav">Blog</Link>
          </li>
          <li v-if="!currentUser">
            <Link href="/login" :class="{ active: isActive('/login') }" @click="closeMobileNav">Login</Link>
          </li>
          <li v-else class="dropdown user-dropdown-mobile" :class="{ show: mobileDropdownOpen }">
            <a href="#" class="dropdown-toggle" @click="toggleDropdown(true, $event)" :aria-expanded="mobileDropdownOpen" role="button">
              {{ currentUser.nama }} <span class="caret"></span>
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
import { ref, computed, onMounted, onBeforeUnmount } from "vue";
import { Link, usePage, router } from "@inertiajs/vue3";

const logoUrl = `${import.meta.env.BASE_URL}assets/img/logo_hmif.jpg`;

const isMobileNavActive = ref(false);
const page = usePage();
const currentUser = computed(() => page.props.currentUser);

// Pakai 2 dropdownOpen: satu buat desktop, satu buat mobile
const desktopDropdownOpen = ref(false);
const mobileDropdownOpen = ref(false);

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
});
onBeforeUnmount(() => {
  window.removeEventListener('click', handleClickOutside);
});

function toggleMobileNav() {
  isMobileNavActive.value = !isMobileNavActive.value;
  closeDropdown();
}
function closeMobileNav() {
  isMobileNavActive.value = false;
  closeDropdown();
}

function isActive(path) {
  return page.url === path;
}

function logout() {
  router.post("/logout");
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

.navmenu-mobile {
  display: none;
}

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

.dropdown .dropdown-menu {
  display: none;
}
.dropdown.show .dropdown-menu {
  display: block;
}
</style>
