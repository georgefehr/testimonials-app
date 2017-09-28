<template>

    <div class="alert" :class="type" v-if="alertShow">
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
            getTestimonials() {
                axios.get('/api/testimonials')
                    .then(response => {
                        this.testimonials = response.data;
                    });
            }
        },
        mounted() {
            Bus.$on('alert', data => {
                console.log(data);
                this.type = 'alert-' + data.type;
                this.text = data.text;
                this.alertShow = true;
            })
        }
    }
</script>
