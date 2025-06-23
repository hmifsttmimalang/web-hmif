<template>
<Head title="Detail Anggota" />
    <DashAdminLayout>
        <DetailAnggotaContent />
    </DashAdminLayout>
    <ScrollTopPreloader />
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import DashAdminLayout from '@/layouts/DashAdminLayout.vue';
import DetailAnggotaContent from '@/components/admin/anggota/DetailAnggotaContent.vue';
import ScrollTopPreloader from '@/components/ScrollTopPreloader.vue';
</script>