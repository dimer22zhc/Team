<template>
  <div class="flex flex-1 overflow-hidden">
    <div class="flex flex-col flex-1">
      <div class="flex-1 flex flex-col bg-white overflow-hidden " style=" font-size: 15px">
        <div class="border-b h-16 px-6 items-center">
        	<div class="flex items-center mt-3 justify-between">

	        	<div class="flex  flex-col leading-tight">
	        	  <div class="ml-16 font-extrabold">{{!inputs[0].input ? 'Untitled': inputs[0].input}}</div>
	        	  <div class="flex items-center leading-tight"> 
	        	  	<a-switch :defaultChecked="false">
		                <a-icon type="check" slot="checkedChildren" />
		                <a-icon type="close" slot="unCheckedChildren" />
		            </a-switch>
	        	  	<div class="font-semibold ml-3 text-sm">Private post</div>
	        	  </div>
	             
	            </div>
	            <div>
                  <router-link :tag="'button'" :to="{name:$route.params.thread_id?'single-thread':'channel'}" class="border mx-6 border-gray-300 px-4 py-1 rounded font-semibold">
                    Back
                  </router-link>
                  <button @click="createPost" class="bg-green-600 text-white px-4 py-1 rounded font-semibold">
                    Share
                  </button>
                </div>
        	</div>
        </div>
        <div class="flex flex-1 relative overflow-hidden">
          <div class="flex flex-col flex-1 overflow-hidden">
            <div id="messageBox" class="flex  flex-1 overflow-y-auto overflow-x-hidden border-r  flex-col">
              <div class="flex justify-center">
                <div class=" relative ">
                  <!--Create channel section-->
                  <div class=" px-10 py-1 mb-3">
                    <span class="font-semibold text-4xl"> Create Post </span>
                  </div>
                  <div class=" px-10">
                    <div v-for="input in inputs" class="py-1">
                      <label for="email" class="font-semibold">
                        {{input.label}}
                        <span class="text-black text-xs opacity-75">{{input.optional ? "(optional)" :''}}</span>
                      </label>
                      <input v-model="input.input" type="email" :placeholder="input.placeholder" class="shadow-sm relative appearance-none focus:outline-none text-lg rounded w-full py-2 px-4 text-gray-700" style="font-size: 15px">
                      <span class=" text-xs font-semibold text-black opacity-75" v-text="input.note"></span>
                    </div>
                    <div>
                      <text-editor @data="html=$event" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Something here -->
          </div>
          <!--Thread input-->
          <nuxt-child />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "CreatePost",
  data: () => ({
    inputs: [{
        input: "",
        label: "",
        type: "text",
        optional: false,
        placeholder: "Add Post title"
      },
      {
        input: "",
        label: "",
        optional: true,

        type: "text",
        note: "What’s this post about?.",
        placeholder: "Add a description"
      },
    ],
    html: '',
    show: false,
  }),
  methods: {
    createPost() {
      this.$store.dispatch('channel/addThread', {
        reactions: [],
        title: this.inputs[0].input,
        description: this.inputs[1].input,
        type: "post",
        body: this.html,
        channel: this.$route.params.channel_id
      })
    }
  }
}

</script>
