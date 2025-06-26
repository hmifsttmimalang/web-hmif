<script setup>
import { Head } from "@inertiajs/vue3";
import DashAdminLayout from '@/layouts/DashAdminLayout.vue';
import PeriodePendaftaranContent from "@/components/admin/periode-pendaftaran/PeriodePendaftaranContent.vue";
</script>

<template>
    <Head title="Kelola Waktu Pendaftaran" />
    <DashAdminLayout>
        <PeriodePendaftaranContent />
    </DashAdminLayout>
</template>
