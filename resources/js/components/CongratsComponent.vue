<template>
  <div class="w3-container" style="margin-bottom: 20px">
      <h1 class="w3-center">Congrats!</h1>
      <div class="w3-container w3-center w3-margin w3-padding">You made it.</div>

      <div class="w3-container w3-center w3-margin">
        <button class="w3-hide-large w3-button w3-green w3-text-white w3-hover-amber" @click="reload" style="color: white; width: 100%;">Play Again</button>
        <button class="w3-hide-small w3-hide-medium w3-button w3-green w3-text-white w3-hover-amber" @click="reload" style="color: white; width: 50%;">Play Again</button>
      </div>

  </div>
</template>

<script>
export default {
  props: [],
  mounted() {
    // console.log("Component mounted.");
  },

  methods: {
    

    reload() {
      location.href = location.href
    },

    

  },
};
</script>
