<template>
  <div class="">
    <div ref="congrats" style="display: none">
      <congrats></congrats>
    </div>
    <div ref="rules">
      <rules
        :level="level"
        :rules="rules"
        @play-quiz="playQuiz"
        :is-done="isDone"
      ></rules>
      <div v-if="isDone == true" class="w3-center w3-margin">
        <button
          @click="proceedToNextChallenge"
          class="w3-button"
          ref="nextChallenge"
        >
          Proceed to next challenge
        </button>
      </div>
    </div>
    <div ref="gameWrapper" class="w3-row" style="display: none">
      <div class="d-flex">
        <div
          style="font-size: 21px"
          class="flex-grow-1 w3-padding"
          ref="randomLetter"
        ></div>
        <div style="font-size: 21px" class="w3-padding" ref="timer">
          00:<span v-if="timer < 10">0</span>{{ timer }}
        </div>
        <div style="font-size: 21px" class="w3-padding" ref="score">
          {{ score }}/{{ total }}
          </div>
      </div>
      <div class="">
        <div class="">
          <div class="w3-center" ref="playAgain" style="display: none">
            <game-over :score="score"></game-over>
          </div>

          <div ref="gameContainer" class="">
            <div class="">
              <div style="font-size: 21px" class="w3-center" ref="computerWord">
                Let's go!
              </div>
            </div>

            <div class="card-body">
              <!--  -->
              <input-box @input-value="checkBeforeSending"></input-box>
              <!--  -->
            </div>
          </div>
        </div>
      </div>

      <div class="">
        <word-tally
          :listOfComputerWords="listOfComputerWords"
          :listOfPlayerWords="listOfPlayerWords"
        ></word-tally>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [],

  data() {
    return {
      consonants: [
        "b",
        "c",
        "d",
        "f",
        "g",
        "h",
        "j",
        "k",
        "l",
        "m",
        "n",
        "p",
        "q",
        "r",
        "s",
        "t",
        "v",
        "w",
        "x",
        "y",
        "z",
      ],
      score: 0,
      isDone: false,
      level: 1,
      letter: "",
      rules: "Enter words that begin and end with a consonant",
      listOfComputerWords: [],
      listOfPlayerWords: [],
      computer: "",
      timer: 10,
      myTimer: null,
      total: 50
    };
  },

  created() {},

  mounted() {},

  methods: {
    startTimer() {
      this.myTimer = setInterval( () => {
            if (this.timer == 0) {
              this.gameOver();
            } else {
              this.timer -= 1;
            }
        }, 1000);
    },

    playQuiz() {
      this.$refs.rules.style.display = "none";
      this.$refs.gameWrapper.style.display = "block";

      // this.resetTimer();
      this.startTimer();
    },

    checkBeforeSending(word) {
      
      if (word) {
        this.verifyConditionsAreMet(word);
      }
    },

    sendWord(word) {
      
      if (word) {
        // if (this.listOfPlayerWords.length > 0) {
        //   this.checkIfWordAlreadyExists(word);
        // }

        var data = {
          word: word,
          letter: this.letter,
        };

        data = JSON.stringify(data);

        fetch("/api/bb/consonants", {
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
              this.score += 1;
              this.resetTimer();
              if (this.listOfPlayerWords.length == this.timer) {
                this.stopTimer();
                this.endLevel();
              } else {
                this.$refs.computerWord.textContent = result.word;
                this.computer = result.word;
                this.listOfComputerWords.push(result);
              }
            } else {
              this.gameOver();
            }
          });
      }
      
    },

    getRandomLetter() {
      var getLetter = Math.floor(Math.random() * this.consonants.length + 1);
      this.letter = this.consonants[getLetter];
    },

    checkIfWordAlreadyExists(word) {
      var checkPlayer = 0;
      var checkComputer = 0;
      this.getRandomLetter();

      if (
        this.listOfComputerWords.length > 0 &&
        this.listOfPlayerWords.length > 0
      ) {
        for (var i = 0; i < this.listOfComputerWords.length; i++) {
          if (word === this.listOfComputerWords[i].word) {
            checkComputer = checkComputer + 1;
          }
        }

        for (var i = 0; i < this.listOfPlayerWords.length; i++) {
          if (word === this.listOfPlayerWords[i]) {
            checkPlayer = checkPlayer + 1;
          }
        }

        if (checkPlayer > 0 || checkComputer > 0) {
          this.gameOver();
        } else {
          this.sendWord(word);
        }
      } else {
        this.sendWord(word);
      }
    },

    stopTimer() {
      clearInterval(this.myTimer);
      this.timer = 10;
    },

    resetTimer() {
      clearInterval(this.myTimer);
      this.timer = 10;
      this.startTimer();
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

    
  },
};
</script>
