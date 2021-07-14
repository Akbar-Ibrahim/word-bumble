<template>
  <div class="">
    <div ref="rules">
      <rules
        :level="level"
        :rules="rules"
        @play-quiz="playQuiz"
        :is-done="isDone"
      ></rules>
    </div>
    <div ref="gameWrapper" class="w3-row" style="display: none">
      <div class="d-flex">
        <div v-if="level == 1" class="w3-padding">
          <button class="w3-button" @click="nextLevel">Get Another Letter</button>
        </div>
        <div
          style="font-size: 21px"
          class="flex-grow-1 w3-padding"
          ref="randomLetter"
        ></div>
        <div style="font-size: 21px" class="w3-padding" ref="timer">
          00:<span v-if="timer < 10">0</span>{{ timer }}
        </div>
      </div>
      <div class="">
        <div class="">
          <div
            class=" w3-center"
            ref="playAgain"
            style="display: none"
          >
            <game-over></game-over>
          </div>

          <div ref="gameContainer" class="">
            <div class="">
              <div style="font-size: 21px" class="w3-center" ref="computerWord">
                Let's go!
              </div>
            </div>

            <div class="card-body">
              <!--  -->
              <div class="d-flex">
                <div class="flex-grow-1">
              <input
                ref="word"
                type="text"
                name="word"
                class="form-control input-sm"
                placeholder="Enter your word here..."
                @keyup.enter="checkBeforeSending"
              />
              </div>
              <div>
              <span class="input-group-btn" style="border: none">
                <button type="submit" class="btn btn-default go-button">
                  <!-- <span class="glyphicon glyphicon-search"></span> -->
                  Go
                </button>
              </span>
              </div>
              </div>
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
      alphabet: JSON.parse(this.letters),
      isDone: false,
      position: 1,
      level: 1,
      letter: "",
      rules:
        "The rules are simple. You and computer will trade words  that have a letter in a certain position. Do not repeat a word you have mentioned already or a word computer has mentioned",
      listOfComputerWords: [],
      listOfPlayerWords: [],
      computer: "",
      timer: 10,
    };
  },

  created() {},

  mounted() {
    this.nextLevel();
  },

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
      word.toLowerCase();

      if (word) {
        this.verifyConditionsAreMet(word);
      }
    },

    sendWord() {
      var word = this.$refs.word.value.trim();
      word.toLowerCase();
      if (word) {
        if (
          this.listOfComputerWords.length > 0 &&
          this.listOfPlayerWords.length > 0
        ) {
          this.checkIfWordAlreadyExists(word);
        }

        var data = {
          position: this.position,
          letter: this.letter,
          playerWord: word,
        };

        data = JSON.stringify(data);

        fetch("/api/words/specific/position", {
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
              if (this.listOfPlayerWords.length == 2) {
                this.resetTimer();
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
      this.$refs.word.value = "";
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
      this.letter = this.alphabet[getNextLetterIndex].toLowerCase();
      this.$refs.randomLetter.textContent = this.letter.toUpperCase();

      // this.playQuiz();
      this.$refs.computerWord.textContent = "Let's go!";
    },

    endLevel() {
      // if (this.listOfPlayerWords.length == 10) {
      this.$refs.computerWord.textContent = "Let's go!";

      this.listOfPlayerWords = [];
      this.listOfComputerWords = [];
      this.level += 1;
      if (this.level == 2) {
        this.position = 2;
        this.rules = this.rules =
          "Here, you name words that have " +
          this.letter +
          " in position " +
          this.level;
      } else if (this.level == 3) {
        this.rules = this.rules =
          "Here, you name words that have " +
          this.letter +
          " in position " +
          this.level;
        this.position = 3;
      } else if (this.level == 4) {
        this.rules = this.rules =
          "Here, you name words that have " +
          this.letter +
          " in position " +
          this.level;
        this.position = 4;
      } else if (this.level == 5) {
        this.rules = this.rules =
          "Here, you name words that have " +
          this.letter +
          " in position " +
          this.level;
        this.position = 5;
      } else if (this.level == 6) {
        this.rules = this.rules =
          "Here, you name words that have " +
          this.letter +
          " in position " +
          this.level;
        this.position = 6;
      } else if (this.level == 7) {
        this.rules = this.rules =
          "Here, you name words that have " +
          this.letter +
          " in position " +
          this.level;
        this.position = 7;
      } else if (this.level == 8) {
        this.rules = this.rules =
          "Here, you name words that have " +
          this.letter +
          " in position " +
          this.level;
        this.position = 8;
      } else if (this.level == 9) {
        this.rules = this.rules =
          "Here, you name words that have " +
          this.letter +
          " in position " +
          this.level;
        this.position = 9;
      } else {
        this.isDone = true;
      }
      this.$refs.rules.style.display = "block";
      this.$refs.gameWrapper.style.display = "none";
    },

    verifyConditionsAreMet(word) {
      switch (this.level) {
        case 1:
          if (word.charAt(0) === this.letter) {
            this.sendWord();
          } else {
            this.gameOver();
            
          }
          break;
        case 2:
          if (word.charAt(1) === this.letter) {
            this.sendWord();
          } else {
            this.gameOver();
            
          }
          break;
        case 3:
          if (word.charAt(2) === this.letter) {
            this.sendWord();
          } else {
            this.gameOver();
            
          }
          break;
        case 4:
          if (word.charAt(3) === this.letter) {
            this.sendWord();
          } else {
            this.gameOver();
            
          }

          break;
        case 5:
          if (word.charAt(4) === this.letter) {
            this.sendWord();
          } else {
            this.gameOver();
          }
          break;
        case 6:
          if (word.charAt(5) === this.letter) {
            this.sendWord();
          } else {
            this.gameOver();
          }
          break;

        case 7:
          if (word.charAt(6) === this.letter) {
            this.sendWord();
          } else {
            this.gameOver();
          }
          break;

        case 8:
          if (word.charAt(7) === this.letter) {
            this.position = 8;
            this.sendWord();
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

    myTimer() {
      if (this.timer == 0) {
        this.gameOver();
        
      } else {
        this.timer -= 1;
      }
    },

    resetTimer() {
      clearInterval(this.myTimer);
      this.timer = 10;
    },

  },
};
</script>
