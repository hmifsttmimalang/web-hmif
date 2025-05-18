<template>
  <footer id="footer" class="footer dark-background">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="/" class="logo d-flex align-items-center">
            <span class="sitename">HMIF SMI MALANG</span>
          </a>
          <p>
            Sebuah organisasi yang mewadahi dan beranggotakan mahasiswa/i
            Informatika ataupun jurusan lain dari prodi di SMI Malang yang
            didirikan pada 13 Oktober 2013.
          </p>
          <div class="social-links d-flex mt-4">
            <a href="https://x.com/hmifsttmalang?t=HZ0ZHEsK1a1QEHm64umkKw&s=09"
              ><i class="bi bi-twitter-x"></i
            ></a>
            <a
              href="https://www.facebook.com/groups/hmifsttmalang/?ref=share&mibextid=NSMWBT"
              ><i class="bi bi-facebook"></i
            ></a>
            <a
              href="https://www.instagram.com/hmifsttmlg?igsh=MWZ2OXJ4NHh3cjlkZA=="
              ><i class="bi bi-instagram"></i
            ></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Navigasi</h4>
          <ul>
            <li>
              <a href="#hero" class="active" @click.prevent="scrollTo('hero')"
                >Beranda</a
              >
            </li>
            <li>
              <a href="#about" @click.prevent="scrollTo('about')"
                >Tentang Kami</a
              >
            </li>
            <li>
              <a href="#services" @click.prevent="scrollTo('services')"
                >Program Kerja</a
              >
            </li>
            <li>
              <a href="#portfolio" @click.prevent="scrollTo('portfolio')"
                >Portfolio</a
              >
            </li>
            <li><a href="#team" @click.prevent="scrollTo('team')">Tim</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Terkini</h4>
          <ul>
            <li><a href="#">Seputar HMIF</a></li>
            <li><a href="#">Projek HMIF</a></li>
            <li><a href="#">Q&A HMIF</a></li>
            <li><a href="#">Arsip HMIF</a></li>
            <li><a href="#">Kontak HMIF</a></li>
          </ul>
        </div>

        <div
          class="col-lg-3 col-md-12 footer-contact text-center text-md-start"
        >
          <h4>Kontak Kami</h4>
          <p>Jl. Candi Panggung Bar. No.48</p>
          <p>Mojolangu, Kec. Lowokwaru</p>
          <p>Kota Malang, Jawa Timur 65142</p>
          <p class="mt-4">
            <strong>Phone:</strong> <span>+62 895 3665 67208</span>
          </p>
          <p><strong>Email:</strong> <span>hmifsttmimalang@gmail.com</span></p>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>
        2024 &copy; <span>Copyright</span>
        <strong class="px-1 sitename">HMIF SMI MALANG</strong>
      </p>
      <div class="credits">
        Designed by
        <a href="https://www.instagram.com/hmifsttmlg?igsh=MWZ2OXJ4NHh3cjlkZA=="
          >HMIF SMI Malang</a
        >
      </div>
    </div>
  </footer>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";

function scrollTo(id) {
  const el = document.getElementById(id);
  if (el) {
    el.scrollIntoView({ behavior: "smooth" });
  }
}

let sections;
let navLinks;
let mobileNavLinks;

function onScroll() {
  const scrollPos = window.scrollY + 200;
  sections.forEach((section) => {
    const top = section.offsetTop;
    const height = section.offsetHeight;
    const id = section.getAttribute("id");

    if (scrollPos >= top && scrollPos <= top + height) {
      navLinks.forEach((link) => link.classList.remove("active"));
      mobileNavLinks.forEach((link) => link.classList.remove("active"));

      const navLink = document.querySelector(`#navmenu a[href="#${id}"]`);
      const mobileNavLink = document.querySelector(
        `#mobile-navmenu a[href="#${id}"]`
      );

      if (navLink) navLink.classList.add("active");
      if (mobileNavLink) mobileNavLink.classList.add("active");
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
.footer {
  color: #fff;
  padding: 60px 0;
}
.footer a {
  text-decoration: none;
}
.footer a:hover {
  text-decoration: underline;
}
.footer .logo {
  font-size: 24px;
  font-weight: bold;
}
.footer .logo img {
  max-height: 40px;
}
.footer .social-links a {
  margin: 0 10px;
  color: #fff;
}
</style>
