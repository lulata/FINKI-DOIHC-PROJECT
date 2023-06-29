<template>
  <NavigationComponent />
  <div class="page-title">
    <h2 class="heading-2">Admin</h2>
    <router-link
      :to="{
        name: 'ProductView',
      }"
      class="button"
      >Add product</router-link
    >
  </div>
  <div class="car-wrapper">
    <div class="car-wrapper-box" v-for="car in cars" :key="car.id">
      <img :src="car.image_url" />
      <div class="car-wrapper-box-info">
        <div class="car-wrapper-box-info-box">
          <p class="info-text">{{ car.name }}</p>
          <p class="list-text-bold">
            {{ car.price }}
            €
          </p>
        </div>

        <div class="car-wrapper-box-info-box">
          <p class="info-text">Brand</p>
          <p class="list-text">
            {{ car.brand }}
          </p>
        </div>

        <div class="car-wrapper-box-info-box">
          <p class="info-text">Color</p>
          <p class="list-text">
            {{ car.color }}
          </p>
        </div>

        <div class="car-wrapper-box-info-box">
          <p class="info-text">Transmission</p>
          <p class="list-text">
            {{ car.transmission }}
          </p>
        </div>

        <router-link
          :to="{
            name: 'ProductEdit',
            params: { id: car.id },
          }"
          class="button"
          >Edit</router-link
        >
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { Product } from "@/types";
import { ref, onMounted } from "vue";
import axios from "axios";
import router from "@/router";

const cars = ref<Product[]>([]);

onMounted(() => {
  if (!window.isAuthenticated) {
    router.push({ name: "LoginView" });
  }

  getProducts();
});

function getProducts() {
  axios
    .get("/api/cars")
    .then((response) => {
      cars.value = response.data;
    })
    .catch((error) => {
      console.log(error);
    });
}
</script>
