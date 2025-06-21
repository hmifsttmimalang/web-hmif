<template>
    <router-view />
    <DashAdminLayout>
        <AnggotaContent />
    </DashAdminLayout>
</template>

<script setup>
import DashAdminLayout from '@/layouts/DashAdminLayout.vue';
import AnggotaContent from '@/components/admin/anggota/AnggotaContent.vue';
</script>