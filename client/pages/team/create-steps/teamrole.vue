<template>
	<div>
		<div class="flex flex-row">
			<div class="h-screen w-1/2">
				<form @submit.prevent="createWorkplaceName" @keydown="form.onKeydown($event)" class="flex flex-col pl-56 pr-8 py-16 justify-center">
					<div style="font-size: 26px" class=" py-6 text-black font-extrabold">
						What kind of work do you do?
					</div>
					<div  class=" flex flex-col">
						<span class="sm:opacity-75 mb-1 text-black font-semibold">Select the field that best describes your work.</span>
						 <a-select
						    placeholder="Please select an option"
						    :class="'w-full text-gray-700 rounded opacity-75'"
						     @change="handleChange"
						    size="large"
						  >
						    <a-select-option value="Customer support">Customer support</a-select-option>
						    <a-select-option value="Engeneering">Engeneering</a-select-option>
						    <a-select-option value="Human Ressources">Human Ressources</a-select-option>
						    <a-select-option value="IT">IT</a-select-option>
						    <a-select-option value="Marketing">Marketing</a-select-option>
						    <a-select-option value="Project Management">Project Management</a-select-option>
						    <a-select-option value="Sales">Sales</a-select-option>
						    <a-select-option value="Other">Other</a-select-option>
						  </a-select> 		
					</div>
					<div class=" h-56" >
						<div class="pt-10" v-if="isNameFilled">
							<p class="font-semibold">Which tools do you use?</p>
							<p>Once you’re up and running, we’ll help you install them.</p>
						</div>
					</div>
					<div class="mb-4">
						<button :disabled="!isNameFilled"
						 :class="isNameFilled? 'bg text-white':'cursor-not-allowed disabled opacity-75 text-black bg-gray-500'" class=" shadow-sm text-xl font-bold py-2  appearance-none  border rounded w-full px-3 ">
			      			Continue 
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
		name:"Team-Role",
		data:()=>({
			form:new Form({
				type:''
			})
		}),
		computed:{
			isNameFilled:function(){
				return !!this.form.type
			}
		},
		methods:{
			async createWorkplaceName(){
				try {
					// statements
					await this.form.post('user/team');
					this.$router.push({name:'teamtada'})
				} catch(e) {
					// statements
					console.log(e);
				}
				
			},
			handleChange (value) {
		      this.form.type = value
		    },
		    
		}
	}
</script>
<style scoped>
	.bg{
		background: #007a5a
	}
	.ant-select-selection{
		border: 1px solid #676161;
	}
</style>