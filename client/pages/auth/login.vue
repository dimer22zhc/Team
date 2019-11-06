<template>
  <div>
    <div class="flex justify-center my-4">
       <div class="bg-white rounded border-r border-b border-t border-gray-500 xl:w-1/3"> 
        <div class="flex items-center py-1 px-3 border-l-4  border-blue-500 rounded text-lg">
            <span>
              <svg class="fill-current text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path class="heroicon-ui" d="M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20zm0 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm0 9a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0v4a1 1 0 0 1-1 1zm0 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" /></svg>
            </span>
            <span class="px-2">
              You need to sign in to get access your page.

            </span>
          </div>
        </div>
     
    </div>
    
    <div class="flex justify-center">
      <div class="border rounded px-8 pt-6 pb-8 mb-4 flex flex-col xl:w-1/3">
       
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <!-- Email --> 
          <p class="text-center" v-if="!!$store.state.auth.user">{{$store.state.auth.user.email}}</p>
          <p class="text-3xl text-black text-center mb-10 font-bold">Sign in to Your Workplace</p>

          <p></p>
          <p class="my-4" style="font-size: 15px">Enter your <span class="font-semibold">email address</span> and  <span class="font-semibold">password</span>.</p>
          <div class=" mb-4">
           
            <div class="">
              <input v-model="form.email" :class="{ 'border border-red-600': form.errors.has('email') }" type="email" name="email" placeholder="you@example.com" class="appearance-none text-gray-700 text-lg py-2 border border-gray-600 focus:outline-none rounded w-full py-2 px-3">
              <has-error class="text-red-600 font-semibold text-xs italic" :form="form" field="email" />
            </div>
          </div>
          <!-- Password -->
          <div class="form-group row">
            <div class="col-md-7">
              <input v-model="form.password" :class="{ 'border border-red-600': form.errors.has('password') }" type="password" name="password" placeholder="password"  class=" appearance-none border border-gray-600 focus:outline-none rounded w-full py-2 px-2 text-grey-darker text-lg  mb-3">
              <has-error class="text-red text-xs italic" :form="form" field="password" />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
                <button  style="background: #007a5a" class="shadow-sm text-xl font-bold py-2  appearance-none border rounded w-full px-3 text-white">
                  Sign in 
                </button>
              <!-- GitHub Login Button -->
              <login-with-github />
            </div>
          </div>
          <!-- Remember Me -->
          <div class="flex">
            <div class=" py-3">
              <div class="flex">
                 <a-switch :defaultChecked="false" v-model="remember" >
                    <a-icon type="check" slot="checkedChildren"/>
                    <a-icon type="close" slot="unCheckedChildren"/>
                  </a-switch> 
                  <span class="px-2">
                     {{ $t('remember_me') }}
                  </span>
              </div>
            </div>
          </div>
          <div class="flex">
            <div class="col-md-7 d-flex my-4">          
               
              <router-link :to="{ name: 'password.request' }" class="font-semibold">
                {{ $t('forgot_password') }}
              </router-link>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import Form from 'vform'

export default {
  middleware ({ store, redirect }) {
      // If the user is not authenticated
      if (store.state.auth.user && store.state.auth.token) {
        return redirect({name:'teams'})
      }
   },
  head() {
    return { title: this.$t('login') }
  },
  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login() {
      let data

      // Submit the form.
      try {
        const response = await this.form.post('/login')

        let data = response.data

        // Save the token.

        this.$store.dispatch('auth/saveToken', {
          token: data.token,
          remember: this.remember
        })
          // Fetch the user.

        await this.$store.dispatch('auth/fetchUser')
          // Redirect home.
          
        this.$router.push({ name: 'teams' })
        
      } catch (e) {
        return
      }

      

      

      
    }
  }
}

</script>
