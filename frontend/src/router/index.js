import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import BlogPost from "../pages/BlogPost.vue";
import Register from "../pages/auth/Register.vue";
import Login from "../pages/auth/Login.vue";
import User from "../pages/user/User.vue";
import EditProfil from "../pages/user/EditProfil.vue";

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
  {
    path: "/register",
    name: "Register",
    component: Register,
    meta: { title: "HMIF SMI Malang | Register" },
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
    meta: { title: "HMIF SMI Malang | Login" },
  },
  {
    path: "/dashboard",
    name: "User",
    component: User,
    meta: { title: "User" },
  },
  {
    path: "/dashboard/edit-profil",
    name: "EditProfil",
    component: EditProfil,
    meta: { title: "User | Edit Profil" },
  }
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
