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
            section: section
        },
        mounted() {
            
        },
        methods: {

        },
        render: function(h) {
            switch (this.section) {
                case 'allBlocks':
                    return <admin-all-blocks />
                case 'newBlock':
                    return <admin-new-block />
                default:
                    return <p><strong>ERROR:</strong> There is no section defined.</p>

            }
        

            
        }
    }) 

})