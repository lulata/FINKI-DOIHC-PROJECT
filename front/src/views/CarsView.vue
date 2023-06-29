<template>
  <NavigationComponent />

  <div class="cars-page">
    <div class="filters-wrapper">
      <h2 class="heading-2">Filters</h2>

      <div class="filters-wrapper-box">
        <h5 class="heading-5 filters-wrapper-box-title">Brand</h5>

        <div class="checkbox" v-for="brand in brands" :key="brand.value">
          <input type="checkbox" :id="brand.value" name="bmw" :value="brand.value" />
          <label class="body-text" :for="brand.value">{{ brand.name }}</label>
        </div>
      </div>

      <div class="filters-wrapper-box">
        <h5 class="heading-5 filters-wrapper-box-title">Colors</h5>

        <div class="checkbox" v-for="color in colors" :key="color.value">
          <input type="checkbox" :id="color.value" name="bmw" :value="color.value" />
          <label class="body-text" :for="color.value">{{ color.name }}</label>
        </div>
      </div>
      <div class="filters-wrapper-box">
        <h5 class="heading-5 filters-wrapper-box-title">Transmission</h5>

        <div class="checkbox" v-for="transmission in transmissions" :key="transmission.value">
          <input type="checkbox" :id="transmission.value" name="bmw" :value="transmission.value" />
          <label class="body-text" :for="transmission.value">{{ transmission.name }}</label>
        </div>
      </div>
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

          <button class="button" @click="addToCart(car)">Add To Cart</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { Product } from "@/types";
import { ref, onMounted } from "vue";
import axios from "axios";

const cars = ref<Product[]>([]);

const brands = [
  {
    name: "BMW",
    value: "bmw",
  },
  {
    name: "Audi",
    value: "audi",
  },
  {
    name: "Mercedes",
    value: "mercedes",
  },
  {
    name: "Volkswagen",
    value: "volkswagen",
  },
  {
    name: "Toyota",
    value: "toyota",
  },
  {
    name: "Honda",
    value: "honda",
  },
  {
    name: "Hyundai",
    value: "hyundai",
  },
  {
    name: "Nissan",
    value: "nissan",
  },
  {
    name: "Mazda",
    value: "mazda",
  },
];

const colors = [
  {
    name: "Red",
    value: "red",
  },
  {
    name: "Blue",
    value: "blue",
  },
  {
    name: "Green",
    value: "green",
  },
  {
    name: "Yellow",
    value: "yellow",
  },
  {
    name: "Black",
    value: "black",
  },
  {
    name: "White",
    value: "white",
  },
];

const transmissions = [
  {
    name: "Automatic",
    value: "automatic",
  },
  {
    name: "Manual",
    value: "manual",
  },
];

onMounted(() => {
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

function addToCart(car: Product) {
  const cart = localStorage.getItem("cart");
  if (cart) {
    const parsedCart = JSON.parse(cart);
    parsedCart.push(car);
    localStorage.setItem("cart", JSON.stringify(parsedCart));
  } else {
    localStorage.setItem("cart", JSON.stringify([car]));
  }
}
</script>
