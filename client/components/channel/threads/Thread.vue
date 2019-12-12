<template>
  <div id="msBox" class="relative" v-on-clickaway="away">
    <div class="w-full bg-gray-400 z-30 absolute opacity-0 h-full " style="top:-10px" v-if="menu || isReact ">
    </div>
    <div 
      :id="'t-'+thread.id" 
      @mouseover="hover=true" 
      @mouseleave="hover=false" 
      v-if="!isEdit" 
      class="relative">
      <div :class="hover  ? 'bg-gray-100' : '' " class="flex py-1 flex-wrap  px-6 items-start text-sm">
        <div class="flex flex-col">
          <div :class="nextThreadOwnerId ===  thread.owner.id ?'pl-12':''">
            <div class="flex" v-if="thread.isFavorited">
              <a href="" class="mr-2">
                <svg class="cursor-pointer fill-current text-yellow-500 stroke-current" 
                  style="stroke-width: 0.1em;"  
                  xmlns="http://www.w3.org/2000/svg" 
                  height="16" viewBox="0 0 20 20">
                  <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                </svg>
              </a>
              <a href="" class="text-sm font-semibold">Added to your star items</a>
            </div>
          </div>
          <div class="flex">
            <div v-if="nextThreadOwnerId ===  thread.owner.id" style="width: 48px">
              <span class="text-grey font-extrabold" style="font-size: 9px" v-if="hover && nextThreadOwnerId ===  thread.owner.id">
               {{
                ago(thread.created_at).split('at')[1] ? 
                ago(thread.created_at).split('at')[1] :
                ago(thread.created_at).split('at')[0].split('/')[0] + '/' + 
                ago(thread.created_at).split('at')[0].split('/')[1]}}
              </span>
            </div>
            <img v-if="nextThreadOwnerId !==  thread.owner.id" src="../../../assets/avatar.jpg" class="w-10 h-10 rounded mr-3" />
            <div class="flex-1 flex-col  overflow-hidden">
              <div class="overflow-hidden">
                <div class="leading-tight">
                  <span 
                    v-if="nextThreadOwnerId !==  thread.owner.id" 
                    class="font-bold" 
                    style="color: #232020">
                      {{thread.owner.name | name}}
                  </span>
                  <span 
                    v-if="nextThreadOwnerId !==  thread.owner.id && !isSingleThread" 
                    class="text-grey text-xs">
                     {{ 
                      ago(thread.created_at).split('at')[1] ? 
                      ago(thread.created_at).split('at')[1] :
                      ago(thread.created_at).split('at')[0]}}
                  </span>
                </div>
                <div v-if="thread.type !== 'post'" v-html="thread.body" style="margin: 0px;color: rgb(56, 52, 52);-webkit-text-stroke: 0.1px;">  
                </div>
                <div v-else>
                  <div v-for="file in thread.file">
                    <div style="margin: 0px;color: rgb(56, 52, 52);-webkit-text-stroke: 0.1px;">{{file.post.description}}</div>
                    <div @click="showPost = !showPost" class="flex items-center cursor-pointer font-bold">
                      <div>
                        {{showPost ? "Post" : file.post.title | capitalize}}
                      </div>
                      <div>
                        <icon :classes="'fill-current opacity-100'" :width="18" :height="18" :name="showPost ? 'cheveron_down':'cheveron_right'" :viewBox="'0 0 24 24'">
                        </icon>
                      </div>
                    </div>
                    <div v-show="showPost===true" @mouseover="isHoverPost=true" @mouseleave="isHoverPost=false" :style="!isSingleThread && !isShareThread ? 'width: 550px' : 'width: 300px'" class="p-2 relative border bg-white rounded-lg">
                      <div v-if="isHoverPost && !isSingleThread" class="absolute" :style="!isSingleThread ? 'top:5px; right:10px':'top:5px; right:10px'">
                        <div>
                          <div class="flex bg-white">
                           <button href="#" class="mx-1 p-1 focus:bg-gray-200 focus:outline-none rounded-lg hover:bg-gray-100  border"> 
                              <icon 
                                :classes="'fill-current m-1 opacity-100 stroke-current'" 
                                :width="16" 
                                :height="16" 
                                :name="'edit'" 
                                :styles="'enable-background:new 0 0 546.55 546.55;stroke-width: 0.001em;'"
                                :viewBox="'0 0 24 24'"/>
                            </button>
                      
                            <button href="#" class="mx-1 p-1 focus:bg-gray-200 focus:outline-none rounded-lg hover:bg-gray-100  border"> 
                              <icon 
                                :classes="'fill-current m-1 opacity-100 stroke-current'" 
                                :width="16" 
                                :height="16" 
                                :name="'share'" 
                                :styles="'enable-background:new 0 0 546.55 546.55;stroke-width: 1em;'"
                                :viewBox="'0 0 546.55 546.55'"/>
                            </button>
                            <button href="#" class="mx-1 p-1 focus:bg-gray-200 focus:outline-none rounded-lg hover:bg-gray-100  border"> 
                              <icon 
                                :classes="'fill-current m-1 opacity-100'" 
                                :width="16" 
                                :height="16" 
                                :name="'more'" 
                                :styles="'enable-background:new 0 0 60 60'"
                                :viewBox="'0 0 60 60'"/>
                            </button>
                          </div>
                        </div>
                      </div>
                      <router-link :tag="'div'" :to="{name:'file', params:{file_id:file.id}}" class="flex cursor-pointer mb-1 items-center">
                        <div class=" p-1">
                            <icon 
                                :classes="'fill-current opacity-100 ; text-green-600'" 
                                :width="46" 
                                :height="46" 
                                :name="'file'" 
                                :styles="'enable-background:new 0 0 60 60; stroke-width: 0.1em;'" :viewBox="'0 0 24 24'" />
                        </div>
                        <div class="leading-tight mr-3">
                          <div class="font-bold mb-2 text-black">{{file.post.title | capitalize}}</div>
                          <div class="text-sm">Last update {{update_ago(file.updated_at)}}</div>
                        </div>
                      </router-link>
                      <div class="px-4">
                        <hr v-if='!isShareThread' class="pt-1" />
                        <div v-if='!isShareThread' class="mt-1" v-html="file.post.content"></div>
                      </div>
                     
                    </div>
                  </div>
                </div>
              </div>
              <div v-if="thread.archives.length" v-for="archive in thread.archives" class="flex mt-1">
                <div class=" rounded bg-gray-500 mr-2">
                  <div class="w-1"></div>
                </div>
                <div class="flex ">
                  <div class="flex-col">
                    <div class="flex mb-1  items-center">
                      <img src="../../../assets/avatar.jpg" class="w-6 h-6 rounded mr-3" />
                      <div class="font-bold">
                        <span style="color: #232020">{{archive.owner[0].name | name}}</span>
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
import Icon from '~/components/icon/Icon'
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
    nextThreadOwnerId: { type: Number },
    isThread: { type: Boolean, default: false },
    isSingleThread: { type: Boolean, default: false },
    isShareThread: { type: Boolean, default: false }
  },
  components: {
    Icon,
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
    isHoverPost: false,
    showPost: true,
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
    update_ago(date) {
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
