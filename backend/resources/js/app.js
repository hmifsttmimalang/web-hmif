import "./bootstrap";
import { createApp } from "vue";
import "../css/app.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "bootstrap-icons/font/bootstrap-icons.css";
import "bootstrap";
import AOS from "aos";
import "aos/dist/aos.css";
import PureCounter from "@srexi/purecounterjs";
import App from "./App.vue";
import router from "./router";

AOS.init();
new PureCounter();

const app = createApp(App);
app.use(router);
app.mount("#app");
