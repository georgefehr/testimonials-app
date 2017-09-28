<template>

<div class="testimonials-list">

    <router-link to="/testimonials/add/" class="btn btn-primary">Add Testimonial</router-link>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="t in testimonials">
            <td>{{ t.name }}</td>
            <td>
                <router-link class="btn btn-primary  btn-xs" :to="'/testimonials/edit/' + t.id">Edit</router-link>
                <a @click.prevent="deleteTestimonial(t.id)" class="btn btn-danger btn-xs">Delete</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>

</template>

<script>
    export default {
        data() {
            return {
                testimonials: []
            }
        },
        methods: {
            getTestimonials() {
                axios.get('/api/testimonials')
                    .then(response => {
                        this.testimonials = response.data;
                    });
            },
            deleteTestimonial(id) {
                axios.delete('/api/testimonials/' + id)
                    .then(response => {
                        this.getTestimonials();
                        Bus.$emit('alert', {text: 'Testimonial deleted.', type: 'success'});
                    });
            }
        }, 
        mounted() {
            this.getTestimonials();
        }
    }
</script>
