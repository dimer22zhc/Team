<template>
  <div class="flex flex-1 overflow-hidden">

    <div class="flex flex-col flex-1">
      <div  class="flex-1 flex flex-col bg-white overflow-hidden " style=" font-size: 15px">
        <!-- Top bar -->
        <channel-top-header :channel="channel">
        </channel-top-header>
        <!-- Chat messages -->
        <!-- A message -->
         <div class="flex flex-1 relative overflow-hidden">
            <div class="flex justify-center flex-col flex-1 overflow-hidden">
               <div id="custom-scroll-bar" class="flex  flex-1 overflow-y-auto overflow-x-hidden border-r  flex-col-reverse">
                  <div>
                    <div  class="py-10 justify-center items-center flex font-semibold" id="element"> Loading history...</div>
                    <threads />
                  </div>
                </div>
              <thread-input></thread-input>
            </div>
          <!--Thread input-->
            <nuxt-child />
         </div>
      </div>
    </div>
  </div>
</template>
<script>
import moment from 'moment'
import _ from 'lodash'
import ChannelTopHeader from '~/components/channel/ChannelTopHeader'
import Threads from '~/components/channel/threads/Threads';
export default {
  components: {
    ChannelTopHeader,
    Threads
  },
  name: 'Channel',
  head() {
    return { title: this.$t('home') + " | " + this.channelName }
  },
  data: () => ({
    name: ''
  }),
  watch: {
    '$route.params.channel_id': function() {
      if (!this.$store.getters['channel/channel'](this.$route.params.channel_id).loaded) {
        this.loadThreads()
      }

    },
  },
  computed: {
    threads() {
      return _.uniqBy(this.$store.getters['channel/threads'](this.$route.params.channel_id),'id')
    },
    channel:function(){
      return this.$store.getters['channel/channel'](this.$route.params.channel_id)
    },
    channelName: function() {
      if (this.$store.getters['channel/channel'](this.$route.params.channel_id)) {
        if (this.$store.getters['channel/channel'](this.$route.params.channel_id).name) {
          return this.$store.getters['channel/channel'](this.$route.params.channel_id).name
        }
        return "...All Most There";
      }
      return "...Loading";
    },
  },
  mounted() {
    this.loadThreads()
  },
  methods: {
    async loadThreads() {
      await this.$store.dispatch('channel/loadThreads', this.$route.params.channel_id)
    },
    viewHandler(e){
      console.log(e.scrollPercent)
    },
    groupBy(array, key){
      let finalObj = {}
      array.forEach((games) => {
        const date = moment(games[key]).startOf('isoWeek').fromNow("DDDD")
        if (finalObj[date]) {
          finalObj[date].push(games);
        } else {
          finalObj[date] = [games];
        }
      })
      return finalObj
    }
  }
}

</script>
