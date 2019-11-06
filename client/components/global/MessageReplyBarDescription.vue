<template>
  <router-link :tag="'div'" :to="{name:'single-thread',params:{thread_id:thread.id}}">
    <div 
      @mouseover="hover=true" 
      @mouseleave="hover=false" 
      v-if="thread.replies.length" 
      :class="hover ? 'bg-white shadow' : '' " 
      class="flex items-center h-8 mt-1 relative  cursor-pointer " 
      style="width: 70vh">
      <div class="flex items-center justify-between pl-1 leading-tight">
        <div class="flex items-center pr-20">
          <div v-for="reply in replies">
            <img src="../../assets/avatar.jpg" class="w-6 h-6 rounded mr-1">
          </div>
          <div><b class="text-blue-700  text-sm pr-4">{{thread.replies.length}} replies</b></div>
          <div>
            <b class="text-sm" style="font-size: 11.7px">
              {{ hover ? 'View Thread' : 'Last reply ' + ago(lastToReply[0].created_at)}}
            </b>
          </div>
        </div>
      </div>
      <div class="absolute right-0" v-if="hover">
        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
          <path class="heroicon-ui" d="M14.7 15.3a1 1 0 0 1-1.4 1.4l-4-4a1 1 0 0 1 0-1.4l4-4a1 1 0 0 1 1.4 1.4L11.42 12l3.3 3.3z" /></svg>
      </div>
    </div>
  </router-link>
</template>
<script>
	import moment from 'moment'
	import _ from 'lodash'
	export default{
		name:"MessageReplyBarDescription",
		props: {thread: { type: Object },},
		data:()=>({
			hover:false
		}),
		computed: {
		    replies() {
		      return _.takeRight(_.uniqBy(this.thread.replies,'user_id'), 3)
		    },
		    lastToReply(){
		      return _.takeRight(this.thread.replies)
		    }
		 },
		 methods:{
		    ago(date){
		      return moment(date).fromNow()
		    }
		  },
	}
</script>