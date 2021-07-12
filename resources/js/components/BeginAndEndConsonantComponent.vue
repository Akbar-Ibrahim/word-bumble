<template>
  <div class="w3-container">
    <div ref="congrats" style="display: none;">
      <congrats></congrats>
    </div>
    <div ref="rules">
      <rules
        :level="level"
        :rules="rules"
        @play-quiz="playQuiz"
        :is-done="isDone"
      ></rules>
      <div v-if="isDone == true" class="w3-container w3-center">
        <button
          @click="proceedToNextChallenge"
          class="w3-button"
          ref="nextChallenge"
        >
          Proceed to next challenge
        </button>
      </div>
    </div>
    <div ref="gameWrapper" class="w3-row-padding" style="display: none">
      <div class="d-flex">
        <div
          style="font-size: 21px"
          class="flex-grow-1 w3-padding"
          ref="randomLetter"
        ></div>
        <div style="font-size: 21px" class="w3-padding" ref="timer">
          00:<span v-if="timer < 10">0</span>{{ timer }}
        </div>
      </div>
      <div class="w3-container">
        <div class="w3-container">
          <div
            class="w3-container w3-center"
            ref="playAgain"
            style="display: none"
          >
            <game-over></game-over>
          </div>

          <div ref="gameContainer" class="">
            <div class="w3-container">
              <div style="font-size: 21px" class="w3-center" ref="computerWord">
                Let's go!
              </div>
            </div>

            <div class="card-body">
              <input
                ref="word"
                type="text"
                name="word"
                class="form-control input-sm"
                placeholder="Enter your word here..."
                @keyup.enter="checkBeforeSending"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="w3-container">
        <single-player-tally
          :listOfPlayerWords="listOfPlayerWords"
        ></single-player-tally>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [],

  data() {
    return {
      vowels: ["a", "e", "i", "o", "u"],
      vowelIndex: 0,
      isDone: false,
      level: 1,
      letter: "",
      rules:
        "Mention words that begin and end with a consonant",
      listOfPlayerWords: [],
      computer: "",
      timer: 10,
    };
  },

  created() {},

  mounted() {},

  methods: {
    startTimer() {
      if (this.level > 1) {
        // setInterval(this.myTimer, 2000);
      } else {
        setInterval(this.myTimer, 1000);
      }
    },

    playQuiz() {
      this.$refs.rules.style.display = "none";
      this.$refs.gameWrapper.style.display = "block";

      this.resetTimer();
      this.startTimer();
    },

    checkBeforeSending() {
      var word = this.$refs.word.value.trim();

      if (word) {
        this.verifyConditionsAreMet(word);
      }
    },

    sendWord() {
      var word = this.$refs.word.value.trim();
      if (word) {
        // if (this.listOfPlayerWords.length > 0) {
        //   this.checkIfWordAlreadyExists(word);
        // }

        var data = {
          playerWord: word,
        };

        data = JSON.stringify(data);

        fetch("/api/words/vowel/uncluster", {
          method: "post",
          headers: {
            "Content-Type": "application/json",
          },
          body: data,
        })
          .then((response) => {
            return response.json();
          })
          .then((result) => {
            console.log(result);
            if (result.length > 0) {
              this.listOfPlayerWords.push(word);
              this.resetTimer();
              if (this.listOfPlayerWords.length == 10) {
                this.resetTimer();
                this.endLevel();
              }
            } else {
              this.gameOver();
            }
          });
      }
      this.$refs.word.value = "";
    },

    checkIfWordAlreadyExists(word) {
      var checkPlayer = 0;

      for (var i = 0; i < this.listOfPlayerWords.length; i++) {
        if (word === this.listOfPlayerWords[i]) {
          checkPlayer = checkPlayer + 1;
        }
      }

      if (checkPlayer > 0) {
        this.gameOver();
      } else {
        this.sendWord();
      }
    },

    resetTimer() {
      clearInterval(this.myTimer);
      this.timer = 10;
    },

    endLevel() {
      // this.level += 1;
      this.listOfPlayerWords = [];
      this.$refs.congrats.style.display = "block";
      this.$refs.gameWrapper.style.display = "none";
    },

    checkWord(word) {
      var check = 0;
      var lengthOfWord = word.length - 1;

      if (
        word.charAt(0).match(/\b[bcdfghjklmnpqrstvwxyz]/) &&
        word.charAt(lengthOfWord).match(/[bcdfghjklmnpqrstvwxyz]\b/)
      ) {
        this.checkIfWordAlreadyExists(word);
      } else {
        this.gameOver();
      
      }

      
    },

    verifyConditionsAreMet(word) {
      this.checkWord(word);
    },

    gameOver() {
      this.$refs.playAgain.style.display = "block";
      this.$refs.gameContainer.style.display = "none";
    },

    myTimer() {
      if (this.timer == 0) {
        this.gameOver();
      } else {
        this.timer -= 1;
      }
    },


  },
};
</script>
