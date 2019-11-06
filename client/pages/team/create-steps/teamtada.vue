<template>
	<div>
		<div class="flex flex-row">
			<div class="h-screen w-1/2">
				<div class="flex flex-col pl-56 pr-8 mt-40 justify-center">
					<div style="font-size: 26px" class=" py-6 text-black font-extrabold">
						Tada! Meet your team’s first channel: #marketing
					</div>
					<div  class=" flex flex-col mb-4">
						<span class="sm:opacity-75 mb-1 text-black ">A channel brings together every part of your project – the people, conversations, ideas, updates, and files – so your team can move forward and get more done.</span>
								
					</div>

					<div class="mb-4" v-if="!!team">
						<button @click="$router.push({name:'welcome-home',params:{team_id:team}})" class="bg text-white shadow-sm text-xl font-bold py-2  appearance-none  border rounded w-full px-3 ">
			      			See your channel in Team 
			      		</button>
					</div>
				</div>
			</div>
			<div class="h-screen bg-gray-200 w-1/2">
				
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		name:"Tada",
		async asyncData({store, params}){
			
			return {team:store.state.auth.user.current_team_id}
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