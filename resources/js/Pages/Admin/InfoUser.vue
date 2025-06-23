<template>
<Head title="Info User" />
    <DashAdminLayout>
        <InfoUserContent />
    </DashAdminLayout>
    <ScrollTopPreloader />
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import DashAdminLayout from '@/layouts/DashAdminLayout.vue';
import InfoUserContent from '@/components/admin/info-user/InfoUserContent.vue';
import ScrollTopPreloader from '@/components/ScrollTopPreloader.vue';
</script>