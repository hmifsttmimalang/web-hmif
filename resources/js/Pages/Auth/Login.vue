<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted, onUnmounted, ref } from "vue";
import { route } from "ziggy-js";

onMounted(() => {
  const loginStylesheet = document.createElement("link");
  loginStylesheet.rel = "stylesheet";
  loginStylesheet.href = "/assets/css/sb-admin-2.css";
  document.head.appendChild(loginStylesheet);
});
onUnmounted(() => {
  const loginStylesheet = document.querySelector(
    'link[href="/assets/css/sb-admin-2.css"]'
  );
  if (loginStylesheet) document.head.removeChild(loginStylesheet);
});

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  login: "",
  password: "",
  remember: false,
});

const showPassword = ref(false);
const togglePasswordVisibility = () => {
  showPassword.value = !showPassword.value;
};

function submit() {
  form.post(route("login"), {
    onFinish: () => {
      form.reset("password");
      window.location.reload();
    }
  });
}
</script>

<template>

  <Head title="Login - HMIF SMI Malang" />
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <Link href="/" class="logo d-flex align-items-center w-auto">
                <img src="/assets/img/logo_hmif.jpg" alt="Logo HMIF" width="50" />
                <span class="d-none d-lg-block">HMIF SMI MALANG</span>
                </Link>
              </div>

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">
                      Masuk Ke Akun Kamu
                    </h5>
                    <p class="text-center small">
                      Masukkan email atau username &
                      password untuk login
                    </p>
                  </div>

                  <form @submit.prevent="submit">
                    <div class="col-12">
                      <label for="login" class="form-label">Email atau Username</label>
                      <div class="input-group has-validation">
                        <input type="text" v-model="form.login" class="form-control" id="login" placeholder="Masukkan username atau email" required :class="{
                          'is-invalid':
                            form.errors.login,
                        }" />
                        <div class="invalid-feedback" v-if="form.errors.login">
                          {{ form.errors.login }}
                        </div>
                      </div>
                    </div>

                    <div class="col-12 mt-3 mb-4">
                      <label for="password" class="form-label">Password</label>
                      <div class="position-relative">
                        <input :type="showPassword ? 'text' : 'password'" v-model="form.password"
                          class="form-control pe-5" id="password" placeholder="Masukkan password" required
                          :class="{ 'is-invalid': form.errors.password }" />
                        <span class="position-absolute end-0 top-0 mt-2 me-3" @click="togglePasswordVisibility"
                          style="cursor: pointer; z-index: 2">
                          <i :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                        </span>
                        <div class="invalid-feedback" v-if="form.errors.password">
                          {{ form.errors.password }}
                        </div>
                      </div>
                    </div>

                    <div class="col-12 mb-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" v-model="form.remember" id="rememberMe" />
                        <label class="form-check-label" for="rememberMe">Saya ingat</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" :disabled="form.processing">
                        Login
                      </button>
                    </div>
                    <div class="col-12 mt-2">
                      <p class="small mb-0">
                        Belum punya akun?
                        <Link :href="route('register')">Buat akun</Link>
                      </p>
                    </div>
                  </form>
                  <div v-if="form.errors.general" class="alert alert-danger mt-2">
                    {{ form.errors.general }}
                  </div>
                  <div v-if="status" class="alert alert-success mt-2">
                    {{ status }}
                  </div>
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
