<template>
  <div style="width: 35.3333%" class=" flex flex-col overflow-hidden">
    <div class="w-full bg-gray-200">
      <div class="flex px-4  py-2 justify-between items-center">
        <div class="leading-snug">
          <div class="font-extrabold">Thread</div>
          <div class="text-sm">
            {{$store.state.auth.user.name | name | capitalize}}
          </div>
        </div>
        <div>
          <router-link :to="{name:$route.name === 'p-thread' ? 'post' : 'channel'}">Close</router-link>
        </div>
      </div>
    </div>
    <a-spin :spinning="!Object.getOwnPropertyNames(thread).length" tip="Loading...">
      <div v-if="thread.owner" >
        <thread :thread="thread" :isThread="false" :isShareThread="false" :isSingleThread="true" />
      </div>
    </a-spin>
  </div>
</template>
<script>
import RightTopNav from '~/components/RightTopNav'
import Thread from '~/components/channel/threads/Thread'
export default {
  name: "Thread-View",
  data: () => ({
    threadReady: '',
    isLoading: false
  }),
  components: { RightTopNav, Thread },
  computed: {
    thread() {
      return this.$store.getters['threads/single_thread'](this.$route.params.thread_id)

    }
  },
  // beforeRouteLeave({from,to}){

  // },
  watch: {
    '$route.params.thread_id': function() {
      var self = this
      self.fetchSingleThread()
    }
  },
  mounted() {
    this.fetchSingleThread()
  },
  methods: {
    async fetchSingleThread() {
      var self = this
      await self.$store.dispatch('threads/getSingleThread', { thread: this.$route.params.thread_id })
    },
  }
}

</script>
<style lang="scss" scoped>
.button-pad {
  padding-top: 2.5px;
  padding-bottom: 2.5px
}

</style>
