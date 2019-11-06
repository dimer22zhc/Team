<template>
  <div>
    <a-modal :width="550" :footer="false" :destroyOnClose="true" :closable="false" :maskClosable="false" centered v-model="$store.state.layout.visibleTeamSettingsModal">
      <div >
        <div style="font-size: 26px" class="flex mb-4 items-center justify-between px-6 font-extrabold">
         <span @click="$store.commit('layout/TEAM_SETTINGS')" class="absolute right-0 top-0 p-1"><svg class="fill-current text-gray-500 cursor-pointer hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36"><path class="heroicon-ui" d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z"/></svg></span>
        </div>
          <div v-if="isLoading" class="px-6" >
              <div>
                <div class=" flex justify-start font-bold mb-3 text-4xl">Invite People to</div>
                <div class="flex items-center justify-start">
                  <div class="px-1 w-1/2">
                    <label for="email" class="font-semibold">Email</label>
                    <input  v-model="form.email" type="email" placeholder="name@example.com" class="text-lg shadow-sm appearance-none border border-gray-600 py-2 focus:outline-none rounded w-full py-1 px-3 text-gray-700">
                    <has-error class="text-red-600 font-semibold text-xs italic" :form="form" field="email" />
                  </div>
                  <div class="px-1 w-1/2">
                    <label for="name" class="font-semibold">Name (OPTIONAL)</label>
                    <input type="text" placeholder="name" class="text-lg shadow-sm appearance-none border border-gray-600 focus:outline-none rounded w-full py-2 px-3 text-gray-700">
                  </div>
                </div>
              </div>
              <div class="m-2 flex justify-end">
                <button @click="invite" :disabled="!isNameFilled " :class="isNameFilled? 'bg text-white':'cursor-not-allowed disabled opacity-75 text-black bg-gray-500'" class=" shadow-sm font-bold  appearance-none  border rounded px-4 py-1">
                  Send invite
                </button>
              </div>
          </div>
		      <div v-if="isLoading" class="h-64 overflow-y-auto">
	        	<div v-for="member in members">
	        		<team-member :member="member"></team-member>
	        	</div>
	        </div>
	        <div class="py-12 flex justify-center" v-else>
	        	<a-spin size="large" />
	        </div>
      </div>
    </a-modal>
  </div>
</template>
<script>
import Form from 'vform'
import axios from 'axios'
export default {
  name: "TeamSettingsModal",
  data: () => ({
    form: new Form({
      email:'',
      name:''
    }),
    size:'small',
    isLoading:false,
    disabled:false,
    members:[],
  }),
  computed: {
    isNameFilled: function() {
      return !!this.form.email
    }
  },
  async mounted(){
  	this.isLoading = false
  	const {data} = await axios.get('/members/'+ this.$route.params.team_id)

  	data.forEach((d, index)=> {
  		// statements
  		this.members.push(d)
  	});

  	this.isLoading = true
  },
  methods:{
  	async invite(){

  		let member ={id:this.form.email, email:this.form.email}

      const {data} = await this.form.post('/invite/'+ this.$route.params.team_id)

      this.form.reset()

      if (data.status === 0) {

        return

      }

      this.members.push(member)

  	}
  }

}

</script>
<style scoped>
	.bg{
		background: #007a5a
	}
</style>
