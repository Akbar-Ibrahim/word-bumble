<template>
    <button @click="play" class="w3-button w3-border w3-win8-lime w3-text-white w3-hover-orange" style="width: 100%">
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
