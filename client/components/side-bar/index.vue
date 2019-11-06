<template>
  <div class="app overflow-y-auto overflow-x-hidden
  text-purple-lighter border-r bg-gray-200
  flex-none  w-64 pb-6
  hidden md:block">
    <div class="mt-3 px-4 flex flex-col justify-between ">
      <div class="flex-auto mb-1">
        <div class="flex justify-between">
          <div>
            {{current_team.name}}
          </div>
          <div @click="$store.commit('layout/TEAM_SETTINGS')" class="bg-gray-100 font-semibold border cursor-pointer px-1 rounded-lg">
            <div class="text-sm">+ Invite</div>
          </div>
        </div>
      </div>
      <div class="flex justify-between my-1">
        <div>
          <div style="text-shadow: 0px 0px 2px #fffefe" class="font-semibold text-xl font-black leading-tight mb-1  truncate" v-if="current_team && !$store.state.layout.isLoading">
            {{user.name | name}}
          </div>
          <div class="flex items-center mb-6">
            <span class="bg-green-500 rounded-full block w-2 h-2 mr-2"></span>
            <span class="opacity-50 text-sm">{{"online "}}</span>
          </div>
        </div>
        <div>
          <svg class="h-6 w-6 fill-current opacity-100" viewBox="0 0 20 20">
            <path d="M14 8a4 4 0 1 0-8 0v7h8V8zM8.027 2.332A6.003 6.003 0 0 0 4 8v6l-3 2v1h18v-1l-3-2V8a6.003 6.003 0 0 0-4.027-5.668 2 2 0 1 0-3.945 0zM12 18a2 2 0 1 1-4 0h4z" fill-rule="evenodd" />
          </svg>
        </div>
      </div>
    </div>
    <div class="flex flex-col overflow-y-scroll overflow-x-hidden">
      <div class="px-4 mb-4 flex justify-between items-center">
        <router-link :tag="'div'" :to="{name: !$route.params.thread_id ? 'threads' : 't-threads'}" class="flex items-center cursor-pointer">
          <div class="text-md">
            <svg style="stroke-width: .35em;" class="fill-current stroke-current " xmlns="http://www.w3.org/2000/svg" id="Layer_1" enable-background="new 0 0 511.606 511.606" height="14" viewBox="0 0 511.606 511.606" width="18">
              <path d="m436.594 74.943c-99.917-99.917-261.637-99.932-361.568 0-80.348 80.347-95.531 199.817-48.029 294.96l-26.335 115.839c-3.423 15.056 10.071 28.556 25.133 25.133l115.839-26.335c168.429 84.092 369.846-37.653 369.846-228.813 0-68.289-26.595-132.493-74.886-180.784zm-242.416 385.371c22.646-19.619 34.932-47.807 34.932-76.506 0-11.598-9.402-21-21-21s-21 9.402-21 21c0 27.866-19.748 52.26-46.957 58.002-.426.089 3.534-.808-91.141 20.715l20.646-90.813c1.127-4.959.417-10.159-2-14.633-75.972-140.691 25.727-315.022 188.152-315.022 117.818 0 213.67 95.852 213.67 213.67 0 142.313-137.577 245.923-275.302 204.587z" />
              <path d="m362.477 192.061h-213.334c-11.598 0-21 9.402-21 21s9.402 21 21 21h213.334c11.598 0 21-9.402 21-21s-9.403-21-21-21z" />
              <path d="m309.143 277.394h-160c-11.598 0-21 9.402-21 21s9.402 21 21 21h160c11.598 0 21-9.402 21-21s-9.402-21-21-21z" />
            </svg>
          </div>
          <div class="px-1 font-semibold">
            Activities
          </div>
        </router-link>
        <div>
          <svg class="fill-current h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z" />
          </svg>
        </div>
      </div>
      <div class="mb-6">
        <div class="px-4 flex justify-between items-center">
          <div class="text-md font-semibold opacity-75">STARRED</div>
          <div>
            <svg class="fill-current h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z" />
            </svg>
          </div>
        </div>
        <div class="mb-4">
          <div v-for="channel in channels">
            <router-link v-if="channel.isFavorited" :tag="'div'" :to="$route.params.thread_id ?
              '/client/home/'+$route.params.team_id+'/'+channel.id+'/thread/'+$route.params.thread_id :
              { name:'channel',params:{channel_id:channel.id}} " class="bg-teal-dark flex items-center hover:opacity-100  cursor-pointer  rounded-l pl-6">
              <span class="lowercase"><b class="text-sm"></b># {{ channel.name}} </span>
            </router-link>
          </div>
        </div>
        <div class="px-4 flex justify-between items-center">
          <div class="text-md font-semibold opacity-75">MY SPACE</div>
          <div>
            <svg class="fill-current h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z" />
            </svg>
          </div>
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
            <div @click="$store.commit('layout/CREATE_CHANNEL_MODAL')" class="flex opacity-75 hover:opacity-100 items-center ">
              <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path class="heroicon-ui" d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z" /></svg> Add Channels</div>
            <div>
              <svg class="fill-current h-5 w-5 opacity-75 hover:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path class="heroicon-ui" d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z" />
              </svg>
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
import vueCustomScrollbar from 'vue-custom-scrollbar'
import TeamSettingsModal from '../teams/TeamSettingsModal'
import CreateChannelModal from '../channel/CreateChannelModal'
export default {
  name: "SideBarView",
  components: { vueCustomScrollbar, TeamSettingsModal, CreateChannelModal },
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
