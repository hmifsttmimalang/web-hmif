<script setup>
import { Head } from "@inertiajs/vue3";
import DashAdminLayout from '@/layouts/DashAdminLayout.vue';
import KelolaDataContent from '@/components/admin/kelola-data/KelolaDataContent.vue';
</script>

<template>
    <Head title="Kelola Data" />
    <DashAdminLayout>
        <KelolaDataContent />
    </DashAdminLayout>
</template>
