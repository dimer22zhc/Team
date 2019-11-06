
import axios from 'axios'

export const state=()=>({
	thread:{},
})

export const getters={
	single_thread: function(state){
		return function(id){
			return state.thread[id] || {}
		}
	}
}


export const mutations = {
	ADD_SINGLE_THREAD(state,{thread}){
		let t = thread
		t.loaded = true
		thread.replies_count = thread.replies.length
		state.thread = {...state.thread,[t.id]:t}
	},
	ADD_REPLY(state,{reply,threadId}){
		state.thread[threadId].replies.push(reply)
	},
	DELETE_REPLY(state,{replyId, threadId}){
		try {
			// statements
			let rs = state.thread[threadId].replies
			rs.splice(rs.findIndex(r => r.id === replyId ),1)

		} catch(e) {
			// statements
			console.log(e);
		}
	}
}

export const actions = {
	async getSingleThread(context,{thread}){
		if (!context.getters['single_thread'](thread).loaded) {
			// console.log(thread)
			const {data} = await axios('/thread/'+thread)
			context.commit("ADD_SINGLE_THREAD",{thread:data})
		}
	},

	async createReply(context,{threadId,body}){
		const {data} = await axios.post('/reply/'+threadId,{body:body})
		context.commit("ADD_REPLY",{reply:data,threadId:threadId})
	},
	
	deleteReply({commit},{replyId,threadId}){
		commit('DELETE_REPLY',{replyId:replyId, threadId:threadId})
		axios.delete('reply/'+replyId);
	}

}
