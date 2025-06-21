<template>
    <DashAdminLayout>
        <router-view />
        <DashAdminContent />
    </DashAdminLayout>
</template>

<script setup>
import DashAdminLayout from '../../layouts/DashAdminLayout.vue';
import DashAdminContent from '../../components/admin/DashAdminContent.vue';
</script>