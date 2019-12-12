<template>
  <div class="">
    <div id="actions-buttons" class="absolute z-10" :style="!isSingleThread ? 'top:-10px; right:20px':'top:15px; right:20px'">
      <div class="">
        <ul class="flex border border-gray-300 hover:shadow rounded-lg bg-white" >
          <a href="#" class="px-1 flex items-center  border-" @click="$store.commit('layout/POPOVER_OVERLAY_TRUE');$emit('react',true)">
             <icon 
              :classes="'fill-current m-1  opacity-100 stroke-current'" 
              :width="18" 
              :height="18" 
              :name="'face'" 
              :styles="'stroke-width: .02em;'"
              :viewBox="'0 0 24 24'"/>
          </a>
          <a href="#" @click.prevent="favoriteThread" class="px-1 flex items-center  border-l border-gray-300"> 
            <icon 
              :classes="'fill-current m-1 opacity-100 stroke-current'" 
              :width="18" 
              :height="18" 
              :name="'star'" 
              :styles="'enable-background:new 0 0 546.55 546.55;stroke-width: .85em;'"
              :viewBox="'0 0 546.55 546.55'"/>
            </a>
          <a href="#" @click="copyThread" class="px-1 flex items-center border-l border-gray-300">
            <icon 
              :classes="'fill-current m-1 opacity-100 stroke-current'" 
              :width="18" 
              :height="18" 
              :name="'archive'" 
              :styles="'enable-background:new 0 0 546.55 546.55;stroke-width: .005em;'"
              :viewBox="'0 0 24 24'"/>
          </a>
          <router-link :to="{name:'single-thread',params:{thread_id:thread.id,channel_id:thread.channel_id}}" class="px-1  flex items-center border-l border-gray-300">
            <icon 
              :styles="'stroke-width: .35em;'" 
              :name="'comment'" 
              :classes="'fill-current m-1 stroke-current '"       
              :height="16" 
              :viewBox="'0 0 511.606 511.606'" 
              :width="16"/>
          </router-link>
          <a href="#" class="px-1 flex items-center  border-l border-gray-300" @click="$store.commit('layout/POPOVER_OVERLAY_TRUE');$emit('prv',true)">
            <icon 
              :classes="'fill-current m-1 opacity-100'" 
              :width="18" 
              :height="18" 
              :name="'more'" 
              :styles="'enable-background:new 0 0 60 60'"
              :viewBox="'0 0 60 60'"/>
            </a>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import Icon from '~/components/icon/Icon'
export default {
  components:{
    Icon
  },
  props:{thread:{type:Object},isSingleThread:{type:Boolean}},
  data:()=>({
    menu:false
  }),
  methods:{
    favoriteThread(){
      this.$store.dispatch("channel/favoriteThread",{
        channelId:this.thread.channel_id,
        isFavorited:this.thread.isFavorited,
        threadId:this.thread.id,
        created_at:this.thread.created_at,
      })
    },
    copyThread(){
      let url = "http://127.0.0.1:3000/client/home/"+ this.thread.id + '/' + this.$route.params.channel_id
      this.$copyText(url).then(function (e) {
          alert('Copied')
          console.log(e)
        },
        function (e) {
          alert('Can not copy')
          console.log(e)
        })
    }
  }
}
</script>

<style lang="css" scoped>
</style>
