<template>
	<div>
		<div class="flex flex-row">
			<div class="h-screen w-1/2">
				<form @submit.prevent="createWorkplaceName" @keydown="form.onKeydown($event)" class="flex flex-col pl-56 pr-8 py-16 justify-center">
					<div style="font-size: 26px" class=" py-6 text-black font-extrabold">
						Who else is working on this project?
					</div>
					<div v-for="invite in form.invitesTo " :key="invite.id" class=" flex items-center">
						<input  type="text" v-model="invite.email" placeholder="name@example.com" class="shadow-sm appearance-none border border-gray-900 focus:outline-none rounded w-full py-2 px-3 text-gray-700" style="font-size: 15px">
						<div class="mx-2">
							<span class=" p-1 px-3    ">
                          		<svg class="fill-current hover:bg-gray-200 rounded cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"/>
                          		</svg>
                        	</span>
						</div>
			      		
					</div>
					<div class="flex justify-end mb-3 cursor-pointer">
						<div class="flex items-center text-blue-800">
							<span class="icon ">
								<svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22"><path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-9h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2H9a1 1 0 0 1 0-2h2V9a1 1 0 0 1 2 0v2z"/></svg>
							</span>
							<span class="font-semibold">
								Add Teammates
							</span>
						</div>
					</div>
					<div class="mb-4">
						<button :disabled="!isNameFilled"
						 :class="isNameFilled? 'bg text-white':'cursor-not-allowed disabled opacity-75 text-black bg-gray-500'" class=" shadow-sm text-xl font-bold py-2  appearance-none  border rounded w-full px-3 ">
			      			Next 
			      		</button>
					</div>
					<div class="text-sm text-blue-800 cursor-pointer focus:shadow flex justify-start my-2 font-semibold">
						<span>
							<svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22"><path class="heroicon-ui" d="M19.48 13.03A4 4 0 0 1 16 19h-4a4 4 0 1 1 0-8h1a1 1 0 0 0 0-2h-1a6 6 0 1 0 0 12h4a6 6 0 0 0 5.21-8.98L21.2 12a1 1 0 1 0-1.72 1.03zM4.52 10.97A4 4 0 0 1 8 5h4a4 4 0 1 1 0 8h-1a1 1 0 0 0 0 2h1a6 6 0 1 0 0-12H8a6 6 0 0 0-5.21 8.98l.01.02a1 1 0 1 0 1.72-1.03z"/></svg>
						</span>
						<span>
							Get an invites link to chare
						</span>
					</div>
					<div class="flex justify-center my-4" style="font-size: 15px">
						<span>or</span>, <router-link :tag="'span'" :to="{name:'teamrole'}" class="font-semibold hover:underline cursor-pointer text-blue-800">skip for now</router-link>
					</div>
				</form>
			</div>
			<div class="h-screen bg-gray-200 w-1/2">
				
			</div>
		</div>
	</div>
</template>
<script>
	import Form from 'vform'
	import axios from 'axios'
	export default{
		middleware:['auth'],
		layouts:'default',
		name:"Team-Name",
		data:()=>({
			form:new Form({
				invitesTo:[
					{id:1,email:''},
					{id:2,email:''},
					{id:3,email:''},
				]
			})
		}),
		computed:{
			isNameFilled:function(){
				return !!this.form.invitesTo[0].email
			}
		},
		methods:{
			async createWorkplaceName(){
				try {
					// statements
					await this.form.post('user/team');
					this.$router.push({name:'teamchannel'})
				} catch(e) {
					// statements
					console.log(e);
				}
				
			}
		}
	}
</script>
<style scoped>
	.bg{
		background: #007a5a
	}
</style>