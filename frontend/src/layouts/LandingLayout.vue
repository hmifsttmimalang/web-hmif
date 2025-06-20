<template>
  <div>
    <HeaderLanding />
    <main>
      <slot />
    </main>
  </div>
</template>

<script>
import HeaderLanding from "../components/HeaderLanding.vue";

export default {
  components: { HeaderLanding },
};
</script>

<style scoped>
  main {
    padding-top: 70px;
  }
</style>
