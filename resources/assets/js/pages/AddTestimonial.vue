<template>
    <div class="add-testimonials">
        <form @submit.prevent="save">
            <div class="form-group">
                <label for="testimonial-name">Name</label>
                <input type="text" class="form-control" id="testimonial-name" v-model="testimonial.name">
            </div>
            <div class="form-group">
                <label for="testimonial-comment">Comment</label>
                <textarea class="form-control" id="testimonial-comment" v-model="testimonial.comment"></textarea>
            </div>
            <div class="form-group">
                <router-link to="/" class="btn btn-default">Cancel</router-link>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                testimonial: {}
            }
        },
        methods: {
            save() {
                if(this.testimonial.id){
                    axios.put('/api/testimonials/' + this.testimonial.id, this.testimonial)
                        .then(response => {
                            this.$router.push('/');
                        });
                } else {
                    axios.post('/api/testimonials', this.testimonial)
                        .then(response => {
                            this.$router.push('/');
                        });
                }
            }
        },
        created() {
            if (this.$route.params.id) {
                axios.get('/api/testimonials/' + this.$route.params.id)
                    .then(response => {
                        this.testimonial = response.data;
                    });
            }
        }
    }
</script>
