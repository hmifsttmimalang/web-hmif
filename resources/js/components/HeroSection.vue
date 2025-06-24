<script>
export default {
    name: "HeroSection",
    data() {
        return {
            carouselItems: [
                {
                    imgSrc: new URL(
                        "@/assets/img/kegiatan/IMG_1056.JPG",
                        import.meta.url
                    ).href,
                    altText: "Kegiatan HMIF SMI MALANG 1",
                    title: "Selamat Datang di HMIF!",
                    description:
                        "Bergabunglah dengan komunitas mahasiswa informatika yang aktif dan inovatif.",
                },
                {
                    imgSrc: new URL(
                        "@/assets/img/kegiatan/Futsal (2).jpg",
                        import.meta.url
                    ).href,
                    altText: "Kegiatan Futsal HMIF SMI MALANG",
                    title: "Semangat Kebersamaan dalam Futsal",
                    description:
                        "Kegiatan futsal rutin untuk menjaga kebugaran dan solidaritas.",
                },
                {
                    imgSrc: new URL(
                        "@/assets/img/kegiatan/IMG_1036.JPG",
                        import.meta.url
                    ).href,
                    altText: "Kegiatan HMIF SMI MALANG 2",
                    title: "Berkolaborasi dalam Proyek Kreatif",
                    description:
                        "Mengembangkan skill dan pengetahuan melalui proyek-proyek informatika yang menarik.",
                },
            ],
        };
    },
};
</script>

<template>
    <section id="hero" class="hero section dark-background">
        <div
            id="hero-carousel"
            class="carousel slide carousel-fade"
            data-bs-ride="carousel"
            data-bs-interval="5000"
        >
            <div
                class="carousel-item active"
                v-for="(item, index) in carouselItems"
                :key="index"
            >
                <img :src="item.imgSrc" :alt="item.altText" />
                <div class="carousel-container">
                    <h2 class="text-center">{{ item.title }}</h2>
                    <p class="text-center">{{ item.description }}</p>
                </div>
            </div>
            <a
                class="carousel-control-prev"
                href="#hero-carousel"
                role="button"
                data-bs-slide="prev"
            >
                <span
                    class="carousel-control-prev-icon bi bi-chevron-left"
                    aria-hidden="true"
                ></span>
            </a>
            <a
                class="carousel-control-next"
                href="#hero-carousel"
                role="button"
                data-bs-slide="next"
            >
                <span
                    class="carousel-control-next-icon bi bi-chevron-right"
                    aria-hidden="true"
                ></span>
            </a>
        </div>
    </section>
</template>
