<template>
  <div>
    <div class="py-1">
      <div v-show="show">
        <div class="my-1" v-for="channel in channels" v-if="!channel.isFavorited">
          <router-link 
            v-if="channel.team_id === team.id" 
            :tag="'div'" 
            :to="$route.params.thread_id ?'/client/home/'+team.id+'/'+channel.id+'/thread/'+$route.params.thread_id :{ name:'channel',params:{channel_id:channel.id, team_id:team.id}} "  
            class="bg-teal-dark flex items-center hover:opacity-100 cursor-pointer pl-6"
            :class="currentChannel === channel.id ? 'font-bold bg-blue-500 text-white' : '' ">
            <span class="lowercase">
              <b class="text-sm">#</b> {{ channel.name}}
            </span>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: { team: { type: Object } },
  name: "TeamList",
  data: () => ({
    show: true,
    menu: true,
    colorCache: {}
  }),
  computed: {
    current_team: function() {
      return this.$store.getters['team/team'](this.$route.params.team_id)
    },
    channels: function() {
      return this.$store.state.channel.channels
    },
    currentChannel: function() {
      if (this.$route.params.channel_id) {
        return this.$store.getters['channel/channel'](this.$route.params.channel_id).id
      }
      return 0;

    },
  },
  methods: {
    randomColor(id) {
      const r = () => Math.floor(256 * Math.random());
      return this.colorCache[id] || (this.colorCache[id] = `rgb(${r()}, ${r()}, ${r()})`);
    }
  }
}

</script>
 -->
