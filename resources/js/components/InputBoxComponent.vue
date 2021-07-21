<template>
<div class="">
  <div class="d-flex">
    <div class="flex-grow-1">
      <input
        ref="word"
        type="text"
        name="word"
        class="form-control input-sm"
        placeholder="Enter your word here..."
        @keyup.enter="checkBeforeSending"
        autocomplete="off"
      />
    </div>
    <div>
      <span class="input-group-btn" style="border: none">
        <button @click="checkBeforeSending" type="submit" class="btn btn-default go-button">
          <!-- <span class="glyphicon glyphicon-search"></span> -->
          Go
        </button>
      </span>
    </div>
  </div>

  <!-- Controls -->

  <div class="d-flex" style="margin-top: 20px;">
    <div class="flex-fill">
    <end-game></end-game>
    </div>
    <div class="flex-fill">
    <button @click="restart">Restart Game</button>
    </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    // console.log("Component mounted.");
  },

  methods:{
      checkBeforeSending(){
          var inputValue = this.$refs.word.value.trim();
          var word = inputValue.toLowerCase();

          this.$emit('input-value', word);

          this.$refs.word.value = "";

      },

      restart() {
        location.href = location.href;
      }
  },
};
</script>
