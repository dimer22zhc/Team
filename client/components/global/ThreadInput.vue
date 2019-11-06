<template>
<div class="pb-6 px-4 flex-none">
  <code-snippet :visible="visible" />
  <div v-if="menu" class="bg-gray-100 z-20 border shadow-md rounded-lg  absolute w-56 bg-white" style="bottom: 68px">
    <ul>
      <li @mouseover="sub_menu=true" @mouseleave="sub_menu=false">
        <div :class="sub_menu? 'bg-blue-600 text-white':''" class="px-4  my-2 cursor-pointer">
          <div class="flex items-center justify-between">
            <div class="flex items-center justify-between">
              <div>icon</div>
              <div class="px-2">Create new ...</div>
            </div>
            <div>-></div>
          </div>
        </div>
         <div v-if="sub_menu" class="bg-gray-100 z-20 border shadow-md rounded-lg  absolute w-64 bg-white" style="right: -213px; bottom: 3px">
          <ul>
            <router-link :tag="'li'" :to="{name: $route.params.thread_id ?'p-thread':'post'}" class="px-4  my-1 cursor-pointer hover:bg-blue-600 hover:text-white">
              <div class="flex items-center">
                  <div>icon</div>
                  <div class="px-2">Post </div>
              </div>
            </router-link>
             <li class="px-4  my-1 cursor-pointer hover:bg-blue-600 hover:text-white  ">
                <div class="flex items-center ">
                  <div>icon</div>
                  <div class="px-2">Code or text snippet</div>
                </div>
            </li>
            <li class=" my-1 ">
              <span class="text-sm px-4 ">More options</span>
              <div>
                <ul>
                  
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </li>
      <hr/>
      <li class=" my-1 ">
        <span class="text-sm px-4 ">Add a file from...</span>
        <div>
          <ul>
            <li class="flex px-4 cursor-pointer hover:bg-blue-600 hover:text-white">
              <div class="px-2">icon</div>
              <div class="px-2 "> Your computer</div>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
    <div class="flex items-center rounded-lg border-2 border-grey overflow-hidden">
        <span @click="menu=!menu" class=" cursor-pointer hover:bg-green-600 hover:text-white text-3xl text-grey border-r-2 border-grey p-2">
          <svg class="fill-current h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z"></path></svg>
        </span>
        <textarea
        ref="body"
        name="textarea"
        cols="1"
        @keyup.enter="createThread"
        class="w-full px-4 py-2 overflow-hidden relative rounded focus:outline-none"
        :placeholder="'Message'+ ' #'+ channelName" ></textarea>
    </div>
</div>
</template>
<script>
	import $ from 'jquery'
  import Form from 'vform'
	export default{
		name:"ThreadInput",
    data:()=>({
      sub_menu:false,
      menu:false,
      visible:true,
      form: new Form({
        body:'',
      })
    }),
    computed:{
      channelName:function(){
        if (this.$store.getters['channel/channel'](this.$route.params.channel_id)) {
          if (this.$store.getters['channel/channel'](this.$route.params.channel_id).name) {
            return this.$store.getters['channel/channel'](this.$route.params.channel_id).name
          }
          return "...All Most There";
        }
        return "...Loading";
      }
    },
    methods:{
       createThread(){

        this.$store.dispatch('channel/addThread',{
          archive:this.newArchive(this.$refs.body.value),
          reactions:[],
          body: this.$refs.body.value,
          channel:this.$route.params.channel_id
        })
       this.$refs.body.value = ''
      },
      newArchive(body){
        let regex = /(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[-A-Z0-9+&@#\/%=~_|$?!:,.])*(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[A-Z0-9+&@#\/%=~_|$])/igm
        if (new RegExp(regex).test(body)) {
            let matchedUrl = body.match(regex) || [];
            let queries =  matchedUrl[0].split('/').slice(-2)
            if (queries.length === 2) {
              return queries
            }
           return []
        }

      }

    }
	}
</script>
