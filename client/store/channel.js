import axios from 'axios'

export const state=()=>({
	channels:{},
})

export const getters={
	//single channel
	channel: function(state){
		return function(id){
			return state.channels[id]
		}
	},
	threads: function(state){
		return function (id) {
          let channel = state.channels[id]
          if (channel && channel.threads){
            return channel.threads
          }else{
            return []
          }
        }
	}
}

export const mutations={

	ADD_CHANNELS(state,{channels}){
		channels.forEach( function (c, index) {
	          let channel = state.channels[c.id] || {threads:[]}
	          channel = {...channel,...c}
	          state.channels = {...state.channels,...{[c.id]:channel}}
	        });
	},
	ADD_CHANNEL_THREADS(state,{threads,channelId}){
		let channel = state.channels[channelId] || {}
		channel.loaded = true
		// this gives an object with dates as keys

		const grouped_threads = threads.reduce((groups, t) => {
		  const date = t.created_at.split('T')[0];
		  if (!groups[date]) {
		    groups[date] = [];
		  }
		  groups[date].push(t);
		  return groups;
		}, {});

		channel.threads = grouped_threads
		state.channels = {...state.channels,...{[channelId]: channel}}
	},
	FAVOR_CHANNEL(state,{channelId}){
		let channel = state.channels[channelId]

		if (channel) {
			channel.isFavorited = !channel.isFavorited
		}
	},
	//add a threads to channel
	ADD_THREAD(state,{thread,channel}){
		let ts = state.channels[channel].threads[thread.created_at.split("T")[0]]
		if (ts) {
			 ts.push(thread)
		}else {
			state.channels[channel].threads = {
				...state.channels[channel].threads,
				...{[thread.created_at.split("T")[0]]:[thread]} 
			}

		}

	},
	//Update replies to sync reactivity
	ADD_REPLIES(state,{channel,thread,reply}){
		let t = state.channels[channel].threads[thread.created_at.split("T")[0]].find((t)=>{
			return t.id === thread
		})
		t ? t.replies.push(reply) : ''

	},
	ADD_ARCHIVE(state,{thread,channelId}){
		let ts = state.channels[channelId].threads[thread.created_at.split("T")[0]]
		ts.pop(-1)
		ts.push(thread)
	},
	DELETE_THREAD(state,{threadId,channelId,created_at}){
			let ts = state.channels[channelId].threads[created_at.split("T")[0]]
			ts.splice(ts.findIndex(t => t.id === threadId ),1)
	},
	EDIT_THREAD(state,{threadId,channelId,isPost,postDescription,created_at,content}){
		let t = state.channels[channelId].threads[created_at.split("T")[0]].find(t => t.id === threadId)
		console.log(threadId,channelId,isPost,postDescription,created_at,content);
		if (t) {
			isPost ? t.description = postDescription : t.body = content
		}

	},
	FAVORITE_THREAD_ACTIONS(state,{threadId,channelId,created_at}){
		let t = state.channels[channelId].threads[created_at.split("T")[0]].find(t =>  t.id === threadId)
		t ? t.isFavorited = !t.isFavorited : ''
	},
	SUBSCRIBE_THREAD_ACTIONS(state,{threadId,channelId,created_at}){
			let t = state.channels[channelId].threads[created_at.split("T")[0]].find(t => t.id === threadId)
			t ? t.isSubscribedTo = ! t.isSubscribedTo : ''
	},
	ADD_REACTION(state,{channelId,threadId,reaction}){
		let t = state.channels[channelId].threads.find((t)=> {
			return t.id === threadId
		});

		let r = t.reactions.find((r)=>{
			return  r.name === reaction
		})

		r ? r.count++ :
			t.reactions.unshift({name:reaction, count:1})

	},
	CLEANER(state){
		state.channels = {

		}
	}
}

export const actions={
	async addTeams({commit}){

		const {data} = await axios('/user/teams')
		commit("ADD_TEAMS",{teams:data})
	},
	async addChannels({commit},team){

		const {data} = await axios(`/user/${team}/channels`)
		commit("ADD_CHANNELS",{channels:data,team:team})
	},
	async createChannel({commit},channelData){
		const {data} = await axios.post('/channel/create',{channelData})
		commit("ADD_CHANNELS",{channels:[data]})
	},
	async loadThreads(context,channel){
		if (!context.getters['channel'](channel).loaded) {
			const {data} = await axios(`/channel/threads/${channel}`)
			context.commit("ADD_CHANNEL_THREADS",{threads:data,channelId:channel})
		}	
	},
	async addThread(context,{archive,thread,body,channel,description,title,type}){

		const {data} = await axios.post(`/thread/${channel}`,{
			body:body,
			description:description,
			title:title,
			type:type,
			archive:archive
		});
		context.commit("ADD_THREAD",{thread:data, channel:channel})
	},
	deleteThread({commit},{threadId,channelId,created_at}){
		commit("DELETE_THREAD",{
			threadId:threadId,
			channelId:channelId,
			created_at:created_at
		})
		axios.delete(`/thread/delete/${threadId}`)
	},
	subscribeToThread({commit},{channelId,threadId,isSubscribedTo,created_at}){
		commit("SUBSCRIBE_THREAD_ACTIONS",{threadId:threadId,channelId:channelId,created_at:created_at});
		let url = '/sub/'+threadId
  		axios[(isSubscribedTo ? 'delete' :'post')](url)
	},
	favorChannel(context,{channel}){
		context.commit('FAVOR_CHANNEL',{channelId:channel})
		let url = '/favorite-channel/'+ channel
  		axios[(!context.getters['channel'](channel).isFavorited ? 'delete' :'post')](url)
	},
	favoriteThread({commit},{channelId,isFavorited,threadId,created_at}){
		commit("FAVORITE_THREAD_ACTIONS",{threadId:threadId,channelId:channelId,created_at:created_at});
		let url = '/favorite/'+threadId
  		axios[(isFavorited ? 'delete' :'post')](url)
	},
	react({commit},{channel,thread,name}){

		commit("ADD_REACTION",{channelId:channel,threadId:thread,reaction:name})
  		axios.post(`react/${thread}`,{name:name})
	}
}
