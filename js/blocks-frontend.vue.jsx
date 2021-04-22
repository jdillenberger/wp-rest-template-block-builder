import Vue from 'vuejs';
import Axios from 'axios';
import FrontEndBlockComponent from './blocks-frontend.vue';

document.addEventListener('DOMContentLoaded', function() {

    window.app = new Vue({
        el: '.rest-blocks-frontend',
        components: {
            'rest-template-block': FrontEndBlockComponent
        },
    }) 

})