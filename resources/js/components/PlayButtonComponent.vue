<template>
    <button @click="play" class="w3-button w3-border w3-black w3-text-white w3-hover-amber" style="width: 100%; color: white;">
        Play
    </button>
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
