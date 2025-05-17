import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import BlogPost from "../pages/BlogPost.vue";

const routes = [
  { path: "/", name: "Home", component: Home },
  { path: "/post", name: "BlogPost", component: BlogPost },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (to.hash) {
      return {
        el: to.hash,
        behavior: "smooth",
      };
    }
    return { top: 0 };
  },
});

export default router;
