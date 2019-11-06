<template>
  <div class="">
    <div id="actions-buttons" class="absolute z-10" :style="!isSingleThread ? 'top:-10px; right:20px':'top:0px; right:20px'">
      <div class="">
        <ul class="flex border rounded bg-white" >
          <a href="#" class="px-2 hover:bg-gray-100  border-" @click="$store.commit('layout/POPOVER_OVERLAY_TRUE');$emit('react',true)">emojies</a>
          <a href="#" @click.prevent="favoriteThread" class="px-2 hover:bg-gray-100  border-l">star</a>
          <a href="#" @click="copyThread" class="px-2 hover:bg-gray-100  border-l">copy</a>
          <router-link :to="{name:'single-thread',params:{thread_id:thread.id,channel_id:thread.channel_id}}" class="px-2 hover:bg-gray-100  border-l">singleT</router-link>
          <a href="#" class="px-2 hover:bg-gray-100  border-l" @click="$store.commit('layout/POPOVER_OVERLAY_TRUE');$emit('prv',true)">more</a>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
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
