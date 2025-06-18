import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import BlogPost from "../pages/BlogPost.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: { title: "HMIF SMI Malang" },
  },
  {
    path: "/post",
    name: "BlogPost",
    component: BlogPost,
    meta: { title: "HMIF SMI Malang | Blog" },
  },
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

router.afterEach((to) => {
  if (to.meta && to.meta.title) {
    document.title = to.meta.title;
  } else {
    document.title = "HMIF SMI Malang";
  }
});

export default router;
