<template>
	<div class="w-1/3 flex flex-col  bg-white overflow-hidden">
	    <div class="h-16 px-6 py-1 bg-gray-200">
	    	<div class="flex items-center justify-between">
	    		<div>
	    			<p class="text-lg font-extrabold">{{$route.name}}</p>
	    			<p class="">dimer</p>
	    		</div>
	    		<div>
	    			<svg class="fill-current opacity-75 hover:opacity-100 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="34" height="34"><path class="heroicon-ui" d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z"/></svg>
	    		</div>
	    		
	    	</div>
	    	
	    </div>
		<slot name="navContent"></slot>
	</div>
</template>
<script>
	export default{
		name:"RightTopNav"
	}
</script>