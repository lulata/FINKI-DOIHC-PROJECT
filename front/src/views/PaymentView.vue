<template>
  <NavigationComponent />
  <div class="page-title">
    <h2 class="heading-2">Payment</h2>
  </div>
  <div class="payment-page">
    <div class="payment-page-box">
      <h5 class="heading-5 payment-page-box-title">Order Information</h5>
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
    </div>
    <div class="payment-page-box">
      <h5 class="heading-5 payment-page-box-title">Your Information</h5>
      <div class="payment-page-box-fields">
        <InputComponent
          v-model="customer.name"
          :class="{
            'is-invalid': validation.name.$error,
          }"
          :error-message="validation.name.$error ? 'Required' : ''"
          :place-holder="'Name'"
        />

        <InputComponent
          v-model="customer.email"
          :class="{
            'is-invalid': validation.email.$error,
          }"
          :error-message="validation.email.$error ? 'Required' : ''"
          :place-holder="'Email'"
        />

        <InputComponent
          v-model="customer.address"
          :class="{
            'is-invalid': validation.address.$error,
          }"
          :error-message="validation.address.$error ? 'Required' : ''"
          :place-holder="'Address'"
        />

        <InputComponent
          v-model="customer.cardHolder"
          :class="{
            'is-invalid': validation.cardHolder.$error,
          }"
          :error-message="validation.cardHolder.$error ? 'Required' : ''"
          :place-holder="'Card Holder'"
        />

        <InputComponent
          v-model="customer.cardNumber"
          :class="{
            'is-invalid': validation.cardNumber.$error,
          }"
          :error-message="validation.cardNumber.$error ? 'Required' : ''"
          :place-holder="'Card Number'"
        />

        <InputComponent
          v-model="customer.cardExpiration"
          :class="{
            'is-invalid': validation.cardExpiration.$error,
          }"
          :error-message="validation.cardExpiration.$error ? 'Required' : ''"
          :place-holder="'Card Expiration'"
        />

        <InputComponent
          v-model="customer.cardCvv"
          :class="{
            'is-invalid': validation.cardCvv.$error,
          }"
          :error-message="validation.cardCvv.$error ? 'Required' : ''"
          :place-holder="'Card CVV'"
        />
      </div>
    </div>
  </div>

  <div class="page-footer-title">
    <h2 class="heading-2">Total</h2>
    <h2 class="heading-2" v-if="totalCalculated">{{ totalCalculated }} €</h2>
  </div>
  <div class="page-button-footer center">
    <button class="button" @click="pay">Pay</button>
  </div>
</template>
<script lang="ts" setup>
import { Product } from "@/types";
import { ref, computed, onMounted } from "vue";
import { useVuelidate, ValidationRule } from "@vuelidate/core";
import { required, email } from "@vuelidate/validators";
import router from "@/router";

onMounted(() => {
  getCars();
});

const cars = ref<Product[]>([]);

const customer = ref({
  name: "",
  email: "",
  address: "",
  cardHolder: "",
  cardNumber: "",
  cardExpiration: "",
  cardCvv: "",
});

const validationRules = computed(() => {
  const localRules: Record<string, Record<string, ValidationRule | Record<string, ValidationRule>>> = {};
  localRules.name = {
    required,
  };

  localRules.email = {
    required,
    email,
  };

  localRules.address = {
    required,
  };

  localRules.cardHolder = {
    required,
  };

  localRules.cardNumber = {
    required,
  };

  localRules.cardExpiration = {
    required,
  };

  localRules.cardCvv = {
    required,
  };

  return localRules;
});

const validation = useVuelidate(validationRules, customer);

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

function pay() {
  validation.value.$touch();

  if (validation.value.$error) {
    return;
  }
  localStorage.removeItem("cart");
  router.push({ name: "ConfirmationView" });
}
</script>
