<template>
  <div v-on-clickaway="away">
    <div @mouseover="hover=true" @mouseleave="hover=false" class="relative">
      <div :class="hover ? 'bg-gray-100' : '' " class="flex py-1  px-4 items-start text-sm">
        <div class="flexflex-col">
          <!--   {{ thread.isFavorited ? "Added to your star items": ""}} -->
          <div class="flex">
            <img v-once src="../../../../assets/avatar.jpg" class="w-10 h-10 rounded mr-3" />
            <div class="flex-1 flex-col  overflow-hidden">
              <div class="flex-1 overflow-hidden">
                <div class="leading-tight">
                  <span class="font-bold" style="color: #232020">{{reply.owner.name | name}}</span>
                  <span class="text-grey text-xs">12:46</span>
                </div>
                <p v-html="reply.body"  style="margin: 0px;color: rgb(56, 52, 52);-webkit-text-stroke: 0.1px;"></p>
              </div>
              <!-- archives -->
            </div>
          </div>
        </div>
      </div>
      <div class="" v-show="hover">
        <div id="actions-buttons" class="absolute z-10" style="top:-10px; right:20px">
          <div class="">
            <ul class="flex border rounded bg-white">
              <a href="#" class="px-2 hover:bg-gray-100  border-l">star</a>
              <a href="#" class="px-2 hover:bg-gray-100  border-l">copy</a>
              <a href="#" @click="menu=true" class="px-2 hover:bg-gray-100  border-l">more</a>
            </ul>
          </div>
        </div>
      </div>
      <div v-if="menu" class="absolute w-64 h-64 bg-gray-100 border shadow rounded h-auto z-50" style="top:-10px; right:10px">
        <ul class="py-2">
          <li class="p-1 cursor-pointer  py-1 text-black pl-4 hover:bg-blue-600 ">
            <div class="hover:text-white opacity-75 hover:opacity-100">
              <span class="font-bold ">Follow Thread</span><br />
              <span class="text-sm">You'll be notified about any replies</span>
            </div>
          </li>
          <li class="border my-2"></li>
          <li class="pl-4 cursor-pointer font-bold hover:opacity-100 opacity-75 py-1 text-black hover:bg-blue-600  hover:text-white">Share to people</li>
          <li class="pl-4 cursor-pointer font-bold hover:opacity-100 opacity-75 py-1 text-black  hover:bg-blue-600  hover:text-white">Edit Thread</li>
          <li @click="deleteReply" class="pl-4 cursor-pointer font-bold hover:opacity-100 opacity-75 py-1 text-black  hover:bg-red-600 hover:text-white">Delete Thread</li>
        </ul>
      </div>
    </div>
    <reply-edit @closeEditForm="edit=$event" :reply="reply" v-if="edit" />
  </div>
</template>
<script>
  import ReplyEdit from './ReplyEdit'
import { mixin as clickaway } from 'vue-clickaway';
export default {
  components:{ReplyEdit},
  props: { reply: { type: Object } },
  name: "Reply",
  mixins:[clickaway],
  data: () => ({
  	menu:false,
    hover: false,
    edit:false
  }),
  methods:{
  	away(){
  		this.menu = false
  	},
    deleteReply(){
      this.$store.dispatch('threads/deleteReply',{
        replyId:this.reply.id,
        threadId:this.$route.params.thread_id
      })
    }
  }
}

</script>
