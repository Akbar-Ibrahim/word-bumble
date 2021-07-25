<template>
  <div class="">
    <div ref="rules">
      <rules
        :level="level"
        :rules="rules"
        @play-quiz="playQuiz"
        :is-done="isDone"
      ></rules>
      <div v-if="isDone == true" class="w3-container w3-center w3-margin">
        <proceed
          @proceed="proceedToNextChallenge"
        >
          
        </proceed>
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
        <div style="font-size: 21px" class="w3-padding" ref="score">
          {{ score }}/{{ total }}
          </div>
      </div>
      <div class="">
        <div class="">
          <div
            class="w3-center"
            ref="playAgain"
            style="display: none"
          >
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
  props: ["letters"],

  data() {
    return {
      total: 50,
      wordLength: 3,
      alphabet: JSON.parse(this.letters),
      isDone: false,
      level: 1,
      nextLetter: "",
      score: 0,
      rules:
        "The rules are simple. You and computer will trade 3 letter words. Do not repeat a word you have mentioned already or a word computer has mentioned",
      listOfComputerWords: [],
      listOfPlayerWords: [],
      computer: "",
      timer: 10,
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
        if (
          this.listOfComputerWords.length > 0 &&
          this.listOfPlayerWords.length > 0
        ) {
          this.checkIfWordAlreadyExists(word);
        }

        // var data = {
        //   wordLength: this.wordLength,
        //   playerWord: word,

        // };

        var data = this.nextLevelPayload();

        data = JSON.stringify(data);

        fetch("/api/words/specific", {
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
              if (this.listOfPlayerWords.length == this.total) {
                this.stopTimer();
                this.endLevel();
              } else {
                this.$refs.computerWord.textContent = result[0].word;
                this.computer = result[0].word;
                this.listOfComputerWords.push(result[0]);
              }
            } else {
              this.gameOver();
            }
          });
      }
      
    },

    checkIfWordAlreadyExists(word) {
      var checkComputer = 0;
      var checkPlayer = 0;
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

      if (checkComputer > 0 || checkPlayer > 0) {
        this.gameOver();
      }
    },

    nextLevel() {
      var alphabetLength = this.alphabet.length;
      var getNextLetterIndex = Math.floor(Math.random() * alphabetLength + 1);
      this.nextLetter = this.alphabet[getNextLetterIndex];
      this.$refs.randomLetter.textContent = this.nextLetter.toUpperCase();
      // this.playQuiz();
      this.$refs.computerWord.textContent = "Let's go!";
    },

    nextLevelPayload() {
      var word = this.$refs.word.value;

      var data = {};
      if (this.level == 1) {
        data = {
          wordLength: this.wordLength,
          playerWord: word,
        };
      } else if (this.level == 2) {
        data = {
          wordLength: this.wordLength,
          playerWord: word,
          start: this.nextLetter,
        };
      } else if (this.level == 3) {
        data = {
          wordLength: this.wordLength,
          playerWord: word,
          end: this.nextLetter,
        };
      } else if (this.level == 4) {
        data = {
          wordLength: this.wordLength,
          playerWord: word,
          contains: this.nextLetter,
        };
      }

      return data;
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
      // if (this.listOfPlayerWords.length == 10) {

      this.listOfPlayerWords = [];
      this.listOfComputerWords = [];
      this.level += 1;
      if (this.level == 2) {
        this.rules =
          "A letter would be selected at random. Your mission, should you accept would be to name " +
          this.wordLength +
          " letter words that begin with that letter. Goodluck!";
      } else if (this.level == 3) {
        this.rules =
          "A letter would be selected at random. Your mission, should you accept would be to name " +
          this.wordLength +
          " letter words that end with that letter. Goodluck!";
      } else if (this.level == 4) {
        this.rules =
          "A letter would be selected at random. Your mission, should you accept would be to name " +
          this.wordLength +
          " letter words that contains that letter but does not begin and/or end with it. Goodluck!";
      } else {
        this.isDone = true;
        var nextChallenge = parseInt(this.wordLength) + 1;
        this.rules =
          "You're done with " +
          this.wordLength +
          " letters. Want to take " +
          nextChallenge +
          " for a spin?";
      }
      this.$refs.rules.style.display = "block";
      this.$refs.gameWrapper.style.display = "none";
      // this.$refs.show.style.display = "none";
      // }
      this.nextLevel();
    },

    verifyConditionsAreMet(word) {
      switch (this.level) {
        case 1:
          if (word.length == this.wordLength) {
            this.sendWord(word);
          } else {
            this.gameOver();
          }
          break;
        case 2:
          if (word.charAt(0) === this.nextLetter) {
            this.sendWord(word);
          } else {
            this.gameOver();
          }
          break;
        case 3:
          var lengthOfWord = word.length - 1;

          if (this.nextLetter === word.charAt(lengthOfWord)) {
            this.sendWord(word);
          } else {
            this.gameOver();
          }
          break;
        case 4:
          var lengthOfWord = word.length - 1;
          var check = 0;
          if (
            word.charAt(0) !== this.nextLetter &&
            word.charAt(lengthOfWord) !== this.nextLetter
          ) {
            for (var i = 1; i < word.length; i++) {
              if (word.charAt(i) === this.nextLetter) {
                check += 1;
              }
            }
            if (check > 0) {
              this.sendWord(word);
            } else {
              this.gameOver();
            }
          } else {
            this.gameOver();
          }
          break;
        default:
      }
    },

    gameOver() {
      this.$refs.playAgain.style.display = "block";
      this.$refs.gameContainer.style.display = "none";
    },

    

    proceedToNextChallenge() {
      var next = parseInt(this.wordLength) + 1;
      this.playQuiz();
      // location.href = "/words/" + next;
    },
  },
};
</script>
