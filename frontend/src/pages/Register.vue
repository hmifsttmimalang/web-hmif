<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-md-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Registrasi Anggota Baru HMIF!</h1>
                  </div>
                  <form @submit.prevent="submitForm" ref="formRef" novalidate>
                    <!-- Nama -->
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" v-model="form.nama" class="form-control" id="nama" required placeholder="Masukkan Nama Lengkap Anda..." />
                    </div>
                    <!-- Tempat & Tanggal Lahir -->
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" v-model="form.tempat_lahir" class="form-control" id="tempat_lahir" required placeholder="Tempat Lahir Anda..." />
                      </div>
                      <div class="col-md-6">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" v-model="form.tanggal_lahir" class="form-control" id="tanggal_lahir" required />
                      </div>
                    </div>
                    <!-- Jenis Kelamin & Agama -->
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label>Jenis Kelamin</label>
                        <div class="form-check">
                          <input type="radio" v-model="form.jenis_kelamin" value="L" class="form-check-input" id="laki" required />
                          <label for="laki" class="form-check-label">Laki-Laki</label>
                        </div>
                        <div class="form-check">
                          <input type="radio" v-model="form.jenis_kelamin" value="P" class="form-check-input" id="perempuan" required />
                          <label for="perempuan" class="form-check-label">Perempuan</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="agama">Agama</label>
                        <select v-model="form.agama" id="agama" class="form-control" required>
                          <option value="">Pilih Agama</option>
                          <option value="islam">Islam</option>
                          <option value="kristen">Kristen</option>
                          <option value="katholik">Katolik</option>
                          <option value="hindu">Hindu</option>
                          <option value="budha">Budha</option>
                          <option value="konghucu">Konghucu</option>
                        </select>
                      </div>
                    </div>
                    <!-- Alamat -->
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <textarea v-model="form.alamat" id="alamat" class="form-control" required></textarea>
                    </div>
                    <!-- NIM -->
                    <div class="form-group">
                      <label for="nim">NIM</label>
                      <input type="number" v-model="form.nim" class="form-control" id="nim" required placeholder="Masukkan NIM Lengkap Anda..." />
                    </div>
                    <!-- Prodi -->
                    <div class="form-group">
                      <label for="prodi">Asal Prodi</label>
                      <select v-model="form.prodi" id="prodi" class="form-control" required>
                        <option value="" disabled selected hidden>Pilih Prodi</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                        <option value="Digital Arsitektur">Digital Arsitektur</option>
                        <option value="Manajemen Bisnis">Manajemen Bisnis</option>
                        <option value="Manajemen Keuangan">Manajemen Keuangan</option>
                        <option value="Manajemen Perkantoran">Manajemen Perkantoran</option>
                        <option value="Manajemen Komunikasi">Manajemen Komunikasi</option>
                        <option value="Multimedia Broadcasting">Multimedia Broadcasting</option>
                        <option value="Desain Grafis">Desain Grafis</option>
                      </select>
                    </div>
                    <!-- Foto & Angkatan -->
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="foto">Foto PAS (3x4)</label>
                        <input id="foto" style="padding:3px" type="file" @change="onFileChange" class="form-control" required />
                      </div>
                      <div class="col-md-6">
                        <label for="angkatan">Angkatan</label>
                        <input style="padding:3px" type="text" v-model="form.angkatan" class="form-control" id="angkatan" placeholder="Tahun Bergabung..." required />
                      </div>
                    </div>
                    <!-- Alasan -->
                    <div class="form-group">
                      <label for="alasan">Alasan Ingin Bergabung</label>
                      <textarea v-model="form.alasan" id="alasan" class="form-control" required></textarea>
                    </div>
                    <!-- Email & Telepon -->
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="email" v-model="form.email" class="form-control" id="email" required placeholder="Email Aktif Anda..." autocomplete="additional-name" />
                      </div>
                      <div class="col-md-6">
                        <label for="telepon">Telepon</label>
                        <input type="text" v-model="form.telepon" class="form-control" id="telepon" required placeholder="No Telepon Anda..." />
                      </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="password">Password</label>
                        <input type="password" v-model="form.password" class="form-control" id="password" required placeholder="Masukkan Password Anda..." />
                      </div>
                      <div class="col-md-6">
                        <label for="ulangi_password">Ulangi Password</label>
                        <input type="password" v-model="form.ulangi_password" class="form-control" id="ulangi_password" required placeholder="Ulangi Password Anda..." />
                      </div>
                    </div>
                    <!-- Syarat & Ketentuan -->
                    <div class="col-md-12">
                      <div class="form-check">
                        <input class="form-check-input" v-model="form.terms" type="checkbox" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">
                          Saya setuju dengan
                          <a href="#" @click.prevent="showModal = true">syarat dan ketentuan</a>
                        </label>
                      </div>
                    </div>

                    <!-- Modal -->
                    <div v-if="showModal" class="modal fade show d-block" tabindex="-1" aria-modal="true" role="dialog" style="background:rgba(0,0,0,.5)">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Syarat dan Ketentuan</h5>
                            <button type="button" class="btn-close" @click="showModal = false"></button>
                          </div>
                          <div class="modal-body">
                            <p>Berikut adalah syarat dan ketentuan yang berlaku:</p>
                            <ul>
                              <li>Pengguna wajib memberikan data yang valid.</li>
                              <li>Data yang dikirimkan tidak akan dibagikan tanpa izin.</li>
                              <li>Pendaftaran bersifat sukarela namun harus sesuai prosedur.</li>
                              <li>Layanan ini dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya.</li>
                            </ul>
                            <p>Dengan mencentang kotak persetujuan, Anda telah membaca dan menerima semua syarat dan ketentuan di atas.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="showModal = false">Tutup</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Registrasi</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <router-link class="small" to="/login">Sudah punya akun? Login!</router-link>
                  </div>
                  <div v-if="error" class="alert alert-danger mt-3">{{ error }}</div>
                  <div v-if="success" class="alert alert-success mt-3">{{ success }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from "vue";
import '../assets/css/sb-admin-2.css';

const form = reactive({
  nama: "",
  tempat_lahir: "",
  tanggal_lahir: "",
  jenis_kelamin: "",
  agama: "",
  alamat: "",
  nim: "",
  prodi: "",
  angkatan: "",
  alasan: "",
  email: "",
  telepon: "",
  password: "",
  ulangi_password: "",
  terms: false,
  foto: null,
});

const showModal = ref(false);
const error = ref("");
const success = ref("");
const formRef = ref(null);

function onFileChange(e) {
  form.foto = e.target.files[0];
}

async function submitForm() {
  error.value = "";
  success.value = "";
  if (form.password !== form.ulangi_password) {
    error.value = "Password dan ulangi password tidak sama.";
    return;
  }
  // Validasi minimal (tambahkan sesuai kebutuhan)
  if (!form.terms) {
    error.value = "Anda harus menyetujui syarat dan ketentuan.";
    return;
  }
  const formData = new FormData();
  Object.keys(form).forEach((key) => {
    if (key === "foto" && form.foto) {
      formData.append(key, form.foto);
    } else {
      formData.append(key, form[key]);
    }
  });

  try {
    await fetch("/sanctum/csrf-cookie", { credentials: "include" });

    const res = await fetch("/api/pendaftaran", {
      method: "POST",
      body: formData,
      credentials: "include",
    });
    const data = await res.json();
    if (!res.ok) {
      throw new Error(data.message || "Registrasi gagal.");
    }
    success.value = "Registrasi berhasil!";
    formRef.value.reset();
  } catch (e) {
    error.value = e.message;
  }
}
</script>

<style scoped>
.bg_register {
  background-color: #f6f9ff;
}
</style>
