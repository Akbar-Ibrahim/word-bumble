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
      isDone: false,
      score: 0,
      rules:
        "You will be shown a word, your mission is to form a word with each letter in the word before the time runs out",
      level: 1,
      listOfPlayerWords: [],
      wordLength: 0,
      letter: "",
      letterIndex: 0,
      computer: "",
      timer: 10,
    };
  },

  created() {},

  mounted() {
    this.fetchWord();
  },

  methods: {
    fetchWord() {
      let url = "api/get-word";
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          // console.log(result);
          this.computer = result.word;
          this.$refs.computerWord.textContent = this.computer;
          this.wordLength = result.word.length;
          this.letter = result.word.charAt(0);

          // console.log(result);
        });
    },

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
      if (this.letterIndex > 0) {
          if (word.charAt(0) === this.letter) {
            this.checkIfWordAlreadyExists(word);
          } else {
            this.gameOver();
          }
        
      } else {
        if (word.charAt(this.letterIndex) === this.letter) {
          if (word === this.computer){
              this.gameOver();
          } else {
            this.sendWord(word);
          }
          
        } else {
          this.gameOver();
        }
      }
      this.letterIndex += 1;
      this.letter = this.computer.charAt(this.letterIndex);
      
    },

    sendWord(word) {
      var data = {
        word: word,
      };

      data = JSON.stringify(data);

      if (word) {
        fetch("/api/every-letter", {
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
              if (this.listOfPlayerWords.length == this.wordLength) {
                // this.listOfPlayerWords = [];
                this.letter = "";
                this.letterIndex = 0;
                this.resetTimer();
                this.fetchWord();
              } else {
                // this.getComputerWords(result);
              }
            } else {
              this.gameOver();
            }
          });
      }
      // this.$refs.word.value = "";
    },

    checkIfWordAlreadyExists(word) {
      var check = 0;
      if (this.listOfPlayerWords.length > 0) {
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

    gameOver() {
      this.$refs.playAgain.style.display = "block";
      this.$refs.gameContainer.style.display = "none";
    },
  },
};
</script>
