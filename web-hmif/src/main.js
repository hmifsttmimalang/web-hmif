import { createApp } from "vue";
import "./style.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "bootstrap-icons/font/bootstrap-icons.css";
import "bootstrap";
import App from "./App.vue";

if (window.AOS) {
  window.AOS.init();
}

createApp(App).mount("#app");
