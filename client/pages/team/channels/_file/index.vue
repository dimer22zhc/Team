<template>
  <div style="width: 35.3333%" class=" flex flex-col overflow-hidden">
    <div class="w-full bg-gray-200">
      <div class="flex px-4  py-2 justify-between items-center">
        <div class="leading-snug flex items-center">
          <router-link :tag="'button'" :to="{name:'files'}" class=" rounded hover:bg-gray-300 mr-2 p-1">
            <icon :classes="'fill-current opacity-100'" :width="25" :height="25" :name="'cheveron_left'" :viewBox="'0 0 24 24'" />
          </router-link>
          <div class="font-extrabold text-xl text-black">Files</div>
        </div>
        <div>
          <router-link :tag="'button'" class=" rounded hover:bg-gray-300 mr-2 p-1" :to="{name:$route.name === 'p-thread' ? 'post' : 'channel'}">
            <icon :classes="'fill-current opacity-100'" :width="25" :height="25" :name="'x'" :viewBox="'0 0 24 24'" />
          </router-link>
        </div>
      </div>
    </div>
    <a-spin :spinning="!Object.getOwnPropertyNames(file).length" tip="Loading...">
      <div class="h-screen">
        <div v-if="file.owner" class="flex px-4 py-2 justify-between items-center">
          <div class="">
            <div class="font-bold ">{{file.owner.name | name | capitalize}}</div>
            <div class="font-semibold text-sm">{{file.created_at}}</div>
            <div class="font-semibold text-sm">{{"Private file"}}</div>
          </div>
          <div class="flex p-1">
            <button href="#" class="mx-1 p-1 focus:bg-gray-200 focus:outline-none rounded-lg ">
              <icon :classes="'fill-current m-1 opacity-100 stroke-current'" :width="18" :height="18" :name="'edit'" :styles="'enable-background:new 0 0 546.55 546.55;stroke-width: 0.001em;'" :viewBox="'0 0 24 24'" />
            </button>
            <button href="#" class="mx-1 p-1 focus:bg-gray-200 focus:outline-none rounded-lg ">
              <icon :classes="'fill-current m-1 opacity-100 stroke-current'" :width="18" :height="18" :name="'share'" :styles="'enable-background:new 0 0 546.55 546.55;stroke-width: 1em;'" :viewBox="'0 0 546.55 546.55'" />
            </button>
            <button href="#" class="mx-1 p-1 focus:bg-gray-200 focus:outline-none rounded-lg ">
              <icon :classes="'fill-current m-1 opacity-100'" :width="18" :height="18" :name="'more'" :styles="'enable-background:new 0 0 60 60'" :viewBox="'0 0 60 60'" />
            </button>
          </div>
        </div>
        <div  v-if="file.owner" class="px-4">
          <div :style="'width: 345px'" class="p-2 relative border bg-white rounded-lg">
            <router-link :tag="'div'" :to="{name:'file', params:{file_id:file.id}}" class="flex cursor-pointer mb-1 items-center">
               <div class=" p-1">
                  <icon 
                    :classes="'fill-current opacity-100 ; text-green-600'" 
                    :width="46" 
                    :height="46" 
                    :name="'file'" 
                    :styles="'enable-background:new 0 0 60 60; stroke-width: 0.1em;'" 
                    :viewBox="'0 0 24 24'" />
               </div>
              <div class="leading-tight">
                <div class="font-bold mb-2 text-black">{{file.post.title | capitalize}}</div>
                <div class="text-sm">Last update {{file.updated_at}}</div>
              </div>
            </router-link>
            <div class="px-4">
	           <hr  class="pt-1" />
	           <div class="mt-1" v-html="file.post.content"></div>
	        </div>
          </div>
        </div>
      </div>
    </a-spin>
  </div>
</template>
<script>
import Icon from '~/components/icon/Icon'
export default {
  name: "File",
  components: { Icon },
  computed: {
    file() {
      return this.$store.getters['team/file'](this.$route.params.file_id)

    }
  },
  watch: {
    '$route.params.file_id': function() {
      var self = this
      self.fetchSingleFile()
    }
  },
  methods: {
    async fetchSingleFile() {
      var self = this
      await self.$store.dispatch('team/addFile', { fileId: this.$route.params.file_id })
    },
  },
  mounted() {
    this.fetchSingleFile()
  }
}

</script>
