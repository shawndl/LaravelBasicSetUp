<template>
    <fade-out-animation>
        <div class="message-container" v-if="showMessage">
            <div :class="classes">
                <button type="button"
                        class="close pull-right"
                        @click="close()">&times;</button>
                <strong>{{ title }}:</strong> {{ message }}
            </div>
        </div>
    </fade-out-animation>
</template>

<script>
    export default {
        props: ['message', 'type', 'title'],

        data : function() {
            return {
                showMessage : true
            }
        },

        mounted() {
            setTimeout(() => this.showMessage = false, 5000)
        },

        computed: {
            classes() {
                return ['alert', 'alert-' + this.type]
            }
        },

        methods: {
            close() {
                this.showMessage = false;
            }
        }
    }
</script>

<style scoped>
    .message-container {

    }
</style>



