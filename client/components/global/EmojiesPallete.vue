<template>
	<div class="absolute mr-10 right-0 popover rounded bg-gray-100 border border-gray-400" style="top: -40px; height:auto;  width: 45vh; z-index: 99999">
      <ul class="float-left items-center px-1" v-for="emoji in emojies">
        <li class="text-lg p-1 hover:bg-gray-300 rounded-full cursor-pointer" 
        @click="addReactions(emoji.aliases[0])">
          {{emoji.emoji}}
        </li>
      </ul>
    </div>
</template>
<script>
	export default{
		props:{thread:{type:Object}},

		name:"EmojiesPallete",
		data:()=>({
			 emojies: '',
		}),

		mounted(){
			this.emojies = this.$store.state.emojies.emojies.slice(-56)
		},
		methods:{
			addReactions(emoji){
			        this.$store.dispatch('channel/react',{
			          channel:this.thread.channel_id,
			          thread:this.thread.id,
			          name:emoji
			      })
		    }
		}

	}
</script>