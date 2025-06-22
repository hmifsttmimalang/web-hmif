<template>
<Head title="Anggota" />
    <DashAdminLayout>
        <AnggotaContent />
    </DashAdminLayout>
    <ScrollTopPreloader />
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import DashAdminLayout from '@/layouts/DashAdminLayout.vue';
import AnggotaContent from '@/components/admin/anggota/AnggotaContent.vue';
import ScrollTopPreloader from '@/components/ScrollTopPreloader.vue';
</script>