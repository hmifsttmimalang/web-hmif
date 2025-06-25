<script>
import { Head } from "@inertiajs/vue3";
import DefaultLayout from "../layouts/DefaultLayout.vue";

export default {
  name: "BlogPost",
  components: {
    Head,
    DefaultLayout,
  },
}
</script>

<template>
  <Head title="Blog Post - HMIF SMI Malang" />
  <DefaultLayout>
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-8">
          <article class="blog-post">
            <h1 class="blog-post-title mb-3">Judul Artikel</h1>
            <p class="blog-post-meta">
              Ditulis oleh <a href="#">Penulis</a> pada <span>16 Mei 2025</span>
            </p>
            <img src="https://dummyimage.com/800x400/000/fff" class="img-fluid rounded mb-4" alt="Gambar Artikel" />
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus
              lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod
              malesuada. Sed auctor, nisl a venenatis pharetra, sapien justo
              tempor quam, ac feugiat quam sapien eu arcu.
            </p>
            <p>
              Pellentesque habitant morbi tristique senectus et netus et
              malesuada fames ac turpis egestas. Aenean euismod, urna eget
              convallis molestie, risus turpis suscipit justo, ut imperdiet nisi
              lorem accumsan odio.
            </p>
          </article>
        </div>
        <div class="col-lg-4">
          <div class="p-4 mb-3 bg-light rounded">
            <h4 class="fst-italic">Tentang Penulis</h4>
            <p class="mb-0">
              Ini adalah deskripsi singkat tentang penulis. Kamu bisa
              menambahkan informasi lebih lanjut di sini.
            </p>
          </div>
          <div class="p-4">
            <h4 class="fst-italic">Artikel Terkait</h4>
            <ul class="list-unstyled mb-0">
              <li><a href="#">Judul Artikel 1</a></li>
              <li><a href="#">Judul Artikel 2</a></li>
              <li><a href="#">Judul Artikel 3</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </DefaultLayout>
</template>
