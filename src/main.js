import { createApp } from "vue";
import "./style.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "bootstrap-icons/font/bootstrap-icons.css";
import "bootstrap";
import AOS from "aos";
import "aos/dist/aos.css";
import PureCounter from "@srexi/purecounterjs";
import App from "./App.vue";

// Inisialisasi library eksternal
AOS.init();
new PureCounter();

createApp(App).mount("#app");
