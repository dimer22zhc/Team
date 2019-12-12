<template>
  <div style="width: 35.3333%" class=" flex flex-col relative overflow-hidden">
    <div class="w-full bg-gray-200">
      <div class="flex px-4  py-2 justify-between items-center">
        <div class="leading-snug">
          <div class="font-extrabold text-black">Thread</div>
          <div class="text-sm">
            {{$store.state.auth.user.name | name | capitalize}}
          </div>
        </div>
        <div>
          <router-link 
            :tag="'button'"
            class=" rounded hover:bg-gray-300 mr-2 p-1" 
            :to="{name:$route.name === 'p-thread' ? 'post' : 'channel'}">
           <icon 
            :classes="'fill-current opacity-100'" 
            :width="25" 
            :height="25" 
            :name="'x'" 
            :viewBox="'0 0 24 24'"/>
          </router-link>
        </div>
      </div>
    </div>
    <div v-if="Object.getOwnPropertyNames(thread).length" class=" absolute z-50 rounded-lg bg-white" style="left: 35%; top: 36px">
      <span class="px-2 font-bold text-sm">{{ago(thread.created_at)}}</span>
    </div>
    <a-spin :spinning="!Object.getOwnPropertyNames(thread).length" tip="Loading...">
      <div class="h-screen">
         <div v-if="thread.owner" >
          <thread :thread="thread" :isThread="false" :isShareThread="false" :isSingleThread="true" />
        </div>
      </div>
    </a-spin>
  </div>
</template>
<script>
import moment from 'moment'
import Icon from '~/components/icon/Icon'
import RightTopNav from '~/components/RightTopNav'
import Thread from '~/components/channel/threads/Thread'
export default {
  name: "Thread-View",
  data: () => ({
    threadReady: '',
    isLoading: false
  }),
  components: { RightTopNav, Thread,Icon },
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
    ago(date){
      return moment(date).calendar()
    }
  }
}

</script>
<style lang="scss" scoped>
.button-pad {
  padding-top: 2.5px;
  padding-bottom: 2.5px
}

</style>
