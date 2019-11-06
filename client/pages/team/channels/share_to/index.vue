<template>
  <div style="width: 35.3333%" class=" flex flex-col overflow-hidden">
    <div class="w-full bg-gray-200">
      <div class="flex px-4  py-2 justify-between items-center">
      	<div>
      		<button @click="$router.back(-1)"><---</button>
      		<div class="">back</div>
        </div>
        <div class="leading-snug">
          <div class="font-extrabold">Share This message</div> 
          
          <div class="text-sm" v-if="thread.owner">
            Created by  {{thread.owner.id === $store.state.auth.user.id ? "you" : thread.owner.name   | name | capitalize}}
          </div>
          <div v-else>Created by...</div>
        </div>
      </div>
    </div>
    <div id="custom-scroll-bar" class="flex flex-col overflow-y-auto">
    	<div class="px-4">
    	<div class="flex flex-col my-3">
    		<div class="font-semibold mb-1">Share with</div>
    		<div>
    			<select class="w-full font-semibold border border-gray-600 focus:border-black rounded py-2 px-3" name="select" ref="selected">
    				<option v-for="channel in $store.state.channel.channels" :value="channel.id" class="py-1 font-semibold lowercase rounded"># {{channel.name}}</option>
    			</select>
    		</div>
    	</div>
    	<div class="flex flex-col my-3">
    		<div>
    			<textarea ref="body"  placeholder="Add a message, if you'd like" type="text " class="w-full border border-gray-600 focus:border-black rounded h-32 py-2 px-3"></textarea>
    		</div>
    	</div>
    	<div class="flex justify-between my-3">
    		<button class="font-semibold border border-gray-700 rounded px-4 py-1">Copy link</button>
    		<button @click="shareThread" class="font-semibold bg-green-600 px-4 text-white text-lg py-1 rounded">Share</button>
    	</div>
    </div>
    <a-spin :spinning="!Object.getOwnPropertyNames(thread).length" tip="Loading...">
      <div v-if="thread.owner" class="flex flex-row" >
      	<div class="border-r-4 rounded  border-gray-300"></div>
      	<div class="flex-1">
      		<thread :thread="thread" :isThread="false" :isShareThread="true" :isSingleThread="false" />
      	</div>
      </div>
    </a-spin>
    </div>
    
  </div>
</template>
<script>
import RightTopNav from '~/components/RightTopNav'
import Thread from '~/components/channel/threads/Thread'
export default {
  name: "ShareThread",
  data: () => ({
    threadReady: '',
    isLoading: false,
    selected:""
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
    shareThread(){
    	try {
    		// statements
    		this.$store.dispatch('channel/addThread',{
	          archive:[this.thread.id.toString(),this.$refs.selected.value],
	          reactions:[],
	          body: this.$refs.body.value ? this.$refs.body.value :"<span><span>" ,
	          channel:this.$refs.selected.value
	        })
       		this.$refs.body.value = ''
    	} catch(e) {
    		// statements
    		console.log(e);
    	}
    	
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
