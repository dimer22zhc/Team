import axios from 'axios'


export function getUserTeams(){
	return axios('/user/teams').then(({data})=>{
		data
	})
} 