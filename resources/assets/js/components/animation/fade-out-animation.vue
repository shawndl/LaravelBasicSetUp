<template>
    <transition name="fade">
        <slot></slot>
    </transition>
</template>

<script>
    export default {

    }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity 1s
    }
    .fade-enter, .fade-leave-to  {
        opacity: 0
    }
</style>