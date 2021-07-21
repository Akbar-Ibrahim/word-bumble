<template>
  <button
          @click="proceedToNextChallenge"
          class="w3-button w3-win8-lime w3-text-white"
          
        >
          Proceed to next challenge
        </button>
    
</template>

<script>
export default {
  mounted() {
    // console.log("Component mounted.");
    this.messages();
  },

  methods: {

    proceedToNextChallenge() {
      this.$emit('proceed');
    }
    
  },
};
</script>
