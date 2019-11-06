<template>
	<div v-if="user" class="flex-1 justify-center items-center">
		{{"Danger"}} 
	</div>
</template>

<script>
	import axios from 'axios'
	export default{ 
		name:"User-Teams",
		middleware ({ store, redirect }) {
		    // If the user is not authenticated
		    if (!store.state.auth.token) {
		      return redirect({name:'getStarted'})
		    }
		 },
		async asyncData({store, redirect}){
			const user =  await store.getters['auth/user']	
			redirect({name:'welcome-home', params:{team_id:user.current_team_id}})		
			return {  user:user }
		},
	}
</script>