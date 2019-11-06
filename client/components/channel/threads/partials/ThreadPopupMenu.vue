<template>
  <div  class="absolute w-64 h-64 bg-gray-100 border shadow rounded h-auto z-50"  style="top:-10px; right:60px" >
    <ul class="py-2">
      <li @click="subscribeToThread(thread.id,thread.created_at,thread.isSubscribedTo)" class="p-1 cursor-pointer  py-1 text-black pl-4 hover:bg-blue-600 ">
        <div class="hover:text-white opacity-75 hover:opacity-100">
          <span class="font-bold ">{{!thread.isSubscribedTo ? "Follow Thread":"Unfollow Thread"}}</span><br/>
          <span class="text-sm">{{!thread.isSubscribedTo ? " You'll be notified about any replies":" You'll not be notified about any replies"}}</span>
        </div>
      </li>
      <li class="border my-2"></li>
      <router-link :tag="'li'" :to="{name:'share',params:{thread_id:thread.id}}" class="pl-4 cursor-pointer font-bold hover:opacity-100 opacity-75 py-1 text-black hover:bg-blue-600  hover:text-white">Share to ...</router-link>
      <li @click="$emit('openEditForm',true);$store.commit('layout/POPOVER_OVERLAY_FALSE')" class="pl-4 cursor-pointer font-bold hover:opacity-100 opacity-75 py-1 text-black  hover:bg-blue-600  hover:text-white">Edit Thread</li>
      <li @click="deleteThread(thread.id,thread.created_at)" class="pl-4 cursor-pointer font-bold hover:opacity-100 opacity-75 py-1 text-black  hover:bg-red-600 hover:text-white">Delete Thread</li>
    </ul>
  </div>
</template>

<script>
export default {
  props:{thread:{type:Object}},
  name:"ThreadPopupMenu",
  methods:{
    deleteThread(threadId,date){
      this.$store.dispatch('channel/deleteThread',{
        threadId:threadId,
        created_at:date,
        channelId:this.$route.params.channel_id})
    },
    subscribeToThread(threadId,date,isSubscribedTo){
        this.$store.dispatch('channel/subscribeToThread',{
          threadId:threadId,
          created_at:date,
          isSubscribedTo:isSubscribedTo,
          channelId:this.$route.params.channel_id
        })
    }
  }
}
</script>

<style lang="css" scoped>
</style>
