<template>
	<div @mouseover="option=true" @mouseleave="option=false" >
      	<div  v-if="!remove" class="flex border-b items-center " :class="member.team_owner ? ' bg-yellow-200 text-black': 'hover:bg-gray-100' ">
      		<div class=" flex items-center w-4/5 ">
      			<div class="flex items-center py-1 px-4 w-1/2">
      				  <div :style="{backgroundColor: randomColor(member.id)}" class=" flex items-center justify-center h-8 w-8 rounded text-white">
      			   {{member.email | initials}}
          			</div>
          			<div class="font-semibold px-2 leading-tight">
                  <span class="px-1">{{member.name | name}}</span>
                  <div v-if="member.team_owner" class="flex items-center"> 
                    <span>  
                        <svg class="fill-current text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/></svg>
                    </span>
                    <span class="font-semibold text-xs">Team Owner  </span>
                  </div>
          			</div>
      			</div>
      			<div class="text-xs flex items-center ">
      				<div class="pr-20">
      					{{member.email}}
      				</div>
      			</div>
      		</div>
      	
      	</div>
      	<div class="flex items-center py-2 pl-6 bg-gray-100 text-xs" v-else>
      		<span>Only choose this option if you want to remove {{member.email}} from all tasks.</span> <span class="text-red-600 cursor-pointer px-1 border-b border-dotted  border-red-600 "> Remove from team </span> | <span class="border-b cursor-pointer border-dotted border-gray-700 px-1"> Cancel</span>
      	</div>
      </div>
</template>	
<script>
	export default{
		props:{member:{type:Object}},
		name:"TeamMember",
		data:()=>({
			remove:false,
			option:false,
      colorCache: {}
		}),
    methods:{
      randomColor(id) {
        const r = () => Math.floor(256 * Math.random());
        return this.colorCache[id] || (this.colorCache[id] = `rgb(${r()}, ${r()}, ${r()})`);
      }
    }
	}
</script>