<template>
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

<script>
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

<style scoped>
html {
  scroll-behavior: smooth;
}
</style>
