<template>
  <NavigationComponent />
  <div class="page-title">
    <h2 class="heading-2">Basket</h2>
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

        <button class="button is-invalid" @click="removeCar(car)">Remove</button>
      </div>
    </div>
  </div>

  <div class="page-footer-title">
    <h2 class="heading-2">Total</h2>
    <h2 class="heading-2" v-if="totalCalculated">{{ totalCalculated }} €</h2>
  </div>
  <div class="page-button-footer">
    <router-link
      :to="{
        name: 'CarsView',
      }"
      class="button"
      >Go back to shopping</router-link
    >

    <router-link
      :to="{
        name: 'PaymentView',
      }"
      class="button"
    >
      Proceed to payment
    </router-link>
  </div>
</template>

<script lang="ts" setup>
import { Product } from "@/types";
import { ref, computed, onMounted } from "vue";

onMounted(() => {
  getCars();
});

const cars = ref<Product[]>([]);

const totalCalculated = computed(() => {
  return cars.value.reduce((acc, car) => {
    return acc + car.price;
  }, 0);
});

function getCars() {
  const carsFromStorage = localStorage.getItem("cart");
  if (carsFromStorage) {
    cars.value = JSON.parse(carsFromStorage);
  }
}

function removeCar(car: Product) {
  const index = cars.value.findIndex((c) => c.id === car.id);
  cars.value.splice(index, 1);
  localStorage.setItem("cart", JSON.stringify(cars.value));
}
</script>
