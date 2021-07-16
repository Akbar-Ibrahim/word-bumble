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
      <div v-if="isDone == true" class="w3-container w3-center w3-margin">
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
          {{ score }}/20
          </div>
      </div>
      <div class="">
        <div class="">
          <div class="w3-center" ref="playAgain" style="display: none">
            <game-over></game-over>
          </div>

          <div ref="gameContainer" class="">
            <div class="w3-container">
              <div style="font-size: 21px" class="w3-center" ref="myWord"></div>
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
        <div class="w3-center" ref="answer" style="display: none;"> Answer <span></span></div>
        <div>
          <h4 class="w3-center">Definition</h4>
          <div class="w3-center">{{ definition }}</div>
        </div>
        <div v-if="synonyms">
          <h4 class="w3-center">Synonyms</h4>
          <div v-for="(synonym, i) in synonyms" :key="i">
            <div class="w3-center">{{ synonym }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [],

  data() {
    return {
      words: [],
      word: "",
      score: 0,
      isDone: false,
      level: 1,
      rules: "Word redacted. Definition and synonyms given. Guess the word",
      listOfPlayerWords: [],
      computer: "",
      timer: 10,
      definition: "",
      synonyms: [],
    };
  },

  created() {
    this.fetchWords();
  },

  mounted() {},

  methods: {
    fetchWords() {
      let url = "api/word-definition";
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          // console.log(result);
          this.words = result;

          console.log(result);
        });
    },

    getRandomWord() {
      var getWord = Math.floor(Math.random() * this.words.length + 1);
      var result = this.words[getWord - 1];
      this.word = result.word;
      this.$refs.answer.textContent = result.word;

      this.$refs.myWord.textContent = "Begins with " + result.word.charAt(0);

    
      this.words.splice(getWord, 1);

      return this.word;
    },

    fetchWordData() {
      var word = this.getRandomWord();
      var myword = [];

      let url = "https://api.dictionaryapi.dev/api/v2/entries/en_US/" + word;
      fetch(url)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          // console.log(result);
          this.definition = result[0].meanings[0].definitions[0].definition;
          this.synonyms = result[0].meanings[0].definitions[0].synonyms;
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
      this.fetchWordData();

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
      this.$refs.word.value = "";
    },

    resetTimer() {
      clearInterval(this.myTimer);
      this.timer = 10;
    },

    endLevel() {
      this.listOfPlayerWords = [];
      this.rules = "";

      this.$refs.congrats.style.display = "block";
      this.$refs.gameWrapper.style.display = "none";
    },

    nextLevel() {},

    verifyConditionsAreMet(word) {
      if (word.toLowerCase() === this.word) {
        this.$refs.word.value = "";
        this.score += 1;
        this.fetchWordData();
        this.resetTimer();
      } else {
        this.gameOver();
        this.$refs.answer.style.display = "block";
      }
    },

    gameOver() {
      this.$refs.playAgain.style.display = "block";
      this.$refs.gameContainer.style.display = "none";
      this.timer = 0;
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
