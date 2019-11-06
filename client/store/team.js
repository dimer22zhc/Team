import axios from 'axios'
import {getUserTeams} from  './../z_api/team_api.js'
export const state=()=>({
	teams:{},
})

export const getters={
	//single team
	team: function(state){
		return function(id){
			return state.teams[id]
		}
	}
}

export const mutations={
		ADD_TEAMS(state,{teams}){
			teams.forEach( function (t, index) {
	          let team = state.teams[t.id] || {}
	          team = {...team,...t}
	          team.loaded = true
	          state.teams = {...state.teams,...{[t.id]:team}}
	        });
		}, 
}

export const actions={

	async addTeams(context, team){
		const {data} = await axios('/user/teams')
		context.commit("ADD_TEAMS",{teams:data})
	}
}