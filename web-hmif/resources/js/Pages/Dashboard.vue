<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import DashUserLayout from '@/layouts/DashUserLayout.vue'
import DashUserContent from '@/components/user/DashUserContent.vue'
import { ZiggyVue } from 'ziggy-js'

</script>

<template>
    <Head title="Dashboard User" />
    <DashUserLayout>
        <DashUserContent />
    </DashUserLayout>
</template>
