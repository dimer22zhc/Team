<template>
  <a-modal :width="480" :footer="false" :destroyOnClose="true" :closable="false" :maskClosable="false" v-model="$store.state.layout.visibleCreateChannel">
    <create-channel @closeCreateChannel="createChannel=$event" v-if="!createChannel"/>
    <!-- end -->
  </a-modal>
</template>
<script>
import Form from 'vform'
import axios from 'axios'
export default {
  name: "CreateChannelModal",
  data: () => ({
    form: new Form({
      email: '',
      name: ''
    }),
    size: 'small',
    createChannel :false,
    members: [],
  }),
}

</script>
<style lang="css" scoped>
.animation hover {
  transition: 1s
}

</style>
