import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import HomeView from "../views/HomeView.vue";

const routes: Array<RouteRecordRaw> = [
  {
    path: "/",
    name: "LandingPage",
    component: () => import(/* webpackChunkName: "about" */ "../views/LandingPage.vue"),
  },
  {
    path: "/cars",
    name: "CarsView",
    component: () => import(/* webpackChunkName: "about" */ "../views/CarsView.vue"),
  },
  {
    path: "/basket",
    name: "BasketView",
    component: () => import(/* webpackChunkName: "about" */ "../views/BasketView.vue"),
  },
  {
    path: "/payment",
    name: "PaymentView",
    component: () => import(/* webpackChunkName: "about" */ "../views/PaymentView.vue"),
  },
  {
    path: "/confirmation",
    name: "ConfirmationView",
    component: () => import(/* webpackChunkName: "about" */ "../views/ConfirmationView.vue"),
  },
  {
    path: "/login",
    name: "LoginView",
    component: () => import(/* webpackChunkName: "about" */ "../views/LoginView.vue"),
  },
  {
    path: "/product",
    name: "ProductView",
    component: () => import(/* webpackChunkName: "about" */ "../views/ProductView.vue"),
  },
  {
    path: "/product/:id",
    name: "ProductEdit",
    component: () => import(/* webpackChunkName: "about" */ "../views/ProductView.vue"),
  },
  {
    path: "/admin",
    name: "AdminView",
    component: () => import(/* webpackChunkName: "about" */ "../views/AdminView.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
