<template>
  <NavigationComponent />
  <div class="page-title">
    <h2 class="heading-2">
      {{ router.currentRoute.value.params.id ? "Edit product" : "Add product" }}
    </h2>
  </div>
  <div class="product-page">
    <h5 class="product-page-title heading-5">Car Information</h5>
    <div class="product-page-fields">
      <InputComponent
        v-model="product.name"
        :class="{
          'is-invalid': validation.name.$error,
        }"
        :error-message="validation.name.$error ? 'Required' : ''"
        :place-holder="'Name'"
      />
      <InputComponent
        v-model="product.price"
        :class="{
          'is-invalid': validation.price.$error,
        }"
        :error-message="validation.price.$error ? 'Required' : ''"
        :place-holder="'Price'"
      />

      <InputComponent
        v-model="product.image_url"
        :class="{
          'is-invalid': validation.image_url.$error,
        }"
        :error-message="validation.image_url.$error ? 'Required' : ''"
        :place-holder="'Image'"
      />

      <InputComponent
        v-model="product.brand"
        :class="{
          'is-invalid': validation.brand.$error,
        }"
        :error-message="validation.brand.$error ? 'Required' : ''"
        :place-holder="'Brand'"
      />

      <InputComponent
        v-model="product.color"
        :class="{
          'is-invalid': validation.color.$error,
        }"
        :error-message="validation.color.$error ? 'Required' : ''"
        :place-holder="'Color'"
      />

      <InputComponent
        v-model="product.transmission"
        :class="{
          'is-invalid': validation.transmission.$error,
        }"
        :error-message="validation.transmission.$error ? 'Required' : ''"
        :place-holder="'Transmission'"
      />
    </div>
  </div>
  <div
    class="page-button-footer"
    :class="{
      center: !router.currentRoute.value.params.id,
    }"
  >
    <button class="button is-invalid" v-if="router.currentRoute.value.params.id" @click="deleteProduct">Delete</button>

    <button class="button" @click="submit">
      {{ router.currentRoute.value.params.id ? "Update" : "Add" }}
    </button>
  </div>
</template>

<script lang="ts" setup>
import { Product } from "@/types";
import { ref, computed, onMounted } from "vue";
import { useVuelidate, ValidationRule } from "@vuelidate/core";
import { required } from "@vuelidate/validators";
import axios from "axios";
import router from "@/router";

const product = ref<Product>({
  name: "",
  price: 0,
  image_url: "",
  brand: "",
  color: "",
  transmission: "",
});

const validationRules = computed(() => {
  const localRules: Record<string, Record<string, ValidationRule | Record<string, ValidationRule>>> = {};
  localRules.name = {
    required,
  };

  localRules.price = {
    required,
  };

  localRules.image_url = {
    required,
  };

  localRules.brand = {
    required,
  };

  localRules.color = {
    required,
  };

  localRules.transmission = {
    required,
  };

  return localRules;
});

const validation = useVuelidate(validationRules, product);
const submitted = ref(false);

onMounted(() => {
  if (!window.isAuthenticated) {
    router.push({ name: "LandingPage" });
  }

  if (router.currentRoute.value.params.id) {
    axios.get(`/api/cars/${router.currentRoute.value.params.id}`).then((response) => {
      product.value = response.data;
    });
  }
});

function deleteProduct() {
  axios.delete(`/api/cars/${router.currentRoute.value.params.id}`).then(() => {
    router.push({ name: "AdminView" });
  });
}

function submit() {
  if (submitted.value) {
    return;
  }

  validation.value.$touch();

  if (validation.value.$error) {
    return;
  }
  submitted.value = true;

  if (router.currentRoute.value.params.id) {
    axios.post(`/api/cars/${router.currentRoute.value.params.id}`, product.value).then(() => {
      router.push({ name: "AdminView" });
    });
  } else {
    axios.post("/api/cars", product.value).then(() => {
      router.push({ name: "AdminView" });
    });
  }
}
</script>
