<template>	
    <div  class="flex flex-col">
    	<!-- 	Hearder -->
      <div style="font-size: 26px" class="px-6 font-extrabold">
        <div class="font-semibold flex items-center hover:opacity-100 text-sm opacity-75">
          <span>
            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
              <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </svg>
          </span>
          <span class="cursor-pointer py-2">About Channels... </span>
        </div>
        <span @click="$store.commit('layout/CREATE_CHANNEL_MODAL')" class="absolute hover:text-gray-700 text-gray-500 right-0 top-0 p-5">
          <svg class="fill-current  cursor-pointer " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
            <path class="heroicon-ui" d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z" />
          </svg>
          <span>Close</span>
        </span>
      </div>
      <!-- 	end -->
      <br />
     
      <div class="mx-32 "> 
      	<!--Create channel section-->
        <div class="my-2 flex flex-row justify-between">
          <div>
            <span class="font-semibold text-2xl text-black">Browse Channels </span>
          </div>
          <div @click="$emit('createChannel',create)" class="flex items-center annimation hover:bg-green-600 hover:text-white px-4 py-1 rounded cursor-pointer font-semibold text-blue-800">
            <div class="px-1">
              <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-9h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2H9a1 1 0 0 1 0-2h2V9a1 1 0 0 1 2 0v2z" /></svg>
            </div>
            <span>Create Channel</span>
          </div>
        </div>
        <!--End Create channel section-->

        <!--Search channels section-->
        <div>
        	<div>
        		<span class="absolute z-10" style="margin: 10px"> 
        			<svg style="stroke-width:0.004rem " class="fill-current stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
        		</span>
             	<input  type="email" placeholder="Search channels" class="shadow-sm relative appearance-none border border-gray-600 focus:outline-none text-lg rounded w-full py-2 px-10 text-gray-700" style="font-size: 15px">
            </div>
            <div class=" flex text-sm items-center">	
				<div class="mx-3 flex items-center">	
					<span class="font-semibold px-1 text-black">Show: </span> 
					<span> All Channels</span> 
					<span> <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z"/></svg>	</span>
				</div>
				<div class="flex items-center">	
					<span class="font-semibold px-1 text-black" >Sort: </span> 
					<span> Channel name </span> 
					<span> <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z"/></svg>	</span>
				</div>
            </div>
        </div>
         <!--End Search channels section-->

         <!--Channels List section-->
		<div class="py-4 h-64 overflow-y-auto">	
			<div v-for="channel in channels" class="flex py-3 px-4 hover:bg-gray-100 justify-between items-center">	
				<div class="flex leading-tight">	
					<!-- Channel name and avatar -->
						<div class="pr-4">	
							<!-- 	Channel avatar  -->
							<div class=" flex items-center justify-center bg-green-300 h-10 w-10 rounded text-white">
	      			   				{{channel.name | initials}}
	          				</div>
						</div>
						<div>	
								<span>	# {{channel.name}}</span><br/>	
								<span>	# Public</span>
						</div>
					<!-- end-->
				</div>
				<div>	
					<!-- Number of members -->
					<div class=" flex items-center">	
						<svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path class="heroicon-ui" d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"/></svg>
						<span> 2	</span>
					</div>
					<!-- 	end  -->
				</div>
			</div>
		</div>
         <!--End channels List section-->

      </div>
    </div>
</template>

<script>	
export default {
	name:"BrowseChannels",
	data:()=>({
		create:true
	}),
	computed:{
		channels(){
			return this.$store.state.channel.channels;
		}
	}
}
</script>