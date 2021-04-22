<template>
    <div :class="$options.name" class="wrap" >
      <h1>New Block</h1>

      <p>
        <label class="text-input-label" for="input-block-name">Block Title:</label>
        <input type="text" id="input-block-name" v-model="blockTitle" />
      </p>

      <p>
        <label class="text-input-label" for="input-api-count">Use APIs:</label>
        <input type="number" min=0 step=1 id="input-api-count" v-model.number="apiCount"  />
      </p>


      <div class="flex api-request-row" v-for="api in apiList" :key="'apiInput' + api.index">

        <div>
          <label class="text-input-label" :for="'input-api-name' + api.index" >API Name:</label>
          <input type="text" class="input-api-name" :id="'input-api-name' + api.index" v-model="api.title"  @keydown="apiTitleKeyDown"  @blur="blurTitle($event, api)" :data-index="api.index"/>
        </div>


        <div>
          <label class="text-input-label" :for="'input-api-url' + api.index" >API URL:</label>
          <input type="text" class="input-api-url" :id="'input-api-url' + api.index" v-model="api.url" :placeholder="restURL + ' ...'" @blur="loadAPI" :data-index="api.index"/>
        </div>

        <div>
          <label class="text-input-label" :for="'input-api-nonce' + api.index" >Nonce:</label>
          <input type="text" class="input-api-nonce" :id="'input-api-nonce' + api.index" placeholder="wp-rest" v-model="api.nonce" @blur="loadAPI" :data-index="api.index"/>
        </div>

      </div>

      <hr />

      <div class="flex editor-row">
        <textarea id="editor" v-model="blockContent" :placeholder="exampleContent" ></textarea>
        <div class="json-container">
          <div v-for="api in apiList" :key="'response' + api.index">
            <JsonTreeViewer :key="api.key" v-if="apiConfigValid(api) && api.response!==null" :value="api.response" :options="getOptions(api)" />
          </div>
        </div>
      </div>

      <button class="button button-primary" :class="classSaved" v-shortkey.push="['ctrl', 's']" @shortkey="saveBlock"  @click="saveBlock" @keypress.enter="saveBlock" :disabled="!canSave">Save Block</button>
      
    </div>
</template>

<script>
import Vue from 'vuejs';
import Axios from 'axios';
import JsonTreeViewer from "vue-json-tree-viewer"
import Shortkey from 'vue-shortkey'
import ListTable from 'vue-wp-list-table';
import hash from 'object-hash'

export default {
  name: 'admin-new-block',
  components: {
    
  },
  beforeMount: function() {
    Vue.use(JsonTreeViewer)
    Vue.use(Shortkey)
  },
  props: {
      
  },
  data: function(){
      return {
         api: Axios.create({
          baseURL: localURLs.rest,
          headers: {
              'content-type': 'application/json',
              'X-WP-Nonce': nonce
          },
        }),
        blockId: -1,
        blockTitle: '',
        blockContent: '',
        apiCount: 0,
        _apiList: [],
        restURL: localURLs.rest,
        classSaved: ''
      }
  },
  computed: {
    exampleContent: function() {
      if (this.apiList.length > 0 && this.apiConfigValid(this.apiList[0])) {
        return `<div :class="${this.apiList[0].title}.classNameExample" >{{ ${this.apiList[0].title}.valueExample }}</div>`
      }
      return `<div>Lorem ipsum dolor ....</div>`
      
    },
    apiList: function() {
      let results = []
      for (let i=0; i < this.apiCount; i++) {
        if (i < this.$data._apiList.length) {
          results.push(this.$data._apiList[i])
        } else {
          results.push({
            index: i,
            title: '',
            url: localURLs.rest,
            nonce: 'wp-rest',
            response: null,
            key: hash(i)
          })
          Vue.set(results[i], 'response')
        }
      }
      this.$data._apiList = results
      return results
    },
    canSave: function() {
      if (this.blockTitle.trim()=='') {
        return false
      }

      for(let api of this.apiList){
        if(!this.apiConfigValid(api)) {
          return false
        }
      }

      if (this.blockContent.trim()==''){
        return false
      }

      return true
    }
  },
  methods: {
    getOptions: function(api) {
      return {rootKeyName: api.title}
    },
    apiTitleKeyDown: function($event) {
      this.$forceUpdate();
      if (!/^[a-zA-Z]+[0-9]*[a-zA-Z]*$/.test($event.target.value + $event.key)){
        $event.preventDefault();
      }
    },
    apiConfigValid: function(data) {
      if ( data.title == '' || !/^(http|https):\/\/[^ "]+$/.test(data.url))
        return false
      return true
    },
    loadAPI: function($event){
      let data = this.apiList[parseInt($event.target.getAttribute('data-index'))]

      if (this.apiConfigValid(data)) {
        this.api.get(data.url).then(response => {
          Vue.set(data, 'response', response.data)
          Vue.set(data, 'key', this.hash(data))
        })
      } 
    },

    saveBlock: function(event) {

      if (!this.canSave) {
        return
      }

      this.classSaved = 'saved-recently';

      setTimeout(() => {
        this.classSaved = ''
      }, 5000)

      if (this.blockId == -1) {
        this.api.post('rest-blocks/v1/block/', {
          title: this.blockTitle,
          apis: this.apiList,
          content: this.blockContent
        }).then(response => {
            this.blockId = response.data
        })
      } else {
        this.api.put(`rest-blocks/v1/block/${this.blockId}`, {
          title: this.blockTitle,
          apis: this.apiList.map(api => {
            return {
              title: api.title,
              url: api.url,
              nonce: api.nonce
            }
          }),
          content: this.blockContent
        }).then(response => {
          console.log(response)
        })
      }
      
    },
    blurTitle: function($event, api) {
      Vue.set(api, 'key', this.hash(api))
    },
    hash: function(object) {
      return hash.sha1(object)
    }
  },
}
</script>

<style>

  @keyframes saveAnimation {
    0% {
      background-color:#2271b1;
      color:#FFFFFF;
    } 
    100% {
      background-color:#eaeaea;
      color:#2271b1;
    } 
  }

  #wpcontent {
    min-height: 95vh;
  }

  #wpbody-content {
    height: 70vh;
  }

  :is(#wpbody, .wrap) {
    height: 100%;
  }

  .flex {
    display: flex;
    gap: 2rem;
  }

  .flex > * {
    width: 100%;    
  }

  hr {
    margin: 1.5rem 0;
  }

  .api-request-row {
    margin: 1rem 0;
  }

  .text-input-label {
    width: 10ch;
    display: inline-block;
    font-weight: 700;
  }

  label + input[type='text'] {
    width: calc(100% - 10rem)
  }

  #editor {
    height: 100%;
    margin-bottom:3rem;
  }

  .editor-row {
    margin-top:1rem;
    height: 100%;
    padding-bottom: 1rem;
  }

 .json-tree-container {
    margin-bottom:1rem;
  }

  #wpfooter {
    display:none;
  }

  .button-primary {
    padding-bottom: 2rem;
  }
  
  .button.button-primary.saved-recently {
    box-shadow: 0rem 0rem 0rem 0.2rem #eaeaea, 
                0rem 0rem 0rem 0.3rem #2271b1;
    animation-duration: 2s;
    animation-name: saveAnimation;
    animation-iteration-count: infinite;
    animation-direction: alternate;
  }

</style>
