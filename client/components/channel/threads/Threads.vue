<template >
  <div>
    <div v-for="(groupe,key) in threads">
      <div class="mx-32 flex justify-center my-4">
          <div class="font-semibold">
            {{formatDate(key) | capitalize}}
          </div>
      </div>
      <thread v-for="(thread, index) in groupe" :nextThreadOwnerId="checkNextThreadOwner(groupe,index)" :isThread="true" :isShareThread="false" :isSingleThread="false" :thread="thread" :key="thread.id" />
    </div>
  </div>
</template>

<script>
import moment from 'moment'
import Thread from './Thread'
export default {
  components:{Thread},
  computed:{
    threads(){
      return this.$store.getters['channel/threads'](this.$route.params.channel_id)
    }
  },
  methods:{
    formatDate(date){
      let d =  moment(date).calendar();  
      let newD =  d.split("at")[0]
      let myFormatDate =  moment(date).format('DD-MM-YYYY')
      return newD + ',' +myFormatDate;
    },
    checkNextThreadOwner(threads,position){
      try {
        // statements  
        return threads[position - 1] ? threads[position - 1].owner.id : 0
      } catch(e) {
        // statements
        console.log(e);
      }
    }
  }
}
</script>

<style lang="css" scoped>
</style>
