<template>
  <div class="w3-container">
    <h4>Game over!</h4>
    <div ref="message">{{ message }}</div>
    <div class="w3-container w3-center w3-margin">
      <button @click="playAgain" class="w3-button w3-green w3-text-white w3-hover-amber" style="color: white; width: 100%;">Play Again</button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["score"],

  data() {
    return {
      message: "",
      belowTenMessages: [
        "You embarrass me.",
        "I see English is not your first language.",
        "It's okay. If I couldn't speak English, I would fail miserably too. But don't give up. Try again.",
        "Ode",
        "Maybe you want to try a word game in your native language?",
        "It's just words, fam. I don't know why it's so difficult for you.",
        "Let's never speak of this.",
        "You were such a cute kid with so much potential. What happened?",
        "English is not for everybody",
      ],

      aboveTwentyMessages: ["Meh", "That was not not terrible"],

      aboveThirtyMessages: [
        "Nice work!",
        "I'm proud of you. Keep at it.",
        "That's some good work.",
        "Well done. Go again.",
      ],

      aboveFortyMessages: [
        "I'm proud of you, son. (Or daughter. :))",
        "Very, very good!",
        "IQ level: Genius. Well done.",
        "I'm sure you can solve differential equations in your sleep",
        "Houston, we have a genius here.",
      ],
    };
  },

  updated() {},

  mounted() {
    // console.log("Component mounted.");
    
  },

  methods: {
    playAgain() {
      location.href = location.href;
    },

    getMessage(score) {
    var messageLength = 0;
    var getMessage = 0;
      if (score < 10) {
        messageLength = this.belowTenMessages.length;
        getMessage = Math.floor(Math.random() * messageLength);
        this.message = this.belowTenMessages[getMessage];
      } else if (score > 10 && score <= 30) {
        messageLength = this.aboveTwentyMessages.length;
        getMessage = Math.floor(Math.random() * messageLength);
        this.message = this.aboveTwentyMessages[getMessage];
      } else if (score > 30 && score <= 40) {
        messageLength = this.aboveThirtyMessages.length;
        getMessage = Math.floor(Math.random() * messageLength);
        this.message = this.aboveThirtyMessages[getMessage];
      } else if (score > 40 && score <= 50) {
        messageLength = this.aboveFortyMessages.length;
        getMessage = Math.floor(Math.random() * messageLength);
        this.message = this.aboveFortyMessages[getMessage];
      }
    },
  },
};
</script>
