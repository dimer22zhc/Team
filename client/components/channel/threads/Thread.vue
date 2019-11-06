<template>
  <div id="msBox" class="relative" v-on-clickaway="away">
    <div class="w-full bg-gray-400 z-30 absolute opacity-0 h-full " style="top:-10px" v-if="menu || isReact ">
    </div>
    <div :id="'t-'+thread.id" @mouseover="hover=true" @mouseleave="hover=false" v-if="!isEdit" class="relative">
      <div :class="hover ? 'bg-gray-100' : '' " class="flex py-1 flex-wrap  px-4 items-start text-sm">
        <div class="flex flex-col">{{ thread.isFavorited ? "Added to your star items": ""}}
          <div class="flex">
            <img src="../../../assets/avatar.jpg" class="w-10 h-10 rounded mr-3" />
            <div class="flex-1 flex-col  overflow-hidden">
              <div class="overflow-hidden">
                <div class="leading-tight">
                  <span class="font-bold" style="color: #232020">{{thread.owner.name | name}}</span>
                  <span class="text-grey text-xs">12:46</span>
                </div>
                <div v-if="thread.type !== 'post'" v-html="thread.body" style="margin: 0px;color: rgb(56, 52, 52);-webkit-text-stroke: 0.1px;"></div>
                <div v-else>
                  <div style="margin: 0px;color: rgb(56, 52, 52);-webkit-text-stroke: 0.1px;">{{thread.description}}</div>
                  <div @click="showPost = !showPost" class="cursor-pointer font-bold">
                    {{showPost ? "Post" :thread.title | capitalize}} 
                  </div>
                  <div v-show="showPost" @mouseover="isHoverPost=true" @mouseleave="isHoverPost=false" 
                  :style="!isSingleThread && !isShareThread ? 'width: 400px' : 'width: 275px'" class="p-2 relative cursor-pointer border bg-white rounded-lg">
                    <div v-if="isHoverPost && !isSingleThread"  class="absolute" :style="!isSingleThread ? 'top:5px; right:10px':'top:5px; right:10px'">
                      <div>
                        <div class="flex bg-white" >
                          <button href="#" class="mx-1 rounded hover:bg-gray-100 border">icon</button>
                          <button href="#" class="mx-1 rounded hover:bg-gray-100  border">icon</button>
                          <button href="#"  class="mx-1 rounded hover:bg-gray-100  border">icon</button>
                          
                        </div>
                      </div>
                    </div>
                    <div class="flex mb-1 items-center">
                        <div class=" p-2">
                          <svg class="fill-current strok text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="34" height="34"><path class="heroicon-ui" d="M6 2h9a1 1 0 0 1 .7.3l4 4a1 1 0 0 1 .3.7v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2zm9 2.41V7h2.59L15 4.41zM18 9h-3a2 2 0 0 1-2-2V4H6v16h12V9zm-2 7a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm0-4a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm-5-4a1 1 0 0 1-1 1H9a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1z"/></svg>
                        </div>        
                        <div class= "leading-tight">
                          <div class="font-bold">{{thread.title  | capitalize}}</div>
                          <div class="text-sm">Last update {{update_ago(thread.updated_at)}}</div>
                        </div>          
                    </div>
                    <hr class="pt-1" />
                    <div class="mt-1" v-html="thread.body"></div>
                    
                  </div>
                </div>
              </div>
              <div v-if="thread.archives.length" v-for="archive in thread.archives" class="flex mt-1">
                <div class=" rounded bg-blue-600 mr-2">
                  <div class="w-1"></div>
                </div>
                <div class="flex ">
                  <div class="flex-col">
                    <div class="flex mb-1  items-center">
                      <img src="../../../assets/avatar.jpg" class="w-6 h-6 rounded mr-3" />
                      <div class="font-bold">
                        <span  style="color: #232020">{{archive.owner[0].name | name}}</span>
                      </div>
                    </div>
                    <div class="flex flex-col">
                      <p v-html="archive.content" style="margin-bottom: 4px;color: rgb(56, 52, 52);-webkit-text-stroke: 0.1px;"></p>
                      <div>
                        <div class="text-sm">Posted in <span class="font-semibold">#{{archive.c_name}}</span> | {{ago(archive.create_time) | capitalize}}
                          <router-link v-if="!isSingleThread" :to="{name:'single-thread',params:{thread_id:archive.archived_id,channel_id:thread.channel_id}}" class="text-sm text-blue-600  hover:underline cursor-pointer">View message</router-link>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <message-reply-bar-description v-if="isThread" :thread="thread" />
            </div> 
          </div>
        </div>
        
      </div>
      <thread-actions-buttons v-if="!isShareThread" :thread="thread" :isSingleThread="isSingleThread" @prv="menu=$event" @react="isReact=$event" v-show="hover" />
    </div>
    <thread-edit @closeEditForm="isEdit=$event" :content="body" :postDescription="thread.description" :isPost="thread.type ==='post' ? true : false" :thread="thread" v-else />
    <thread-popup-menu @openEditForm="isEdit=$event;menu=false" :thread="thread" v-if="menu" />
    <thread-reactions-pallet v-if="isReact" />
    <replies :thread="thread" :replies="thread.replies" v-if="isSingleThread" />
  </div>
</template>
<script>
import moment from 'moment'
import { mixin as clickaway } from 'vue-clickaway';
import ThreadActionsButtons from './partials/ThreadActionsButtons'
import ThreadPopupMenu from './partials/ThreadPopupMenu'
import ThreadReactionsPallet from './partials/ThreadReactionsPallet'
import Replies from './partials/Replies'
import ThreadEdit from './partials/ThreadEdit'
export default {
  mixins: [clickaway],
  props: { 
    thread: { type: Object }, 
    isThread:{type: Boolean,default:false},
    isSingleThread: { type: Boolean,default:false } , 
    isShareThread:{type:Boolean,default:false}
  },
  components: {
    ThreadActionsButtons,
    ThreadPopupMenu,
    Replies,
    ThreadReactionsPallet,
    ThreadEdit
  },
  data: () => ({
    hover: false,
    menu: false,
    isReact: false,
    isEdit: false,
    isHoverPost:false,
    showPost:true,
  }),
  created() {
    this.body = this.thread.body
  },
  methods: {
    hover_open() {
      this.hover = true
    },
    ago(date) {
      return moment(date).calendar()
    },
    update_ago(date){
       return moment(date).fromNow()
    },
    away() {
      this.menu = false
      this.hover = false
      this.isReact = false
    },
    findIt(e) {
      let el = document.getElementById(e)
    }
  }

}

</script>
