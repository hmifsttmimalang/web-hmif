import { createApp } from "vue";
import "./style.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import App from "./App.vue";

if (window.AOS) {
  window.AOS.init();
}

createApp(App).mount("#app");
