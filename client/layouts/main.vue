<template>
  <div class="antialiased h-screen flex">
    <!-- Sidebar / channel list -->
    <div
      @click="$store.commit('layout/POPOVER_OVERLAY_FALSE')" 
      class="bg-white opacity-0 z-10 fixed w-full h-screen"
      v-if="$store.state.layout.isLunchPopoverOverlay">

    </div>
    <div
      class="bg-_c1_d text-purple-lighter flex-none w-12 p-2 hidden md:block ">
      <div class="cursor-pointer">
        <div class="bg-white opacity-25 h-6 w-6 flex items-center hover:opacity-75 justify-center text-black text-2xl font-semibold rounded-lg mb-1 overflow-hidden">
          <svg class="fill-current h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z" /></svg>
        </div>
      </div>
    </div>
    <side-bar />
    <!-- Chat content -->
    <nuxt />
    <!-- <div class="bg-_c1_d text-purple-lighter flex-none w-12 p-2 hidden md:block ">
      <div class="cursor-pointer">
        <div class="bg-white opacity-25 p-2 flex items-center hover:opacity-75 justify-center text-black text-2xl font-semibold rounded-lg mb-1 overflow-hidden">
          <svg class="fill-current h-4 w-4 block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z" /></svg>
        </div>
      </div>
    </div> -->
  </div>
</template>
<script>
import SideBar from '~/components/side-bar/index.vue'
import RightBar from '~/components/right-bar/index.vue'
export default {
  components: {
    SideBar,
    RightBar
  },
  computed: {
    teams: function() {
      return this.$store.state.team.teams
    },
    current_team: function() {
      return this.$store.getters['team/team'](this.$route.params.team_id)
    },
  },
}

</script>
<style>
.teams-button {
  justify-content: center;
  align-items: center;
  width: 34px;
  height: 34px;
  text-decoration: none;
  line-height: 1;
  font-size: 20px;
  font-weight: 700;
}

</style>
