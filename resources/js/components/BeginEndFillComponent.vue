<template>
  <div class="">
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
        "You'll be shown two letters, your goal is to enter a word that begins with the first letter and ends with the second letter",
      level: 1,
      listOfPlayerWords: [],
      letters: ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'],
      firstLetter: "",
      lastLetter: "",
      computer: "",
      timer: 10,
    };
  },

  created() {},

  mounted() {
    
  },

  methods: {
    getLetters() {

      var getFirstLetterIndex = Math.floor(Math.random() * this.letters.length + 1);
      this.firstLetter = this.letters[getFirstLetterIndex];

      var getLastLetterIndex = Math.floor(Math.random() * this.letters.length + 1);
      this.lastLetter = this.letters[getLastLetterIndex];
      if (this.lastLetter === 'j' || this.lastLetter === 'q' || this.lastLetter === 'u' || this.lastLetter === 'v') {
        this.getLetters();
      } 
      this.computer = this.firstLetter.toUpperCase();
      this.computer = this.computer + this.lastLetter.toUpperCase();
      this.$refs.computerWord.textContent = this.computer;
              
    },

    fetchWords() {
      let url = "/api/get-words/" + this.firstLetter + "/" + this.lastLetter;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          // console.log(result);
          this.listOfPlayerWords = [];
          for (var i = 0; i < result.length; i++) {
            this.listOfPlayerWords.push(result[i].word);
          }
          

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

      this.getLetters();

      this.resetTimer();
      this.startTimer();
    },

    playAgain() {
      location.href = "/begining/end";
    },

    checkBeforeSending(word) {
      var lengthOfWord = word.length - 1;
      
        if (word.charAt(0) === this.firstLetter && word.charAt(lengthOfWord) === this.lastLetter) {
              this.sendWord(word);
          } else {
            this.fetchWords();
            this.gameOver();
          } 

      
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
              this.getLetters();
              this.resetTimer();
              if (this.listOfPlayerWords.length == 50) {
                this.resetTimer();
                this.endLevel();
              } else {
                // this.getComputerWords(result);
                
              }
            } else {
              this.fetchWords();
              this.gameOver();
            }
          });
      }

    },

    endLevel() {
      this.listOfPlayerWords = [];
      // this.level += 1;
      // this.rules = "Mention words that have more than one vowel cluster. That is multiple vowels coming one after another";
      
      this.$refs.congrats.style.display = "block";
      this.$refs.gameWrapper.style.display = "none";
      
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
