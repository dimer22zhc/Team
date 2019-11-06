<template>
	<div>
		
	</div>
</template>
<script>
	import axios from 'axios'
	export default {
		middleware:'auth',
		name:"Switcher",
		async asyncData({params, redirect, store}){
			store.commit('layout/LOADING_TEAM')
			store.commit('channel/CLEANER')
			store.commit('team/CLEANER')
			redirect({name:'welcome-home', params:{team_id:params.team_id}})	
		}
	}
</script>