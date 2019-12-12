<template>
  <div class="app overflow-y-auto overflow-x-hidden text-purple-lighter border-r bg-gray-200 flex-none  w-64 pb-6
  hidden md:block">
    <div class="mt-3 px-4 flex flex-col justify-between ">
      <div class="flex-auto mb-2">
        <div class="flex justify-between">
          <div>
            {{current_team.name}}
          </div>
          <div @click="$store.commit('layout/TEAM_SETTINGS')" class="bg-gray-100 font-semibold border cursor-pointer px-1 rounded-lg">
            <div class="text-sm">+ Invite</div>
          </div>
        </div>
      </div>
      <div>
        <div class="flex justify-between">
          <div class="leading-normal">
            <div style="text-shadow: 0px 0px 2px #fffefe" class="font-semibold text-xl text-black leading-tight truncate" v-if="current_team && !$store.state.layout.isLoading">
              {{user.name | name | capitalize}}
            </div>
            <div class="flex items-center">
              <span class="bg-green-500 rounded-full block w-2 h-2 mr-2"></span>
              <span class="opacity-50 text-sm">{{"online "}}</span>
            </div>
          </div>
          <div>
            <icon 
              :classes="'fill-current opacity-100'" 
              :width="18" 
              :height="18" 
              :name="'bell'" 
              :viewBox="'0 0 20 20'"/>
          </div>
        </div>
      </div>
      <div class="cursor-pointer mt-2">
        <div class="w-full bg-gray-100 rounded h-8 border bg-white">
          <div class="flex justify-between">
            <div class="flex p-1 flex-wrap items-center">
              <icon 
                :styles="'stroke-width: .35em;'" 
                :name="'comment'" 
                :classes="'fill-current stroke-current '"       
                :height="14" 
                :viewBox="'0 0 511.606 511.606'" 
                :width="18">
              </icon>
              <div class="px-2 font-medium">
                Jump to...
              </div>
            </div>
            <button class="border-l items-center ">
              <div class="text-center px-2">
                 <icon 
                  :styles="'stroke-width:0.02rem'" 
                  :name="'plus'" 
                  :classes="'fill-current stroke-current '"       
                  :height="20" 
                  :viewBox="'0 0 24 24'" 
                  :width="20">
                </icon>
              </div>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col overflow-y-auto overflow-x-hidden">
      <div class="mb-6">
        <div class="px-4 mt-3 flex justify-between items-center">
          <div class="font-semibold opacity-75 text-sm">STARRED</div>
        </div>
        <div class="mb-4">
          <div v-for="channel in channels">
            <router-link 
              v-if="channel.isFavorited" 
              :tag="'div'" 
              :to="$route.params.thread_id ?'/client/home/'+$route.params.team_id+'/'+channel.id+'/thread/'+$route.params.thread_id :
              { name:'channel',params:{channel_id:channel.id}} " 
              class="bg-teal-dark flex items-center hover:opacity-100  cursor-pointer  rounded-l pl-6">
              <span class="lowercase">
                <b class="text-sm"></b># {{ channel.name}} 
              </span>
            </router-link>
          </div>
        </div>
        <div class="px-4 flex justify-between items-center">
          <div class="font-semibold opacity-75  text-sm   ">MY SPACE</div>
        </div>
        <!--  <div class="relative" v-if="!!current_team"> -->
        <div class="relative">
          <team-list class="relative" :team="current_team" />
        </div>
        <div v-if="$store.state.layout.isLoading" class="text-grey-dark text-sm truncate">
          <div class='text-input__loading'>
            <div class='text-input__loading--line rounded  '></div>
          </div>
        </div>
        <div>
          <div class="px-4 cursor-pointer mb-2 mt-6  flex justify-between items-center">
            <div @click="$store.commit('layout/CREATE_CHANNEL_MODAL')" class="flex items-center ">
              <div class="px-2">
                 <icon :classes="'fill-current'" :width="16" :height="16" :name="'plus'" :viewBox="'0 0 20 20'"/>
              </div>
              <div>Add Channels</div>
            </div>
            <div>
            <icon :classes="'fill-current opacity-100'" :width="16" :height="16" :name="'plus_circle'" :viewBox="'0 0 20 20'"/>
            
            </div>
          </div>
          <create-channel-modal v-if="$store.state.layout.visibleCreateChannel" />
          <team-settings-modal v-if="$store.state.layout.visibleTeamSettingsModal" />
        </div>
      </div>
    </div>
  </div>
  <!-- Chat content -->
</template>
<script>
import Icon from '~/components/icon/Icon'
import vueCustomScrollbar from 'vue-custom-scrollbar'
import TeamSettingsModal from '../teams/TeamSettingsModal'
import CreateChannelModal from '../channel/CreateChannelModal'
export default {
  name: "SideBarView",
  components: {Icon, vueCustomScrollbar, TeamSettingsModal, CreateChannelModal },
  computed: {
    teams: function() {
      return this.$store.state.team.teams
    },
    currentChannel: function() {
      if (this.$route.params.channel_id) {
        if (this.$route.name !== "thread") {
          return this.$store.getters['channel/channel'](this.$route.params.channel_id).id
        }
        return 0
      }
      return 0;

    },
    channels: function() {
      return this.$store.state.channel.channels
    },
    user: function() {
      return this.$store.getters['auth/user']
    },
    current_team: function() {
      return this.$store.getters['team/team'](this.$route.params.team_id)
    },
  }
}

</script>
<style>
.hover {
  background: #a27da2;
}

</style>
