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
        <div ref="wLength"></div>
        <div
          style="font-size: 21px"
          class="flex-grow-1 w3-padding"
          ref="randomLetter"
        ></div>
        <div style="font-size: 21px" class="w3-padding" ref="timer">
          00:<span v-if="timer < 10">0</span>{{ timer }}
        </div>
        <div style="font-size: 21px" class="w3-padding" ref="score">
          {{ score }}/100
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
  props: ["myLetter"],

  data() {
    return {
      isDone: false,
      score: 0,
      letter: this.myLetter,
      rules: "Trade words with computer that end with " + this.myLetter,
      level: 1,
      numbers: [4, 5, 6, 7, 8],
      listOfComputerWords: [],
      listOfPlayerWords: [],
      wordLength: 0,
      computer: "",
      timerCount: 10,
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

    playAgain() {
      location.href = "/begining/end";
    },

    checkBeforeSending(word) {
      var position = this.wordLength - 1;

      var lengthOfWord = word.length - 1;
      if (this.computer.length > 0) {
        if (word.charAt(lengthOfWord) === this.letter) {
          switch (this.level) {
            case 1:
              this.checkIfWordAlreadyExists(word);
              break;
            case 2:
              if (word.length == this.wordLength) {
                this.checkIfWordAlreadyExists(word);
                this.getRandomNumber();
              } else {
                this.gameOver();
              }
              break;
            default:
          }
        } else {
          this.gameOver();
        }
      } else {
        if (word.charAt(lengthOfWord) === this.letter) {
          switch (this.level) {
            case 1:
              this.sendWord(word);
              break;
            case 2:
              if (word.length == this.wordLength) {
                this.sendWord(word);
                this.getRandomNumber();
              } else {
                this.gameOver();
              }
              break;
            default:
          }
        } else {
          this.gameOver();
        }
      }
    },

    sendWord(word) {
      // var word = this.$refs.word.value.trim();

      // var data = {
      //   word: word,
      //   letter: this.letter,
      // };

      var data = this.nextLevelPayload(word);

      data = JSON.stringify(data);

      if (word) {
        fetch("/api/ends-with", {
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
              if (this.listOfPlayerWords.length == 50) {
                this.resetTimer();
                this.endLevel();
              } else {
                this.getComputerWords(result);
              }
            } else {
              this.gameOver();
            }
          });
      }
      // this.$refs.word.value = "";
    },

    getComputerWords(result) {
      switch (this.level) {
        case 1:
          this.$refs.computerWord.textContent = result.word;
          this.computer = result.word;
          this.listOfComputerWords.push(result);
          break;

        case 2:
          this.$refs.computerWord.textContent = result[0].word;
          this.computer = result[0].word;
          this.listOfComputerWords.push(result[0]);
          break;
        default:
      }
    },

    checkIfWordAlreadyExists(word) {
      var check = 0;
      if (
        this.listOfComputerWords.length > 0 &&
        this.listOfPlayerWords.length > 0
      ) {
        for (var i = 0; i < this.listOfComputerWords.length; i++) {
          if (word === this.listOfComputerWords[i]) {
            check = check + 1;
          }
        }

        for (var i = 0; i < this.listOfPlayerWords.length; i++) {
          if (word === this.listOfPlayerWords[i]) {
            check = check + 1;
          }
        }

        if (check > 0) {
          this.gameOver();
        } else {
          this.sendWord(word);
        }
      }
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

    endLevel() {
      this.listOfPlayerWords = [];
      this.listOfComputerWords = [];
      this.level += 1;
      this.rules =
        "Now, you are going to mention words that end with " +
        this.letter +
        " with a specified length";

      this.$refs.rules.style.display = "block";
      this.$refs.gameWrapper.style.display = "none";
      this.$refs.computerWord.textContent = "Let's go!";
      this.computer = "";

      this.getRandomNumber();
    },

    getRandomNumber() {
      var getRandomNumber = Math.floor(Math.random() * this.numbers.length);
      this.wordLength = this.numbers[getRandomNumber];
      // this.wordLength = 3;
      this.$refs.wLength.textContent = this.wordLength;
    },

    nextLevelPayload(word) {
      var data = [];

      switch (this.level) {
        case 1:
          data = {
            word: word,
            letter: this.letter
          };
          break;

        case 2:
          data = {
            word: word,
            letter: this.letter,
            length: this.wordLength,
          };
          break;
        default:
      }

      return data;
    },

    gameOver() {
      this.$refs.playAgain.style.display = "block";
      this.$refs.gameContainer.style.display = "none";
    },
  },
};
</script>
