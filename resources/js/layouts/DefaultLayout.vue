<script>
import HeaderDefault from "../components/HeaderDefault.vue";
import ScrollTopPreloader from "../components/ScrollTopPreloader.vue";

export default {
    components: {
        HeaderDefault,
        ScrollTopPreloader,
    },
};
</script>

<style scoped>
main {
    padding-top: 70px;
}
</style>

<template>
    <div>
        <HeaderDefault />
        <main>
            <slot />
        </main>
    </div>
    <ScrollTopPreloader />
</template>
