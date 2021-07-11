<template>
    <div class="w3-container">
        <div>
          <h4 class="w3-center">Word tally</h4>
        </div>
        <div style="overflow: scroll; height: 400px">
          <div class="w3-container">
            
            <div class="w3-center">
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
        props: ["listOfPlayerWords"],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
