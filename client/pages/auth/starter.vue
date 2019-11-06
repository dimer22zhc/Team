<template>
  <div>
    <div class="flex justify-center">
      <div class="shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col w-1/3">
      	<p class="font-bold mb-1 text-3xl">Start with a workspace</p>
      	<p style="font-size: 15px">In Slack, everything happens in a workspace. Like a virtual office building, a workspace is where your team can gather in Slack to communicate and get work done.</p>
      	<hr class="text-gray-600 my-5" />

      	<div>
      		<div class="flex justify-between items-center cursor-pointer">
      			<div class="flex items-center">
	      			<div>
	      				<button class="text-white bg-purple-600 p-1 rounded">
	      					<svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
	      				</button>
	      			</div>
	      			<div class="leading-tight px-2">
	      				<p class="font-semibold mb-0 text-lg">Find your workplace</p>
	      				<p class="">Join or sign in to existing workplaces</p>
	      			</div>
      			</div>
      			<div class="">
      				<svg class=" fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="26" height="26"><path class="heroicon-ui" d="M9.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z"/></svg>
      			</div>
      			
      		</div>
      	</div>
      	<hr class="text-gray-600 my-5" />

      	<router-link :to="{name:'get-started-create'}">
      		<div class="flex justify-between items-center cursor-pointer">
      			<div class="flex items-center">
	      			<div>
	      				<button class="text-white bg-teal-800 p-1 rounded">
	      					<svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/></svg>
	      				</button>
	      			</div>
	      			<div class="leading-tight px-2">
	      				<p class="font-semibold mb-0 text-lg">Create new workplace</p>
	      				<p class="">Add your company and organization to App</p>
	      			</div>
      			</div>
      			<div class="">
      				<svg class=" fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M9.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z"/></svg>
      			</div>
      			
      		</div>
      	</router-link>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  head() {
    return { title: "Get-Started" }
  },
  name: "Get-Started"
}

</script>
