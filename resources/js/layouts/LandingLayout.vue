<template>
  <div>
    <HeaderLanding />
    <main>
      <slot />
    </main>
  </div>
  <ScrollTopPreloader />
</template>

<script>
import HeaderLanding from "../components/HeaderLanding.vue";
import ScrollTopPreloader from "../components/ScrollTopPreloader.vue";

export default {
  components: { 
    HeaderLanding, 
    ScrollTopPreloader
  },
};
</script>

<style scoped>
  main {
    padding-top: 70px;
  }
</style>
