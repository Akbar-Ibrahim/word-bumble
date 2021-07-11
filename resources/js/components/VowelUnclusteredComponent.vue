<template>
  <div class="w3-container">
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
        <word-tally
          :listOfComputerWords="listOfComputerWords"
          :listOfPlayerWords="listOfPlayerWords"
        ></word-tally>
      </div>
    </div>
<div ref="finish" class="overlay">
    <modal @close-modal="closeModal"></modal>
    </div>
    <button @click="openModal" ref="openModal">btn</button>
  </div>
</template>

<script>
export default {
  props: ["wordLength", "letters"],

  data() {
    return {
      vowels: ["a", "e", "i", "o", "u"],
      vowelIndex: 0,
      isDone: false,
      level: 1,
      letter: "a",
      rules: "Welcome to Vowel Unclustered. You and computer will trade " + this.wordLength + " letter words that contain the letter " + this.letter + ". But the " + this.letter +"'s must not come right after each other.",
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
        if (
          this.listOfComputerWords.length > 0 &&
          this.listOfPlayerWords.length > 0
        ) {
          this.checkIfWordAlreadyExists(word);
        }

        var data = {
          length: this.wordLength,
          playerWord: word,
          letter: this.letter,

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
              if (this.listOfPlayerWords.length == 2) {
                this.resetTimer();
                this.finishedWithVowel();
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
      this.nextLetter = this.alphabet[getNextLetterIndex];
      this.$refs.randomLetter.textContent = this.nextLetter.toUpperCase();
      // this.playQuiz();
      this.$refs.computerWord.textContent = "Let's go!";
    },

    

    resetTimer() {
      clearInterval(this.myTimer);
      this.timer = 10;
    },

    finishedWithVowel() {
      this.vowelIndex += 1;
      this.listOfPlayerWords = [];
      this.listOfComputerWords = [];
      this.letter = this.vowels[this.vowelIndex];
      this.openModal();
      if (this.vowelIndex == 4) {
        this.endLevel();
      }

    },

    endLevel() {
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

      this.nextLevel();
    },

    checkWord(word){
      var check = 0;
for (var i = 0; i <this.wordLength; i++) {
            if (word.charAt(i) === this.letter) {
              check += 1;
            }
          }
          if (check >= 2) {
            this.sendWord();
          } else {
            this.gameOver();
          }
    },
    
    verifyConditionsAreMet(word) {
      if (word.length == this.wordLength) {
      switch (this.level) {
        case 1:
          this.checkWord(word);
          
          break;
        case 2:
          this.checkWord(word);
          break;
        case 3:
          this.checkWord(word);
          break;
        case 4:
          this.checkWord(word);
          break;
        case 5:
          this.checkWord(word);
          break;
        default:
      }
      } else {
        this.gameOver();
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

    proceedToNextChallenge() {
      var next = parseInt(this.wordLength) + 1;
      location.href = "/words/" + next;
    },

    openModal(){
      this.$refs.finish.style.width = "100%";
      
    },

    closeModal() {
      this.$refs.finish.style.width = "0%";
      this.resetTimer();
      this.startTimer()
    }

  },
};
</script>
