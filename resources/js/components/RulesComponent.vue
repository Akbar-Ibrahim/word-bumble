<template>
  <div class="w3-container" style="margin-bottom: 20px">
    <div v-if="level == 1">
      <h1 class="w3-center"> Level {{ level }} </h1>
      <div class="w3-container w3-center">
        {{ rules }}
      </div>

      <div class="w3-center">
        <button @click="playQuiz" class="w3-button">Play</button>
      </div>
    </div>
    <div v-else-if="level > 1">
      <h1 class="w3-center">Congrats!</h1>
      <div class="w3-container w3-center w3-margin w3-padding">You made it to level {{ level }}.</div>

      <div class="w3-container w3-center">
        {{ rules }}
      </div>
      <div class="w3-center">
        <button v-if="isDone == false" @click="playQuiz" class="w3-button">Play</button>
        
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["rules", "level", "isDone"],
  mounted() {
    // console.log("Component mounted.");
  },

  methods: {
    playQuiz() {
      this.$emit("play-quiz");
    },

    nextLevel() {
      this.$emit("next-level");
    },

    

  },
};
</script>
