<template>
  <nuxt/>
</template>
<script>
  import axios from 'axios'
export default {
  middleware: 'auth',
  layout: 'main',
  head() {
    return { title: this.$t('home') + " | "+ this.name }
  },
  data:()=>({
    isLoading:false,
    name:"Name"
  }),
  watch:{
    '$route.params.team_id':function(){
      // this.loadLoadTeamsChannels()
      axios.patch('user/switch/'+this.$route.params.team_id)

    },
  },
  async fetch({params,store}){
    await store.dispatch('team/addTeams',params.team_id)
    await store.dispatch('channel/addChannels',params.team_id)
    let name = await store.getters['team/team'](params.team_id).name
    await store.dispatch('threads/addSubThreads')
  }
}

</script>

<style lang="scss">
  @mixin nth-children($points...) {
    @each $point in $points {
        &:nth-child(#{$point}) {
            @content;
        }
    }
}

.text-input__loading {
    &--line {
        height: 10px;
        margin: 5px;
        animation: pulse 1s infinite ease-in-out;
    }

    div {
        @include nth-children(1, 2, 5) {
            width: 150px;
        }
        @include nth-children(2, 10, 10) {
            width: 150px;
        }

    }
}

@keyframes pulse {
    0% {
        background-color: rgba(165, 165, 165, 0.1)
    }
    50% {
        background-color: rgba(165, 165, 165, 0.3)
    }
    100% {
        background-color: rgba(165, 165, 165, 0.1)
    }
}
</style>
