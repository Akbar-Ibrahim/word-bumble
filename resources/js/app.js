/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('last-letter', require('./components/LastLetterComponent.vue').default);
Vue.component('word-length', require('./components/WordLengthComponent.vue').default);

Vue.component('rules', require('./components/RulesComponent.vue').default);
Vue.component('word-tally', require('./components/WordTallyComponent.vue').default);
Vue.component('game-over', require('./components/GameOverComponent.vue').default);
Vue.component('nth-position', require('./components/NthPositionComponent.vue').default);
Vue.component('vowel-unclustered', require('./components/VowelUnclusteredComponent.vue').default);
Vue.component('consonant-unclustered', require('./components/ConsonantUnclusteredComponent.vue').default);
Vue.component('begin-end', require('./components/BeginAndEndComponent.vue').default);
Vue.component('single-player-tally', require('./components/SinglePlayerTallyComponent.vue').default);

// Modal
Vue.component('modal', require('./components/ModalComponent.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
