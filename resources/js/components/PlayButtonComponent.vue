<template>
<div class="w3-container w3-border w3-border-white" style="margin-bottom: 50px; ">
    <button @click="play" class="w3-button w3-green w3-text-white w3-hover-amber" style="width: 100%; color: white;">
        Play
    </button>
    </div>
</template>

<script>
    export default {
        props: ["route"],
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            play() {
                location.href = this.route;
            }
        }
    }
</script>
