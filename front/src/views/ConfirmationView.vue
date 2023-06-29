<template>
  <NavigationComponent />
  <div class="page-title">
    <h2 class="heading-2">Payment was successful</h2>
  </div>
  <div class="confirmation-page">
    <p class="body-text">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc nisi risus, efficitur dictum elit vel, placerat
      ultricies enim. Vivamus et mi ac elit elementum placerat. Aliquam pharetra fermentum malesuada. In vel interdum
      tortor. Proin sagittis neque metus, ut tempor mi maximus ut. Quisque fringilla quis massa sed dictum. Integer
      semper pulvinar mauris vitae mollis. Praesent lectus mi, feugiat quis posuere vitae, imperdiet eget massa. Nam sit
      amet egestas.
    </p>
    <router-link
      :to="{
        name: 'LandingPage',
      }"
      class="button"
      >Back to home</router-link
    >
  </div>
</template>
