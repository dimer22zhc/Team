<template>
	<div>
		<div class="flex flex-row">
			<div class="h-screen w-1/2">
				<form @submit.prevent="createWorkplaceName" @keydown="form.onKeydown($event)" class="flex flex-col pl-56 pr-8 py-32 justify-center">
					<div style="font-size: 26px" class=" py-6 text-black font-extrabold">
						What's the name of your company or team?
					</div>
					<div class="mb-4">
						<input  type="text" v-model="form.name" placeholder="Ex. Asrams or Asrams Marketing" class="shadow-sm mb-3 appearance-none border border-gray-900 focus:outline-none rounded w-full py-3 my-2 px-3 text-gray-700" style="font-size: 15px">
			      		
					</div>
					<div class="mb-4">
						<button :disabled="!isNameFilled"
						 :class="isNameFilled? '':'cursor-not-allowed disabled opacity-75'" class=" shadow-sm text-xl font-bold py-2  appearance-none bg border rounded w-full px-3 text-white">
			      			Next 
			      		</button>
					</div>
					<div class="text-sm">
						<p>
							By continuing, you're agreeing to our <a href="#" class="text-blue-700 font-s"> Customer Terms of Service</a>, <a href="#" class="text-blue-700 font-s"> Privacy Policy</a>, and <a href="#" class="text-blue-700 font-s">Cookie Policy</a>.
						</p>
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
				name:''
			})
		}),
		computed:{
			isNameFilled:function(){
				return !!this.form.name
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