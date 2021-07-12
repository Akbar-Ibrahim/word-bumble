<template>
  <div class="w3-container">
    <div ref="rules">
      <rules
        :level="level"
        :rules="rules"
        @play-quiz="playQuiz"
        :is-done="isDone"
      ></rules>
    </div>
    <div ref="gameWrapper" class="w3-row-padding" style="display: none">
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
      isDone: false,
      rules:
        "The rules are simple. You'll name a word and computer will form a word with the last letter of your word and so will you with computer's word, and on and on...",
      level: 1,
      numbers: [4,5,6,7,8,9,10,11,12,13,14,15,16],
      listOfComputerWords: [],
      listOfPlayerWords: [],
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

    checkBeforeSending() {
      if (this.computer.length > 0) {
        var word = this.$refs.word.value.trim();
        var lengthOfComputerWord = this.computer.length - 1;

        if (this.computer.charAt(lengthOfComputerWord) === word.charAt(0)) {
          if (this.level > 1) {
            this.levelTwoConditions()
          }
          this.checkIfWordAlreadyExists(word);
        } else {
          this.gameOver();
        }
      } else {
        if (this.level > 1) {
            this.levelTwoConditions()
          }
        this.sendWord();
      }
    },

    sendWord() {
      var word = this.$refs.word.value;
      
      var data = {
        word: word,
      };

      data = JSON.stringify(data);

      if (word) {
        fetch("/api/words/bande", {
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
              if (this.listOfPlayerWords.length == 20) {
                this.resetTimer();
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
      this.$refs.word.value = "";
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
        this.sendWord();
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
      this.rules = "Now, you are going to form words with the last letter of computer's words but with a specified length."


      this.$refs.rules.style.display = "block";
      this.$refs.gameWrapper.style.display = "none";
      this.$refs.computerWord.textContent = "Let's go!";
      this.computer = "";
    },

    levelTwoConditions(){
      var getRandomNumber = Math.floor(Math.random() * this.numbers.length + 1);
        this.wordLength = this.numbers[getRandomNumber];
        this.$refs.wLength.textContent = this.wordLength;
        
    },

    gameOver() {
      this.$refs.playAgain.style.display = "block";
      this.$refs.gameContainer.style.display = "none";
    },
  },
};
</script>
