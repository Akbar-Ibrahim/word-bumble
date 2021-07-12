<template>
  <div class="w3-container" style="margin-bottom: 20px">
      <h1 class="w3-center">Congrats!</h1>
      <div class="w3-container w3-center w3-margin w3-padding">You made it.</div>

      <div class="w3-container w3-center ">
        <button class="w3-button" @click="reload">Play Again</button>
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
