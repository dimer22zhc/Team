<template>
  <div style="width: 35.3333%" class=" flex flex-col overflow-hidden">
    <div class="w-full bg-gray-200">
      <div class="flex px-4  py-2 justify-between items-center">
        <div class="leading-snug flex items-center">
          <div class="font-extrabold text-xl text-black">Files</div>
        </div>
        <div>
          <button class=" rounded hover:bg-gray-300 mr-2 p-1">
            <icon :classes="'fill-current opacity-100'" :width="25" :height="25" :name="'x'" :viewBox="'0 0 24 24'" />
          </button>
        </div>
      </div>
      <div class="px-4">
        <select name="" id="" class="w-full border my-1 border-black px-4 py-2 rounded font-bold ">
          <option value="">Show all file types</option>
        </select>
        <select name="" id="" class="w-full border border-black mb-2 px-4 py-2 rounded font-bold ">
          <option value="">Show all file types</option>
        </select>
      </div>
      <div>
      </div>
    </div>
    <div class="overflow-y-scroll">
      <div v-for="file in files">
        <div @mouseover="isHoverPost=true" @mouseleave="isHoverPost=false" 
          style="width: 350px" class="p-2 relative border bg-white m-2 rounded-lg">
          <div style="top:5px; right:10px">
            <div>
              <div class="flex bg-white">
                <button href="#" class="mx-1 p-1 focus:bg-gray-200 focus:outline-none rounded-lg hover:bg-gray-100  border">
                  <icon :classes="'fill-current m-1 opacity-100 stroke-current'" :width="16" :height="16" :name="'edit'" :styles="'enable-background:new 0 0 546.55 546.55;stroke-width: 0.001em;'" :viewBox="'0 0 24 24'" />
                </button>
                <button href="#" class="mx-1 p-1 focus:bg-gray-200 focus:outline-none rounded-lg hover:bg-gray-100  border">
                  <icon :classes="'fill-current m-1 opacity-100 stroke-current'" :width="16" :height="16" :name="'share'" :styles="'enable-background:new 0 0 546.55 546.55;stroke-width: 1em;'" :viewBox="'0 0 546.55 546.55'" />
                </button>
                <button href="#" class="mx-1 p-1 focus:bg-gray-200 focus:outline-none rounded-lg hover:bg-gray-100  border">
                  <icon :classes="'fill-current m-1 opacity-100'" :width="16" :height="16" :name="'more'" :styles="'enable-background:new 0 0 60 60'" :viewBox="'0 0 60 60'" />
                </button>
              </div>
            </div>
          </div>
          <router-link :tag="'div'" :to="{name:'file', params:{file_id:file.id}}" class="flex cursor-pointer items-center">
            <div class=" p-2">
              <svg class="fill-current strok text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="34" height="34">
                <path class="heroicon-ui" d="M6 2h9a1 1 0 0 1 .7.3l4 4a1 1 0 0 1 .3.7v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2zm9 2.41V7h2.59L15 4.41zM18 9h-3a2 2 0 0 1-2-2V4H6v16h12V9zm-2 7a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm0-4a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm-5-4a1 1 0 0 1-1 1H9a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1z" /></svg>
            </div>
            <div class="leading-tight">
              <div class="font-bold text-black">{{file.post.title | capitalize}}</div>
              <div class="text-sm">Last update {{update_ago(file.updated_at)}}</div>
            </div>
          </router-link>
        </div>
      </div> 
    </div>
  </div>
</template>
<script>
import moment from 'moment'
import Icon from '~/components/icon/Icon'
export default {
  name: "Files",
  components: { Icon },
  data:()=>({
    showPost : false,
    isHoverPost: false
  }),
  computed: {
    files() {
      return this.$store.state.team.allFiles
    }
  },
  methods:{
    ago(date) {
      return moment(date).calendar()
    },
    update_ago(date) {
      return moment(date).fromNow()
    },
  },
  mounted() {
    this.$store.dispatch('team/addFiles')
  },



}

</script>
