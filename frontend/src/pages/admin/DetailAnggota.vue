<template>
    <router-view />
    <DashAdminLayout>
        <DetailAnggotaContent />
    </DashAdminLayout>
</template>

<script setup>
import DashAdminLayout from '@/layouts/DashAdminLayout.vue';
import DetailAnggotaContent from '@/components/admin/anggota/DetailAnggotaContent.vue';
</script>