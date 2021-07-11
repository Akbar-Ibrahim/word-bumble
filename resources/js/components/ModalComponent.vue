<template>
  <div class="container">
    
      <a href="javascript:void(0)" class="closebtn" @click="closeModal"
        >&times;</a
      >
      <div class="overlay-content">
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
      </div>

  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    closeModal(){
      this.$emit('close-modal');
    }
  },
};
</script>
