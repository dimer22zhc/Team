<template>
	<div class="flex-1 flex flex-col bg-white overflow-hidden " style=" font-size: 15px">
    <!-- Top bar -->
    <div class="border-b flex px-6 py-2 items-center flex-none">
      <div class="flex flex-col">
        <h3 class="text-grey-darkest mb-1 font-extrabold px-1" v-if="!$store.state.layout.isLoading">Home</h3>
        <div class="text-grey-dark text-sm truncate" v-else >
          <div class='text-input__loading'>
            <div class='text-input__loading--line rounded  '></div>
          </div>
        </div>
      </div>
      <div class="ml-auto hidden md:block">
        
      </div>
    </div>
    <!-- Chat messages -->
    <div class="px-6 py-4 flex flex-1 flex-col-reverse overflow-y-auto">
      <!-- A message -->
      <!-- <nuxt/> -->

    </div>
    <div class="pb-6 px-4 flex-none">
      <div class="flex rounded-lg border-2 border-grey overflow-hidden">
        <span class="text-3xl text-grey border-r-2 border-grey p-2">
          <svg class="fill-current h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z" /></svg>
        </span>
        <input type="text" class="w-full px-4" placeholder="Message #general" />
      </div>
    </div>
  </div>
</template>
<script>
	export default{
		name:"RightBar"
	}
</script>