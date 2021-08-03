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
                    {{ wordTotal }}
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
                            <div
                                style="font-size: 21px"
                                class="w3-center"
                                ref="computerWord"
                            >
                                Let's go!
                            </div>
                        </div>

                        <div class="card-body">
                            <!--  -->
                            <input-box
                                @input-value="checkBeforeSending"
                            ></input-box>
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
                "You have 10 seconds on the clock. You will be shown 3 letter words. Form a 3 letter word with every letter in the word. Your first word must not be the word you are shown. The words you enter must be in the order of the letters in the word shown to you.",
            level: 1,
            listOfPlayerWords: [],
            playerWords: [],
            wordLength: 3,
            wordTotal: 0,
            letter: "",
            letterIndex: 0,
            computer: "",
            timer: 10,
            myTimer: null,
            total: 10
        };
    },

    created() {},

    mounted() {
        this.fetchWord();
    },

    methods: {
        fetchWord() {
            let url = "api/get-word/" + this.wordLength;
            fetch(url)
                .then(response => {
                    return response.json();
                })
                .then(result => {
                    // console.log(result);
                    this.computer = result[0].word;
                    this.$refs.computerWord.textContent = this.computer;
                    this.wordLength = result[0].word.length;
                    this.letter = result[0].word.charAt(0);

                    // console.log(result);
                });
        },

        startTimer() {
            this.myTimer = setInterval(() => {
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

            this.startTimer();
        },

        playAgain() {
            location.href = "/begining/end";
        },

        checkBeforeSending(word) {
            if (this.letterIndex > 0) {
                if (word.charAt(0) === this.letter) {
                    if (this.wordLength == word.length) {
                        this.checkIfWordAlreadyExists(word);
                    } else {
                        this.gameOver();
                    }
                } else {
                    this.gameOver();
                }
            } else {
                if (word.charAt(this.letterIndex) === this.letter) {
                    if (
                        word === this.computer ||
                        this.wordLength !== word.length
                    ) {
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
                word: word
            };

            data = JSON.stringify(data);

            if (word) {
                fetch("/api/every-letter", {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: data
                })
                    .then(response => {
                        return response.json();
                    })
                    .then(result => {
                        console.log(result);
                        if (result.length > 0) {
                            this.listOfPlayerWords.push(word);
                            this.playerWords.push(word);
                            // this.score += 1;
                            // this.resetTimer();
                            if (this.playerWords.length == this.wordLength) {
                                // this.listOfPlayerWords = [];
                                this.wordTotal += 1;
                                this.playerWords = [];
                                this.letter = "";
                                this.letterIndex = 0;
                                this.resetTimer();

                                if (this.wordTotal == this.total) {
                                    this.stopTimer();
                                    this.endLevel();
                                    this.fetchWord();
                                } else {
                                    this.fetchWord();
                                }
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

        endLevel() {
            this.wordTotal = 0;
            this.listOfPlayerWords = [];
            this.playerWords = [];
            this.wordLength += 1;
            this.level += 1;

            if (this.level == 2) {
                this.timer = 20;
            } else if (this.level == 3) {
                this.timer = 30;
            } else if (this.level == 4) {
                this.timer = 40;
            } else if (this.level == 5) {
                this.timer = 50;
            } else if (this.level == 6) {
                this.timer = 60;
            }

            if (this.level == 7) {
                this.$refs.congrats.style.display = "block";
                this.$refs.gameWrapper.style.display = "none";
            } else {
                this.$refs.rules.style.display = "block";
                this.$refs.gameWrapper.style.display = "none";
            }
            this.rules =
                "You have " +
                this.timer +
                " seconds on the clock. You will be shown " +
                this.wordLength +
                "  letter words. Form a " +
                this.wordLength +
                " letter word with every letter in the word. Your first word must not be the word you are shown. The words you enter must be in the order of the letters in the word shown to you.";
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

        stopTimer() {
            clearInterval(this.myTimer);
            this.timer = 10;
        },

        resetTimer() {
            clearInterval(this.myTimer);
            switch (this.level) {
                case 1:
                    this.timer = 10;
                    break;

                case 2:
                    this.timer = 20;
                    break;

                case 3:
                    this.timer = 30;
                    break;

                case 4:
                    this.timer = 40;
                    break;

                case 5:
                    this.timer = 50;
                    break;

                case 6:
                    this.timer = 60;
                    break;

                default:
            }

            this.startTimer();
        },

        gameOver() {
            this.$refs.playAgain.style.display = "block";
            this.$refs.gameContainer.style.display = "none";
        }
    }
};
</script>
