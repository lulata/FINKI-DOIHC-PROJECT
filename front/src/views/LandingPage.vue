<template>
  <NavigationComponent />
  <img src="@/assets/landingImage.png" />

  <div class="landing-page">
    <div class="landing-page-title">
      <h1 class="heading-1">Get the best car deals</h1>
      <p class="body-text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, corrupti! Officiis provident quibusdam sed
        voluptates libero nihil mollitia id nostrum voluptatum dolor hic quidem blanditiis nulla voluptatibus dolorem
        autem, accusantium soluta eos ad quasi sit numquam dolores ipsa natus! Saepe, eos! Ipsum nobis a magni ullam
        corporis nam quidem non!
      </p>
    </div>

    <router-link
      :to="{
        name: 'CarsView',
      }"
      class="button"
    >
      Browse Cars
    </router-link>
  </div>
</template>

<script lang="ts"></script>
