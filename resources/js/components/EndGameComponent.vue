<template>
    <button @click="endGame" class="w3-right w3-green w3-hover-amber w3-text-white" style="color: white;">
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
