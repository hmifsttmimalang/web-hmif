<template>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <router-link to="/" class="logo d-flex align-items-center w-auto">
                  <img src="@/assets/img/logo_hmif.jpg" alt="Logo HMIF" width="50">
                  <span class="d-none d-lg-block">HMIF SMI MALANG</span>
                </router-link>
              </div>

              <div class="card mb-3">
                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Masuk Ke Akun Kamu</h5>
                    <p class="text-center small">Masukkan email & password untuk login</p>
                  </div>

                  <form @submit.prevent="login">
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="text" v-model="form.email" class="form-control" id="email" required>
                        <div class="invalid-feedback">Harap masukkan email.</div>
                      </div>
                    </div>

                    <div class="col-12 mt-3 mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" v-model="form.password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Harap masukkan password!</div>
                    </div>

                    <div class="col-12 mb-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" v-model="form.remember" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Saya ingat</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12 mt-2">
                      <p class="small mb-0">Belum punya akun? <router-link to="/register">Buat akun</router-link></p>
                    </div>
                  </form>
                  <div v-if="error" class="alert alert-danger mt-2">{{ error }}</div>
                </div>
              </div>

              <div class="credits">
                Designed by <a href="/">HMIF SMI MALANG</a>
              </div>

            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
</template>

<script setup>
import { ref, reactive } from "vue";

const form = reactive({
  email: "",
  password: "",
  remember: false
});
const error = ref("");

async function login() {
  error.value = "";
  try {
    await fetch("/sanctum/csrf-cookie", { credentials: "include" });

    const res = await fetch("/login", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      credentials: "include",
      body: JSON.stringify({
        email: form.email,
        password: form.password,
        remember: form.remember
      })
    });
    const data = await res.json();
    if (!res.ok) {
      throw new Error(data.message || "Login gagal.");
    }
    window.location.href = "/dashboard";
  } catch (e) {
    error.value = e.message;
  }
}
</script>
