<template>
	<div>
		<div>
		<div class="flex justify-center">
	      <div class="shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col w-1/3">
	      	<p class="font-bold mb-1 text-3xl">Check your email!</p>
	      	<p style="font-size: 15px" class="mb-4">We have e-mailed your verification link! to <span class="font-semibold">dimerbw@gmail.com</span>. It will expire shortly, so enter it soon.</p>
	      	<div class="my-3">
      		<p  style="font-size: 15px" class="mt-4">
      			While checking for your code. Remember to try your spam folder!
      		</p>
      	</div>
      </div>
    </div>
	</div>
	</div>
</template>	

<script>
	import Form from 'vform'
	export default{
		name:"Comfirm-Email",
		head(){
			return { title:"Comfirm-Email"}
		},
		data:()=>({
			form:new Form({
				email:''
			})
		}),
	}
</script>