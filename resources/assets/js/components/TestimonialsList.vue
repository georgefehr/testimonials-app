<template>

<div class="testimonials-list">
    <add-testimonial @testimonial-saved="getTestimonials"></add-testimonial>

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
            <td><add-testimonial edit-testimonial="t"></add-testimonial></td>
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
            }
        }, 
        mounted() {
            this.getTestimonials();
        }
    }
</script>
