<script>
export default {
    name: "ServicesSection",
};
</script>

<template>
    <section id="services" class="services section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Program Kerja</h2>
            <p>
                Himpunan Mahasiswa Informatika (HIMATIKA) SMI Malang memiliki
                berbagai program kerja yang dirancang <br />
                untuk mendukung pengembangan akademik, soft skill, dan karir
                mahasiswa, serta mempererat hubungan antar anggota.
            </p>
        </div>
        <!-- End Section Title -->

        <div class="container">
            <div class="row gy-4">
                <div
                    class="col-xl-3 col-md-6 d-flex"
                    data-aos="fade-up"
                    data-aos-delay="100"
                >
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-code-slash"></i></div>
                        <h4>Programming Class</h4>
                        <p>
                            Pelatihan programming bagi seluruh anggota HMIF
                            serta siapa saja yang berminat belajar programming.
                            Beberapa bidang yang dipelajari mulai dari website,
                            mobile, dan IOT di sesuai dengan minat peserta
                            programming class.
                        </p>
                    </div>
                </div>
                <!-- End Service Item -->

                <div
                    class="col-xl-3 col-md-6 d-flex"
                    data-aos="fade-up"
                    data-aos-delay="200"
                >
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-globe"></i></div>
                        <h4>HMIF Sport</h4>
                        <p>
                            Program kerja berkelanjutan atau jangka panjang yang
                            dimana disini HMIF akan memfasilitasi seluruh
                            anggota yang berminat dalam bidang olahraga.
                        </p>
                    </div>
                </div>
                <!-- End Service Item -->

                <div
                    class="col-xl-3 col-md-6 d-flex"
                    data-aos="fade-up"
                    data-aos-delay="300"
                >
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h4>HMIF Peduli</h4>
                        <p>
                            Kegiatan berbagi takjil pada bulan Ramadan untuk
                            masyarakat sekitar menjelang waktu berbuka puasa dan
                            kunjungan dan kegiatan sosial di panti asuhan untuk
                            memberikan bantuan dan dukungan.
                        </p>
                    </div>
                </div>
                <!-- End Service Item -->

                <div
                    class="col-xl-3 col-md-6 d-flex"
                    data-aos="fade-up"
                    data-aos-delay="400"
                >
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-activity"></i></div>
                        <h4>Seminar on Campus</h4>
                        <p>
                            Seminar dengan tema tertentu yang relevan dengan
                            teknologi informasi dan organisasi.
                        </p>
                    </div>
                </div>
                <!-- End Service Item -->
            </div>
        </div>
    </section>
</template>

<style scoped>
.services {
    padding: 60px 0;
}
.services .section-title {
    text-align: center;
    margin-bottom: 40px;
}
.services .section-title h2 {
    font-size: 36px;
    margin-bottom: 20px;
}
.services .section-title p {
    font-size: 18px;
    color: #555;
}
.service-item {
    background-color: #fff;
    border-radius: 10px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}
.service-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
}
.services a {
    text-decoration: none;
    color: #333;
}

@media (max-width: 768px) {
    .services .section-title h2 {
        font-size: 28px;
    }
    .services .section-title p {
        font-size: 16px;
    }
    .service-item {
        padding: 20px;
    }
    .service-item h4 {
        font-size: 18px;
    }
    .service-item p {
        font-size: 14px;
    }
}
</style>
