import axios from 'axios'
import {getUserTeams} from  './../z_api/team_api.js'
export const state=()=>({
	teams:{},
	isFilesLoaded:true,
	files:{},
	allFiles:[],
})

export const getters={
	//single team

	team: function(state){
		return function(id){
			return state.teams[id]
		}
	},
	isFilesLoaded: function(state){
		return state.isFilesLoaded 
	},
	file: function(state){
		return function(id){
			return state.files[id] || {}
		}
	},

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

		ADD_FILE(state,{files,allFiles}){
			allFiles ? state.isFilesLoaded = false : ''
			files.reverse().forEach( function(f, index) {
				// statements
				f.loaded = true
				state.files = {...state.files,[f.id]:f}
			});
			
		},

		ADD_FILES(state,{files,allFiles}){
			allFiles ? state.isFilesLoaded = false : ''
			state.allFiles = files.reverse()
			
		},
}

export const actions={

	async addTeams(context, team){
		const {data} = await axios('/user/teams')
		context.commit("ADD_TEAMS",{teams:data})
	},
	async addFile(context, {fileId}){
		if (!context.getters['file'](fileId).loaded) {
			const {data} = await axios('/file/'+fileId)
			context.commit("ADD_FILE",{files:[data]})
		}
	},
	async addFiles(context){
		console.log(!context.getters['isFilesLoaded'])
		if (context.getters['isFilesLoaded']) {
			const {data} = await axios('/files')
			context.commit("ADD_FILES",{files:data,allFiles:true})
		}
		
	}
}