<template>
    <button @click="endGame" class="w3-right w3-win8-lime w3-hover-orange">
        Go Home
    </button>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            endGame() {
                location.href = "/";
            }
        }
    }
</script>
