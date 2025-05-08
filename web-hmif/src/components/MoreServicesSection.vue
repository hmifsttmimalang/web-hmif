<template>
  <section id="services" class="more-services section">
    <div class="container">
      <div class="row gy-4">
        <div
          class="col-lg-6"
          v-for="(item, index) in moreServices"
          :key="index"
          :data-aos="'fade-up'"
          :data-aos-delay="100 * (index + 1)"
        >
          <div class="card">
            <img :src="item.image" class="img-fluid" :alt="item.title" />
            <h3 v-html="item.title"></h3>
            <p style="text-align: justify">{{ item.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from "vue";

const moreServices = ref([
  {
    image: new URL("@/assets/img/kegiatan/Futsal (1).jpg", import.meta.url)
      .href,
    title: "HMIF X FORMASI",
    description:
      "Himpunan Mahasiswa Informatika SMI Malang sukses menyelenggarakan acara HMIF SPORT X FORMASI dengan olahraga Futsal pada tanggal 16 Juni 2024. Kegiatan ini bertujuan untuk mempererat hubungan antaranggota dan Himpunan Lain sekaligus menjaga kesehatan fisik melalui olahraga futsal yang kompetitif dan penuh semangat.",
  },
  {
    image: new URL("@/assets/img/kegiatan/IMG_1018.JPG", import.meta.url).href,
    title: "Serah Terima Pergantian <br>Ketua Himpunan",
    description:
      "Pada hari 18 Mei 2024, Himpunan Mahasiswa Informatika SMI Malang (HMIF) sukses menggelar acara Serah Terima Jabatan [Sertijab] Ketua Himpunan yang bertempat di Sekolah Multimedia Internasional Malang. Acara ini menandai berakhirnya masa kepemimpinan Anggi Maretha dan dimulainya masa bakti kepemimpinan baru oleh Aventus Akong untuk periode Tahun 2024 - 2025.",
  },
]);
</script>

<style scoped>
.more-services {
  padding: 60px 0;
}

.more-services .card {
  background-color: #f8f9fa;
  border-radius: 10px;
  padding: 20px;
  text-align: center;
  transition: transform 0.3s ease;
}

.more-services .card:hover {
  transform: scale(1.05);
}

.more-services img {
  max-width: 100%;
  border-radius: 10px;
  margin-bottom: 15px;
}

.more-services h3 {
  font-size: 24px;
  margin-bottom: 15px;
}
</style>
