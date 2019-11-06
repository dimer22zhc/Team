<template>
  <a-modal :width="700" :footer="false" :destroyOnClose="true" :closable="false" :maskClosable="false" 
  :visible="false">
    
  </a-modal>
</template>
<script>
  import CodeMirror from 'codemirror'
export default {
  props: { visible: { type: Boolean } },
  name: "CodeSnippet",
  data: () => ({
    html: '',
    show: false,
  }),
  methods: {
    createPost() {
      
    }
  },
  mounted(){
  }
}
// 4*sBj6ARUPh3Tr$
</script>
