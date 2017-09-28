require('./bootstrap');

window.Vue = require('vue');
window.Bus = new Vue({name: 'Bus'});

import VueRouter from 'vue-router';
Vue.use(VueRouter);

Vue.component('testimonials-list', require('./components/TestimonialsList.vue'));
Vue.component('vue-alert', require('./components/Alert.vue'));

const router = new VueRouter({
    routes: [
        {
            path: '/',
            component: require('./pages/Testimonials.vue')
        },
        {
            path: '/testimonials/add',
            component: require('./pages/AddTestimonial.vue')
        },
        {
            path: '/testimonials/edit/:id',
            component: require('./pages/AddTestimonial.vue')
        }
    ]
});

const app = new Vue({
    el: '#app',
    router
});
