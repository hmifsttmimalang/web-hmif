<script>
export default {
    name: "TeamSection",
    data() {
        return {
            carouselItems: [
                {
                    members: [
                        {
                            imgSrc: new URL(
                                "@/assets/img/anggota/Ketua.jpg",
                                import.meta.url
                            ).href,
                            altText: "Ketua umum",
                        },
                        {
                            imgSrc: new URL(
                                "@/assets/img/anggota/Ketua & Wakil.jpg",
                                import.meta.url
                            ).href,
                            altText: "Ketua & Wakil",
                        },
                    ],
                },
                {
                    members: [
                        {
                            imgSrc: new URL(
                                "@/assets/img/anggota/Sekretaris fix.jpg",
                                import.meta.url
                            ).href,
                            altText: "Sekretaris",
                        },
                        {
                            imgSrc: new URL(
                                "@/assets/img/anggota/Humas.jpg",
                                import.meta.url
                            ).href,
                            altText: "Humas",
                        },
                        {
                            imgSrc: new URL(
                                "@/assets/img/anggota/Ristek 1.jpg",
                                import.meta.url
                            ).href,
                            altText: "Ristek",
                        },
                    ],
                },
                {
                    members: [
                        {
                            imgSrc: new URL(
                                "@/assets/img/anggota/Divisi Media & Komunikasi.jpg",
                                import.meta.url
                            ).href,
                            altText: "Media Komunikasi",
                        },
                        {
                            imgSrc: new URL(
                                "@/assets/img/anggota/Divisi Design 1.jpg",
                                import.meta.url
                            ).href,
                            altText: "Design Division",
                        },
                        {
                            imgSrc: new URL(
                                "@/assets/img/anggota/Divisi Minat & Bakat.jpg",
                                import.meta.url
                            ).href,
                            altText: "Minat & Bakat",
                        },
                    ],
                },
                {
                    members: [
                        {
                            imgSrc: new URL(
                                "@/assets/img/anggota/Kearsipan.jpg",
                                import.meta.url
                            ).href,
                            altText: "Kearsipan",
                        },
                    ],
                },
            ],
        };
    },
};
</script>

<template>
    <section id="team" class="team section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Tim</h2>
            <p>
                Anggota HMIF SMI Malang yang berdedikasi dalam menjalankan tugas
                dan program kerja organisasi.
            </p>
        </div>
        <!-- End Section Title -->

        <div
            id="teamCarousel"
            class="carousel slide"
            data-bs-ride="carousel"
            data-bs-interval="3000"
            data-bs-pause="false"
        >
            <div class="carousel-inner">
                <div
                    v-for="(carouselItem, index) in carouselItems"
                    :key="index"
                    :class="['carousel-item', { active: index === 0 }]"
                >
                    <div class="row gy-4 justify-content-center">
                        <div
                            v-for="(
                                member, memberIndex
                            ) in carouselItem.members"
                            :key="memberIndex"
                            class="col-lg-3 col-md-6"
                        >
                            <div class="member">
                                <img
                                    :src="member.imgSrc"
                                    class="img-fluid"
                                    :alt="member.altText"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Carousel Item -->
            </div>

            <!-- Carousel Controls -->
            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#teamCarousel"
                data-bs-slide="prev"
            >
                <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                ></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#teamCarousel"
                data-bs-slide="next"
            >
                <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                ></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
</template>

<style scoped>
.team {
    padding: 60px 0;
}
.team .member {
    text-align: center;
    margin-bottom: 30px;
}
.section-title {
    text-align: center;
    margin-bottom: 40px;
    color: #333;
}
</style>
