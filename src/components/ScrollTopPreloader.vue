<template>
  <div>
    <!-- Scroll Top -->
    <a
      href="#"
      id="scroll-top"
      class="scroll-top d-flex align-items-center justify-content-center"
      v-show="showScrollTop"
      @click.prevent="scrollToTop"
    >
      <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader" v-if="loading"></div>
  </div>
</template>

<script>
export default {
  name: "ScrollTopPreloader",
  data() {
    return {
      showScrollTop: false,
      loading: true,
    };
  },
  watch: {
    $route() {
      this.triggerPreloader();
    },
  },
  mounted() {
    this.triggerPreloader();
    window.addEventListener("scroll", this.handleScroll);
  },
  beforeUnmount() {
    window.removeEventListener("scroll", this.handleScroll);
  },
  methods: {
    triggerPreloader() {
      this.loading = true;
      // Simulasikan delay agar terlihat animasi preloader
      setTimeout(() => {
        this.loading = false;
        this.scrollToTop(); // Scroll ke atas saat pindah halaman
      }, 500); // Ubah sesuai kebutuhan
    },
    scrollToTop() {
      window.scrollTo({ top: 0, behavior: "smooth" });
    },
    handleScroll() {
      this.showScrollTop = window.scrollY > 100;
    },
  },
};
</script>

<style scoped>
#preloader {
  position: fixed;
  width: 100%;
  height: 100%;
  background: white no-repeat center center;
  z-index: 9999;
}

.scroll-top {
  position: fixed;
  right: 15px;
  bottom: 15px;
  background: #0d6efd;
  color: #fff;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  z-index: 999;
  transition: opacity 0.3s;
}
</style>
