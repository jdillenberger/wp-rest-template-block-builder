<template>
  <div v-if="ready">
      <v-runtime-template :template="'<div>' + blockContent + '</div>'"></v-runtime-template>
  </div>
</template>

<script>
import Axios from 'axios';
import Vue from 'vuejs';
import VRuntimeTemplate from 'v-runtime-template'


export default {
  name: 'rest-template-block',
  props: {
    blockId: String/Number
  },
  components: {
    'v-runtime-template': VRuntimeTemplate
  },
  data() {
    return {
      blockTitle: '',
      restAPIs: [],
      blockContent: '',
      api: Axios.create({
          baseURL: localURLs.rest,
          headers: {
              'content-type': 'application/json',
              'X-WP-Nonce': nonce
          },
      }),
      _ready: false
    }
  },
  beforeMount() {
    
    this.api.get(`rest-blocks/v1/block/${this.blockId}`).then(response => {
      this.blockTitle = response.data.title
      this.blockContent = response.data.content,
      this.restAPIs = response.data.apis.map(api => {
        api.finished = false
        return api
      })


      this.restAPIs.forEach(api => {
        Axios.create({
          headers: {
            'content-type': 'application/json',
            'X-WP-Nonce': nonce
          },
        }).get(api.url).then(response => {
          this.$data[api.title] = response.data
          api.finished = true
        })
      });
      
    })
  },
  computed: {
    ready: function() {
      
      if (this.blockTitle == ''){
        return false
      }

      if (this.blockContent == '') {
        return false
      }

      for (let api of this.restAPIs){
        if(!api.finished){
          return false
        }
      }
      return true

    }
  } 

}
</script>


<style>

</style>