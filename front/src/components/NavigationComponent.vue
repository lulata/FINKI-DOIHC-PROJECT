<template>
  <nav>
    <router-link
      :to="{
        name: 'LandingPage',
      }"
    >
      <img src="@/assets/logo.svg" />
    </router-link>
    <div class="navigation-actions">
      <div class="navigation-actions-box">
        <img src="@/assets/icons/searchIcon.svg" />
        <h5 class="heading-5">Search</h5>
      </div>
      <router-link
        :to="{
          name: 'BasketView',
        }"
        class="navigation-actions-box"
      >
        <img src="@/assets/icons/cartIcon.svg" />
        <h5 class="heading-5">Cart</h5>
      </router-link>
      <router-link
        :to="{
          name: 'CarsView',
        }"
        class="navigation-actions-box"
      >
        <h5 class="heading-5">Cars</h5>
      </router-link>
      <router-link
        :to="{
          name: 'LoginView',
        }"
        class="navigation-actions-box"
        v-if="!checkIfLoggedIn()"
      >
        <h5 class="heading-5">Login</h5>
      </router-link>

      <div class="navigation-actions-box" v-else @click="logOutUser">
        <h5 class="heading-5">Logout</h5>
      </div>
    </div>
  </nav>
</template>

<script lang="ts" setup>
import axios from "axios";
import router from "@/router";

function logOutUser() {
  axios.post("/api/logout").then(() => {
    window.isAuthenticated = false;
    router.push({ name: "LandingPage" });
  });
}

function checkIfLoggedIn(){
  return window.isAuthenticated;
}
</script>
