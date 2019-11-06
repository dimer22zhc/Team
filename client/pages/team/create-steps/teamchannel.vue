<template>
	<div>
		<div class="flex flex-row">
			<div class="h-screen w-1/2">
				<form @submit.prevent="createChannel" @keydown="form.onKeydown($event)" class="flex flex-col pl-56 pr-8 py-32 justify-center">
					<div style="font-size: 26px" class=" py-6 text-black font-extrabold">
						What’s a project your team is working on?
					</div>
					<div class="mb-4">
						<input  type="text" v-model="form.channel_name" placeholder="Ex. Marketing or Q4 Budget or Software update..." class="shadow-sm mb-3 appearance-none border border-gray-900 focus:outline-none rounded w-full py-3 my-2 px-3 text-gray-700" style="font-size: 15px">
			      		
					</div>
					<div class="mb-4">
						<button :disabled="!isNameFilled"
						 :class="isNameFilled? '':'cursor-not-allowed disabled opacity-75'" class=" shadow-sm text-xl font-bold py-2  appearance-none bg border rounded w-full px-3 text-white">
			      			Next 
			      		</button>
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
		name:"Team-Channel",
		data:()=>({
			form:new Form({
				channel_name:''
			})
		}),
		computed:{
			isNameFilled:function(){
				return !!this.form.channel_name
			}
		},
		methods:{
			async createChannel(){
				try {
					// statements
					await this.form.post('user/team');
					this.$router.push({name:'teaminvites'})
				} catch(e) {
					// statements
					console.log(e);
				}
				
			}
		},
	}
</script>
<style scoped>
	.bg{
		background: #007a5a
	}
</style>