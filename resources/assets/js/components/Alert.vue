<template>

    <div class="alert" :class="type" v-if="alertShow">
        <button type="button" class="close" @click="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ text }}
    </div>

</template>

<script>
    export default {
        data() {
            return {
                type: '',
                text: '',
                alertShow: false
            }
        },
        methods: {
            close() {
                this.alertShow = false;
            }
        },
        mounted() {
            Bus.$on('alert', data => {
                this.type = 'alert-' + data.type;
                this.text = data.text;
                this.alertShow = true;
            })
        }
    }
</script>
