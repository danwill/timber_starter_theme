console.log('Built by Mechanic');

require('./utils/polyfills.js');

import Vue from 'vue';

Vue.component('my-component', require('./components/MyComponent.vue'));

new Vue({
    el: '#app',
});
