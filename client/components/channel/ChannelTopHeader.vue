<template>
  <div>
    <div class="border-b h-16 flex px-6 items-center flex-none">
      <div class="flex flex-col leading-tight h-10">
        <div class="flex flex-col" v-if="channel">
          <span  class="text-grey-darkest mb-1 text-black font-extrabold px-1 text-lg ">
            #{{ channel.name}}
          </span>
          <div >
            <ul class="flex font-semibold ml-3    items-center">
              <li class="pr-1 ">
                <a href="" @click.prevent="favorite" v-if="!channel.isFavorited">
                  <svg  style="stroke-width: .85em;" class=" cursor-pointer fill-current stroke-current" xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 546.55 546.55" height="16" viewBox="0 0 546.55 546.55" width="16">
                    <path xmlns="http://www.w3.org/2000/svg" d="M453.443,160.214l-119.7-8.6c-2.5-0.2-4.7-1.7-5.6-4.1l-45.6-111c-6.3-15.3-20.5-24.8-37.1-24.8s-30.7,9.5-37.1,24.9   l-45.7,111.1c-1,2.3-3.1,3.9-5.6,4.1l-119.5,8.6c-16.2,0.9-30,11.5-35.3,27.1c-5.4,15.8-0.9,32.4,11.9,43.3l92.5,76.4   c1.9,1.6,2.8,4.2,2.2,6.6l-28.2,115.4c-3.3,12-1,24.4,6.3,34.1c7.5,9.8,19.2,15.7,31.5,15.7c7.6,0,15-2.3,21.1-6.4l101.1-62.9   c2.1-1.3,4.8-1.3,6.9,0l102.1,62.7c6.4,4.3,13.8,6.6,21.3,6.6c11.5,0,22.9-5.5,30.3-14.8c7.7-9.6,10.5-22.1,7.7-34.6l-28.3-115.7   c-0.6-2.5,0.3-5.1,2.2-6.7l93.9-76.6c12.6-10.8,17.1-27.4,11.8-43.2C483.343,171.814,469.443,161.114,453.443,160.214z    M461.143,211.714l-93.7,76.5c-9.2,7.5-13.4,19.9-10.5,31.5l28.3,115.5c1.5,6.8-1.2,11.5-3,13.7c-2.8,3.5-7,5.7-11.2,5.7   c-2.6,0-5.2-0.8-8-2.7l-102.5-63c-4.9-3-10.5-4.6-16.3-4.6s-11.5,1.6-16.4,4.7l-101.5,63.1c-6.5,4.3-15.2,2.4-19.8-3.6   c-1.9-2.5-3.9-6.8-2.1-13.1l28.3-115.8c2.8-11.5-1.3-23.8-10.4-31.3l-92.3-76.3c-7.3-6.3-5.3-14.4-4.5-16.7s4.1-10,13.7-10.5   l119.7-8.6c11.8-0.9,22-8.2,26.5-19.2l45.7-111.1c3.7-9,12-9.7,14.4-9.7c2.4,0,10.7,0.7,14.4,9.7l45.7,111.1   c4.5,11,14.7,18.3,26.5,19.2l119.9,8.7c9.4,0.5,12.7,8.2,13.5,10.5C466.143,197.514,468.143,205.614,461.143,211.714z" />
                  </svg>
                </a>
                <a href="" @click.prevent="favorite" v-else>
                  <svg class="cursor-pointer fill-current text-yellow-500 stroke-current" style="stroke-width: .1em;"  xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                </a>
              </li>
              <li class="border-l px-1">
                <a href="" class="flex items-center">
                  <span> <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                      <path class="heroicon-ui" d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z" /></svg> </span><small>{{channel.members_count}}</small>
                </a>
              </li>
              <li class="border-l px-1">icon<a href=""></a></li>
              <li class="border-l px-1">icon<a href=""></a></li>
            </ul>
          </div>
        </div>
        <div class="text-grey-dark text-sm truncate" v-else>
          <div class='placeholder-input__loading'>
            <div class='placeholder-input__loading--line rounded'></div>
            <div class='placeholder-input__loading--line rounded'></div>
          </div>
        </div>
      </div>
      <div class="ml-auto leading-tight hidden md:block">
        <div class="flex">
          <a href="">
            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
              <path class="heroicon-ui" d="M13.04 14.69l1.07-2.14a1 1 0 0 1 1.2-.5l6 2A1 1 0 0 1 22 15v5a2 2 0 0 1-2 2h-2A16 16 0 0 1 2 6V4c0-1.1.9-2 2-2h5a1 1 0 0 1 .95.68l2 6a1 1 0 0 1-.5 1.21L9.3 10.96a10.05 10.05 0 0 0 3.73 3.73zM8.28 4H4v2a14 14 0 0 0 14 14h2v-4.28l-4.5-1.5-1.12 2.26a1 1 0 0 1-1.3.46 12.04 12.04 0 0 1-6.02-6.01 1 1 0 0 1 .46-1.3l2.26-1.14L8.28 4z" /></svg>
          </a>
          <a href="">
            <svg class="fill-current mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
              <path class="heroicon-ui" d="M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20zm0 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm0 9a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0v4a1 1 0 0 1-1 1zm0 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" /></svg>
          </a>
          <a href="">
            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
              <path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" /></svg>
          </a>
        </div>
      </div>
    </div>
    <slot></slot>  
  </div>
  
</template>
<script>
export default {
  props: { channel: { type: Object } },
  name: "ChannelTopHeader",
  methods:{
    favorite(){
      this.$store.dispatch('channel/favorChannel',{channel:this.$route.params.channel_id})
    }
  }

}

</script>
<style lang="scss" scoped>
@mixin nth-children($points...) {
  @each $point in $points {
    &:nth-child(#{$point}) {
      @content;
    }
  }
}

.placeholder-input__loading {
  &--line {
    height: 10px;
    margin: 5px;
    animation: pulse 1s infinite ease-in-out;
  }

  div {
    @include nth-children(1, 1, 5) {
      width: 150px;
    }

    @include nth-children(1, 2, 5) {
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
