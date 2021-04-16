import Vue from 'vuejs';
import Axios from 'axios'
import AdminAllBlocks from './admin-all-blocks.vue';
import AdminNewBlock from './admin-new-block.vue';

document.addEventListener('DOMContentLoaded', function() {

    window.app = new Vue({
        el: '.rest-blocks-admin',
        components: {
            'admin-all-blocks': AdminAllBlocks,
            'admin-new-block': AdminNewBlock
        },
        data: {
            api: Axios.create({
                baseURL: localURLs.rest,
                headers: {
                    'content-type': 'application/json',
                    'X-WP-Nonce': nonce
                },
            }),
        },
        mounted() {


        },
        methods: {

        }
    })

})