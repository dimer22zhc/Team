<template>
  <div class="relative">
  	<!-- Hearder -->
    <!-- 	end -->
     <div class=" relative "> 
	     <div @click="$store.commit('layout/CREATE_CHANNEL_MODAL')" class="absolute mr-2 mt-4 font-semibold text-sm opacity-75 hover:opacity-100 right-0 top-0">
	        <svg class="fill-current text-gray-500 cursor-pointer hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
	          <path class="heroicon-ui" d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z" />
	        </svg>
	     </div>
      	<!--Create channel section-->
    	  <div class=" px-10 py-1 mb-3">
           <span class="font-semibold text-4xl"> Create Channel </span>
        </div>
        <div style="height: 400px" class=" px-10  overflow-y-auto overflow-x-hidden" id="custom-scroll-bar">
            <div class="mb-6">
              <p class="text-justify">Channels are where your members communicate. They're best when organized around a topic - #proj-budget, for example.. <a href="" class=" hover:underline text-blue-500"> Learn more</a>.</p>
            </div>
            <div v-for="input in inputs" class="py-1">
        		<label for="email" class="font-semibold">
        			{{input.label}}
        			<span class="text-black text-xs opacity-75">{{input.optional ? "(optional)" :''}}</span>
        		</label>
             	<input v-model="input.input"  type="email" :placeholder="input.placeholder" class="shadow-sm relative appearance-none border border-gray-600 focus:outline-none text-lg rounded w-full py-2 px-4 text-gray-700" style="font-size: 15px">
             	<span class=" text-xs font-semibold text-black opacity-75" v-text="input.note"></span>
            </div>
            <div class="my-4">
            	<div class="flex justify-between">
            		<div class="w-3/4 leading-tight">
            			<h1 class="font-semibold">Make private</h1>
            			<p>When a channel is set to private, it can only be viewed or joined by invitation.</p>
            		</div>
            		<div class="">
            			<div class="flex">
			                <a-switch :defaultChecked="false">
			                    <a-icon type="check" slot="checkedChildren"/>
			                    <a-icon type="close" slot="unCheckedChildren"/>
			                  </a-switch> 
			              </div>
            		</div>
            	</div>
            </div>
            <div class="mb-8 bg-white flex justify-end">
              <button class="border mx-6 border-gray-300 px-4 py-1 rounded font-semibold">
                Cancel
              </button>
              <button @click="CreateChannel" class="bg-green-600 text-white px-4 py-1 rounded font-semibold">
                Create
              </button>
            </div>
        </div>
        
    </div>
    
  </div>
</template>
<script>
export default {
  name: "CreateChannel",
  data:()=>({
  	inputs:[
  		{
  			input:"",
  			label:"Name",
  			type:"text",
  			optional: false,
  			placeholder:"# eg Marketing"
  		},
  		{
  			input:"",
  			label:"Description",
  			optional: true,
 
  			type:"text",
  			note:"What’s this channel about?.",
  			placeholder:""
  		},
  	],
  	show:false
  }),

  methods:{
  	async CreateChannel(){
  		this.$store.dispatch('channel/createChannel',{
  			channel:{
  				name:this.inputs[0].input,
  				description: this.inputs[1].input,
  			},
  		})
  	}
  }
}

</script>
