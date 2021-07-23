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
  props: ["score"],
  updated() {
    
  }, 

  mounted() {
    // console.log("Component mounted.");
    
  },

  methods: {
    playAgain() {
      location.href = location.href;
    },

    messages() {
      var belowTenMessages = [
        "You embarrass me.",
        "I see English is not your first language.",
        "It's okay. If I couldn't speak English, I would fail miserably too. But don't give up. Try again.",
        "Ode",
        "Maybe you want to try a word game in your native language?",
        "It's just words, fam. I don't know why it's so difficult for you.",
        "Let's never speak of this.",
        "You were such a cute kid with so much potential. What happened?",
        "English is not for everybody",
      ];

      var aboveTwentyMessages = ["Meh", "That was not not terrible"];

      var aboveThirtyMessages = [
        "Nice work!",
        "I'm proud of you. Keep at it.",
        "That's some good work.",
        "Well done. Go again.",
      ];

      var aboveFortyMessages = [
        "I'm proud of you, son. (Or daughter. :))",
        "Very, very good!",
        "IQ level: Genius. Well done.",
        "I'm sure you can solve differential equations in your sleep",
        "Houston, we have a genius here."
      ];

      if (this.score < 10) {
        var messageLength = belowTenMessages.length;
        var getMessage = Math.floor(Math.random() * messageLength);
        this.$refs.message.textContent = belowTenMessages[getMessage];
      } else if (this.score > 10 && this.score <= 30) {
        var messageLength = aboveTwentyMessages.length;
        var getMessage = Math.floor(Math.random() * messageLength);
        this.$refs.message.textContent = aboveTwentyMessages[getMessage];
      } else if (this.score > 30 && this.score <= 40) {
        var messageLength = aboveThirtyMessages.length;
        var getMessage = Math.floor(Math.random() * messageLength);
        this.$refs.message.textContent = aboveThirtyMessages[getMessage];
      } else if (this.score > 40 && this.score <= 50) {
        var messageLength = aboveThirtyMessages.length;
        var getMessage = Math.floor(Math.random() * messageLength);
        this.$refs.message.textContent = aboveFortyMessages[getMessage];
      }
    },
  },
};
</script>
