
// Setup VueJs
import Vue from 'vue';

// Load global contrib components.
// import vSelect from "vue-select";
// Vue.component("v-select", vSelect);

// Load custom components
import Pager from './components/Pager';
Vue.component('pager', Pager);

import Search from './components/Search';
Vue.component('search', Search);

import MenuMobile from './components/MenuMobile';
Vue.component('menu-mobile', MenuMobile);

import project6 from './project6.js';

window.Vue = Vue;
window.axios = require('axios');

// Initionalize VueJS
new Vue({
  el: '#app',
  mixins: [project6]
});


