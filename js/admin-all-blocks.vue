<template>
    <div :class="$options.name" class="wrap">
      <h1>All Blocks</h1>
      <wp-list-table
        :columns="{
          'id': { label: 'Id' },
          'title': { label: 'Title' },
          'num_apis': { label: 'Connected APIs' }
        }"
        :rows="blocks"
        :actions="[
          {
            key: 'delete',
            label: 'Delete'
          }
        ]"
        action-column="title"
        :bulk-actions="[ 
        {
            key: 'delete',
            label: 'Move to Trash'
        }]"
        @action:click="performAction"
      ></wp-list-table>
    </div>
</template>

<script>
import Vue from 'vuejs';
import ListTable from 'vue-wp-list-table';
import Axios from 'axios';

export default {
  name: 'admin-all-blocks',
  components: {
      'wp-list-table': ListTable
  },
  props: {
   
  },
  emits: [],
  data: function() {
    return {
      api: Axios.create({
          baseURL: localURLs.rest,
          headers: {
              'content-type': 'application/json',
              'X-WP-Nonce': nonce
          },
        }),
        blocks: [],
        
    }
  },
  beforeMount: function() {

    this.api.get('rest-blocks/v1/blocks/').then(response => {
      this.blocks = response.data
    })

  },
  watch: {
   
  },
  computed: {

  },
  methods: {
     performAction: function(action, row){
       
       if (action == 'delete') {
         this.api.delete(`rest-blocks/v1/block/${row.id}`).then(response => {
           this.blocks = this.blocks.filter(block => {
             return block.id !== row.id
           })
         })
       }
     }
  }
  
}
</script>

<style>
    .column.id {
      width: 8rem;
    } 
</style>
