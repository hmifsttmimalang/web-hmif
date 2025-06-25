<script setup>
import { Head } from '@inertiajs/vue3';
import DashAdminLayout from '@/layouts/DashAdminLayout.vue';
import DashAdminContent from '@/components/admin/DashAdminContent.vue';
</script>
<template>
    <Head title="Dashboard Admin" />
    <DashAdminLayout>
        <DashAdminContent />
    </DashAdminLayout>
</template>
