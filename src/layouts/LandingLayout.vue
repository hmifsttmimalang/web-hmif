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
