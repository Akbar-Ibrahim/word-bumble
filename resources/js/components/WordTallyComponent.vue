<template>
    <div class="">
        <div>
          <h4 class="w3-center">Word tally</h4>
          <div class="d-flex w3-center">
            <div class="flex-fill">Computer</div>
            <div class="flex-fill">You</div>
          </div>
        </div>
        <div style="overflow: scroll; height: 400px">
          <div class="d-flex">
            <div class="flex-fill w3-center">
              <div v-for="(w, i) in listOfComputerWords" :key="i">
                <div class="w3-border">{{ w.word }}</div>
              </div>
            </div>
            <div class="flex-fill w3-center">
              <div v-for="(w, i) in listOfPlayerWords" :key="i">
                <div class="w3-border">{{ w }}</div>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["listOfComputerWords", "listOfPlayerWords"],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
