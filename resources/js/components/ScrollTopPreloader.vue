<template>
  <div>
    <div id="preloader" v-if="loading"></div>
    <a
      href="#"
      id="scroll-top"
      class="scroll-top"
      :class="{ show: showScrollTop }"
      @click.prevent="scrollToTop"
    >
      <i class="bi bi-arrow-up-short"></i>
    </a>
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
      setTimeout(() => {
        this.loading = false;
        this.scrollToTop();
      }, 500);
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
  top: 0;
  left: 0;
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
  width: 50px;
  height: 50px;
  border-radius: 50%;
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  transition: opacity 0.3s ease, visibility 0.3s ease;
}

.scroll-top.show {
  opacity: 1;
  visibility: visible;
  pointer-events: auto;
}
</style>
