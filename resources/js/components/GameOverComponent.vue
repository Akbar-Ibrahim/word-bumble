<template>
  <div class="w3-container">
    <h4>Game over!</h4>
    <div ref="message"></div>
    <div class="w3-container w3-center w3-margin">
    <button @click="playAgain" class="w3-button">Play Again</button>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    // console.log("Component mounted.");
    this.messages();
  },

  methods: {
    playAgain() {
      location.href = location.href;
    },

    messages() {
      var messages = [
        "You embarrass me.",
        "I see English is not your first language.",
        "It's okay. If I couldn't speak English, I would fail miserably too. But don't give up. Try again.",
        "Ode",
        "Maybe you want to try a word game in your native language?",
        "It's just words, fam. I don't know why it's so difficult for you.",
        "Let's never speak of this.",
        "You were such a cute kid with so much potential. What happened?",
        "English is not for everybody"
      ];

      var aboveThirtyMessages = ["You did good, son. (Or daughter)", "I'm proud of you. Keep at it.", "That's some good work."];

      var messageLength = messages.length;
      var getMessage = Math.floor(Math.random() * messageLength + 1);
      this.$refs.message.textContent = messages[getMessage];
    },



    
  },
};
</script>
