<template >
  <div>
    <div v-for="(threads,key) in threads">
      <div class="mx-32 flex justify-center my-4">
          <div class="font-semibold">
            {{formatDate(key) | capitalize}}
          </div>
      </div>
      <thread v-for="thread in threads" :isThread="true" :isShareThread="false" :isSingleThread="false" :thread="thread" :key="thread.id" />
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
    }
  }
}
</script>

<style lang="css" scoped>
</style>
