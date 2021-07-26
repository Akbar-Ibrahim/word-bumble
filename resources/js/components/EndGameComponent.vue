<template>
    <button @click="endGame" class="w3-right w3-win8-lime w3-lime w3-hover-amber w3-text-white">
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
