# 🌐 HMIF SMI Malang – Website Fullstack

Ini proyek **Website Resmi HMIF SMI Malang**.  
Sekarang bukan cuma landing page:  
Sudah **Laravel 12 (API & Backend) + Vue 3 + Inertia.js (SPA) + Bootstrap 5**  
Ada fitur **auth (login/register), manajemen anggota, dashboard**, dsb.

---

## 🚀 Stack & Teknologi

- [Laravel 12](https://laravel.com/) — Backend, API, Auth, DB, Routing
- [Inertia.js](https://inertiajs.com/) — “Jembatan” antara Laravel & Vue (SPA tanpa API manual)
- [Vue 3](https://vuejs.org/) — Frontend, Component, Routing
- [Bootstrap 5](https://getbootstrap.com/) — UI, responsive, cepat
- [Vite](https://vitejs.dev/) — Dev server & build tool
- [Ziggy](https://github.com/tighten/ziggy) — Biar named route Laravel bisa dipanggil di frontend

---

## 📁 Struktur Proyek

```bash
├── public/
│   └── assets/
│       └── img/
├── resources/
│   ├── js/
│   │   ├── Pages/
│   │   │   ├── Home.vue
│   │   │   ├── Auth/
│   │   │   │   ├── Login.vue
│   │   │   │   └── Register.vue
│   │   │   ├── Admin/
│   │   │   │   └── KelolaData.vue
│   │   ├── components/
│   │   ├── layouts/
│   │   └── app.js
│   └── views/
│       └── app.blade.php
├── routes/
│   ├── web.php
│   └── auth.php
├── vite.config.js
├── package.json
└── README.md
```

## 🧹 Fitur Utama

- Autentikasi Login/Register (Laravel Breeze, Inertia, Bootstrap style)
- Dashboard admin/user (role-based access: superadmin, admin, user)
- Manajemen data anggota: tambah, update, hapus, import, export
- Sidebar & Navbar aktif otomatis
- SPA feel (semua page pindah tanpa reload)
- Validasi server-side (semua error tampil di frontend)
- File upload (foto user/anggota)
- Notifikasi sukses/gagal otomatis

## 🔧 Cara Menjalankan (Dev Mode)

```markdown
1. Clone repo ini:

    ```bash
    git clone https://github.com/hmifsttmimalang/web-hmif.git
    cd web-hmif
    ```

2. Install backend (Laravel):

    ```bash
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    ```

3. Install frontend (npm):
    ```bash
    npm install
    ```

4. Jalankan dua server (di 2 terminal berbeda):
    ```bash
    php artisan serve
    npm run dev
    ```

5. Akses di browser

http://localhost:8000/

```

---

## 🧑‍💻 Kontributor

- [Ardiansyah](https://github.com/ardie069)
- [Adi Chandra Isro'Salsabilla](https://github.com/bangarchad)

---

## 📄 Lisensi

Proyek ini menggunakan lisensi [Apache-2.0](LICENSE) — bebas pakai, asal ngasih kredit.

---

### 📝 Catatan Migrasi dari Versi Lama

> [!NOTE]
> Dulu: Full Vue 3 + Bootstrap (static landing page, tanpa backend)
>
> Sekarang: Laravel (backend/auth/role) + Vue + Inertia (SPA/komponen dinamis)
>
> Semua logic auth, akses, validasi — sekarang handle di backend, error langsung muncul di frontend
>
> Frontend gak pakai vue-router manual: Semua routing lewat Inertia + route Laravel

## ❓ FAQ Singkat

> [!TIP]
> Gak nemu menu/fitur tertentu?
>
> Cek role user kamu, beberapa fitur cuma buat admin/superadmin.
>
> Error login/register?
>
> Cek field di form, cek juga DB migration sudah update.
>
> Mau ganti tampilan/fitur?
>
> Tinggal edit di resources/js/Pages/ atau backend controller Laravel.
