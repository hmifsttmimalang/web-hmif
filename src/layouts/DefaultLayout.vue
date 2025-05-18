<template>
  <div>
    <HeaderDefault />
    <main>
      <slot />
    </main>
  </div>
</template>

<script>
import HeaderDefault from "../components/HeaderDefault.vue";

export default {
  components: { HeaderDefault },
};
</script>

<style scoped>
main {
  padding-top: 70px;
}
</style>
