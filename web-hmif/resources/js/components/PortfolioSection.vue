<template>
  <section id="portfolio" class="portfolio section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Portfolio</h2>
      <p>
        Proyek ini merupakan inisiatif dari Himpunan Mahasiswa Informatika SMI
        Malang (HMIF SMI MALANG)
      </p>
    </div>
    <div class="container">
      <div class="isotope-layout" data-layout="masonry">
        <ul
          class="portfolio-filters isotope-filters"
          data-aos="fade-up"
          data-aos-delay="100"
        >
          <li
            v-for="filter in filters"
            :key="filter.value"
            :class="{ 'filter-active': activeFilter === filter.value }"
            @click="changeFilter(filter.value)"
          >
            {{ filter.label }}
          </li>
        </ul>
        <div
          class="row gy-4 isotope-container"
          data-aos="fade-up"
          data-aos-delay="200"
        >
          <div
            v-for="(project, index) in projects"
            :key="index"
            class="col-lg-4 col-md-6 portfolio-item isotope-item"
            :class="project.filterClass"
          >
            <div class="portfolio-content h-100">
              <img :src="project.imgSrc" class="img-fluid" alt="" />
              <div class="portfolio-info">
                <h4>{{ project.title }}</h4>
                <p>{{ project.description }}</p>
                <a
                  :href="project.imgSrc"
                  title="Preview"
                  data-gallery="portfolio-gallery-app"
                  class="glightbox preview-link"
                >
                  <i class="bi bi-zoom-in"></i>
                </a>
                <a
                  href="portfolio-details.html"
                  title="More Details"
                  class="details-link"
                >
                  <i class="bi bi-link-45deg"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import Isotope from "isotope-layout";
import GLightbox from "glightbox";
import "glightbox/dist/css/glightbox.css";

export default {
  name: "PortfolioSection",
  data() {
    return {
      activeFilter: "*",
      iso: null,
      filters: [
        { label: "All", value: "*" },
        { label: "Game", value: "filter-game" },
        { label: "App", value: "filter-app" },
        { label: "Website", value: "filter-branding" },
      ],
      projects: [
        {
          title: "Game 1",
          description:
            "Game interaktif yang menantang keterampilan pemain dengan grafis menarik dan gameplay seru.",
          imgSrc: new URL("@/assets/img/project/Game1.PNG", import.meta.url)
            .href,
          filterClass: "filter-game",
        },
        {
          title: "SIPPEKA APP WEB",
          description:
            "Aplikasi web untuk pengelolaan data pelatihan kerja dengan antarmuka pengguna yang mudah digunakan.",
          imgSrc: new URL("@/assets/img/SIPPEKA.png", import.meta.url).href,
          filterClass: "filter-app",
        },
        {
          title: "Website HMIF",
          description:
            "Website resmi HMIF SMI Malang, menyediakan informasi kegiatan dan program kerja dengan desain responsif.",
          imgSrc: new URL("@/assets/img/web_hmif.png", import.meta.url).href,
          filterClass: "filter-branding",
        },
      ],
    };
  },
  methods: {
    changeFilter(filterValue) {
      this.activeFilter = filterValue;
      if (this.iso) {
        this.iso.arrange({
          filter: filterValue === "*" ? "*" : `.${filterValue}`,
        });
      }
    },
  },
  mounted() {
    this.$nextTick(() => {
      this.iso = new Isotope(".isotope-container", {
        itemSelector: ".isotope-item",
        layoutMode: "masonry",
      });

      GLightbox({
        selector: ".glightbox",
      });
    });
  },
  beforeUnmount() {
    if (this.iso) {
      this.iso.destroy();
    }
  },
};
</script>

<style scoped>
.filter-active {
  font-weight: bold;
  color: #007bff;
  cursor: pointer;
}
.portfolio-item {
  transition: transform 0.3s ease;
}
</style>
