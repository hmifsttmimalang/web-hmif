<template>
    <DashAdminLayout>
        <router-view />
        <KelolaDataContent />
    </DashAdminLayout>
</template>

<script setup>
import DashAdminLayout from '@/layouts/DashAdminLayout.vue';
import KelolaDataContent from '@/components/admin/kelola-data/KelolaDataContent.vue';
</script>