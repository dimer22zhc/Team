<template>
  <div class="flex items-center rounded-lg border-2 border-grey overflow-hidden">
    <span class=" cursor-pointer hover:bg-green-600 hover:text-white text-3xl text-grey border-r-2 border-grey p-2">
      <svg class="fill-current h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z"></path>
      </svg>
    </span>
    <textarea ref="reply" id="reply" name="textarea" @keyup.enter="createThread" style="resize: none" 
    class="w-full px-4 py-2  overflow-hidden  focus:outline-none" placeholder="Add Reply"></textarea>
  </div>
</template>
<script>
import axios from 'axios'
import $ from 'jquery'
import Form from 'vform'
export default {
  props: { thread: { type: Object } },
  name: "ReplyInput",
  data: () => ({
    form: new Form({
      body: ''
    })
  }),
  methods: {
    async createThread() {
      this.$store.dispatch('threads/createReply', {
        body: this.$refs.reply.value,
        threadId: this.thread.id,
      })
    },
  }
}

</script>
