<template>
	<div>
		<div class="flex justify-center">
      <div class="shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col w-1/3">
      	<p class="font-bold mb-1 text-3xl">Create a new workspace</p>
      	<p style="font-size: 15px" class="mb-2">To make a workspace from scratch, please confirm your email address.</p>
      	<form @submit.prevent="comfirmEmail" @keydown="form.onKeydown($event)">
      		<div class="my-5">
      			<input :class="{ 'border border-red-600': form.errors.has('email') }" v-model="form.email" type="text" placeholder="name@example.com" class="shadow-sm text-lg appearance-none border border-gray-900 focus:outline-none rounded w-full py-2 px-3 text-grey-darker">
      			<has-error class="text-red-700 font-semibold text-xs italic" :form="form" field="email" />
      		</div>
      		
      		
      		<button style="background: #007a5a" class="shadow-sm text-xl font-bold py-2  appearance-none border rounded w-full px-3 text-white">
      			Comfirm 
      		</button>
      	</form>
      </div>
    </div>
	</div>
</template>
<script>
	import Form from 'vform'
	export default{
	name:"Create-Workplace",
	 
	data: () => ({
	    form: new Form({
	      email: '',
	    }),
	    mustVerifyEmail: false
	}),
	methods: {
	    async comfirmEmail () {
	      // Register the user.
	      try {
	      	// statements
	      	await this.form.post('/register')
	      	
	      } catch(e) {
	      	// statements
	      	return;
	      }

	    this.$router.push({name:"create-confirmemail"})

	    }
	  }
	}
</script>