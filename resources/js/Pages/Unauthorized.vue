<script setup>
import { Link, usePage, Head } from '@inertiajs/vue3'
const page = usePage()
const error = page.props.flash.error || ''
</script>

<template>
  <Head title="Akses Ditolak" />
  <div class="unauth-wrapper">
    <div class="unauth-card">
      <h1 class="unauth-title">Akses Ditolak</h1>
      <p class="unauth-desc text-danger">
        {{ error ? error : 'Kamu tidak punya akses ke halaman ini.' }}
      </p>
      <Link href="/" class="unauth-btn">Kembali ke Beranda</Link>
    </div>
  </div>
</template>

<style scoped>
.unauth-wrapper {
  min-height: 85vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f5f7fa;
}

.unauth-card {
  padding: 2.5rem 2.1rem 2.1rem 2.1rem;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 32px rgba(30, 32, 37, 0.10);
  text-align: center;
  max-width: 350px;
  margin: auto;
  border: 1px solid #e6e8ec;
}

.unauth-title {
  font-size: 2.2rem;
  font-weight: 700;
  color: #eb5757;
  margin-bottom: 0.9rem;
  letter-spacing: -1px;
}

.unauth-desc {
  font-size: 1.12rem;
  color: #444;
  margin-bottom: 2.2rem;
}

.unauth-btn {
  display: inline-block;
  background: #1bbca1;
  color: #fff;
  font-weight: 600;
  border-radius: 8px;
  padding: 0.6rem 1.5rem;
  transition: background 0.18s;
  text-decoration: none;
  font-size: 1.05rem;
}

.unauth-btn:hover {
  background: #189e8d;
  color: #fff;
}
</style>
