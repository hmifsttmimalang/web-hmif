<script>
import { Head } from "@inertiajs/vue3";
import HeroSection from "../components/HeroSection.vue";
import AboutSection from "../components/AboutSection.vue";
import ServicesSection from "../components/ServicesSection.vue";
import MoreServicesSection from "../components/MoreServicesSection.vue";
import PortfolioSection from "../components/PortfolioSection.vue";
// import TeamSection from "../components/TeamSection.vue";
import Footer from "../components/Footer.vue";
import LandingLayout from "../layouts/LandingLayout.vue";

export default {
  components: {
    Head,
    LandingLayout,
    HeroSection,
    AboutSection,
    ServicesSection,
    MoreServicesSection,
    PortfolioSection,
    // TeamSection,
    Footer,
  },
};
</script>

<template>
<Head title="HMIF SMI Malang" />
  <LandingLayout>
    <HeroSection />
    <AboutSection />
    <ServicesSection />
    <MoreServicesSection />
    <PortfolioSection />
    <!-- <TeamSection /> -->
    <Footer />
  </LandingLayout>
</template>

<style scoped>
html {
  scroll-behavior: smooth;
}
</style>
