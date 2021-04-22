import Vue from 'vuejs';
import Axios from 'axios';
import FrontEndBlockComponent from './blocks-frontend.vue';

document.addEventListener('DOMContentLoaded', function() {



    Array.from(document.querySelectorAll('.rest-blocks-frontend')).forEach(componentBlock => {
        
        window.app = new Vue({
            el: `#${componentBlock.id}`,
            components: {
                'rest-template-block': FrontEndBlockComponent
            },
        }) 

    })

    

})