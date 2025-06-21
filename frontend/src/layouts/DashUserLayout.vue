<template>
    <div>
        <DashUserHeader />
        <DashUserSidebar />
        <main id="main" class="main">
            <slot />
        </main>
    </div>
</template>

<script>
import DashUserHeader from '../components/dashboards/DashUserHeader.vue';
import DashUserSidebar from '../components/dashboards/DashUserSidebar.vue';

export default {
    components: {
        DashUserHeader,
        DashUserSidebar
    }
};
</script>