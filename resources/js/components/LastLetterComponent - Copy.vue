<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            The begining is the end. The end is the begining.
          </div>
          <h1>{{ timerCount }}</h1>
          <div
            class="w3-container w3-center"
            ref="playAgain"
            style="display: none"
          >
            <h4>Game over!</h4>
            <div>You suck! :)</div>
            <button @click="playAgain" class="w3-button">Play Again</button>
          </div>

          <div v-for="(w, i) in myWords" :key="i">
            <div>{{ w.word }}</div>
          </div>

          <div ref="gameContainer">
            <div class="w3-container w3-padding">
              <div style="font-size: 21px" class="w3-center" ref="computerWord">
                Come on, show me what you got!
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

          <div class="d-flex">
            <div class="flex-fill">
              <div v-for="(w, i) in computerWords" :key="i">
                <div>{{ w.word }}</div>
              </div>
            </div>
            <div class="flex-fill">
              <div v-for="(w, i) in playerWords" :key="i">
                <div>{{ w }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["words"],

  data() {
    return {
      myWords: JSON.parse(this.words),
      computerWords: [],
      playerWords: [],
      computer: "",
      timerCount: 10,
    };
  },

  created() {},

  mounted() {},

  //   watch: {
  //     timerCount: {
  //       handler(value) {
  //         if (value > 0) {
  //           setTimeout(() => {
  //             this.timerCount--;
  //           }, 1000);
  //         } else {
  //           this.$refs.playAgain.style.display = "block";
  //           this.$refs.gameContainer.style.display = "none";
  //         }
  //       },
  //       immediate: true, // This ensures the watcher is triggered upon creation
  //     },
  //   },

  methods: {
    playAgain() {
      location.href = "/begining/end";
    },

    checkBeforeSending() {
      var word = this.$refs.word.value;

      if (this.computer.length > 0) {
        var lengthOfComputerWord = this.computer.length - 1;

        if (this.computer.charAt(lengthOfComputerWord) === word.charAt(0)) {
          if (this.computerWords.length > 0 && this.playerWords.length > 0) {
            this.checkIfWordAlreadyExists(word);
          }
          this.checkMyWords(word);
          
        } else {
          alert("you lose");
        }
      } else {
        this.checkMyWords(word);
      }
    },

    checkMyWords(word) {
      var check = 0;
      for (var i = 0; i < this.myWords.length; i++) {
        if (word === this.myWords[i].word) {
          check = check + 1;
          this.playerWords.push(this.myWords[i].word);
          this.myWords.splice(i, 1);
          break;
        }
      }

      this.$refs.word.value = "";

      if (check > 0) {
        // alert("game over");
        this.computerChoice(word);
      } else {
        this.sendWord(word);
      }
    },

    computerChoice(word){
      var lengthOfPlayerWord = word.length - 1;
      var check = this.myWords.length;
      for (var i = 0; i < this.myWords.length; i++){
          if (word.charAt(lengthOfPlayerWord) === this.myWords[i].word.charAt(0)) {
              this.$refs.computerWord.textContent = this.myWords[i].word;
              this.computer = this.myWords[i].word;
              this.computerWords.push(this.myWords[i]);
              
        break;
      } else {
        check = check - 1;
      }
      }

      if (check = 0) {
        this.sendWord(word);
      }
    },

    sendWord(playerWord) {
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
              this.$refs.computerWord.textContent = result.word;
              this.computer = result.word;
              this.computerWords.push(result);
              this.playerWords.push(playerWord);
            } else {
              alert("not a word");
            }
          });
      }
      this.$refs.word.value = "";
    },

    checkIfWordAlreadyExists(word) {
      var check = 0;
      for (var i = 0; i < this.computerWords.length; i++) {
        if (word === this.computerWords[i].word) {
          check = check + 1;
        }
      }

      for (var i = 0; i < this.playerWords.length; i++) {
        if (word === this.playerWords[i]) {
          check = check + 1;
        }
      }

      if (check > 0) {
        this.$refs.playAgain.style.display = "block";
        this.$refs.gameContainer.style.display = "none";
      }
    },
  },
};
</script>
