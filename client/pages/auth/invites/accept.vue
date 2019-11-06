<template>
  <div class="">
    <div class="my-32">
      
        <template>
          <div class="alert alert-success" role="alert">
           
            <div class="flex justify-center" v-if="success && team && email">
              <div class="shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col w-1/3">
                <p class="font-bold mb-1 text-3xl">Welcome to Team {{team}}!</p>
                <p style="font-size: 15px" class="mb-4"><span class="font-semibold">{{email}}</span>. Add Your Password To access your workplace safely.</p>
                <form  @submit.prevent="access" @keydown="form.onKeydown($event)" class="my-3">
                  <input v-model="form.email=email" hidden>
                  <input v-model="form.password" type="password" placeholder="Add your password" class="shadow-sm mb-3 text-lg appearance-none border border-gray-900 focus:outline-none rounded w-full py-2 px-3 mb-5 text-grey-darker">
                  <button @click style="background: #007a5a" class="shadow-sm text-xl py-2 font-bold  appearance-none border rounded w-full px-3 text-white">
                    Next 
                </button>


              </form>
            </div>
          
            </div>
          </div>
        </template>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Form from 'vform'
const qs = params => Object.keys(params).map(key => `${key}=${params[key]}`).join('&')

export default {
  data:()=>({
    form:new Form({
      password:'',
      email:''
    })
  }),
  metaInfo () {
    return { title: this.$t('verify_email') }
  },

  async asyncData ({ params, query, redirect, store }) {
    try {
      if (!store.state.auth.token && !store.state.auth.user) {
        const { data } = await axios(`/invite/accept/${params.token}`)   
        return { 
          success: true, 
          email:data.email,
          team:data.teamName 
        }
      }
       if (store.state.auth.token && store.state.auth.user) {
        await axios(`auth/invite/accept/${params.token}`)  
        // Fetch the user.
        await store.dispatch('auth/fetchUser') 
        redirect({name:"teams"})
        return { 
          success: true, 
        }
      }
     console.log("authed")
    } catch (e) {
      return { success: false, }
    }
  },
  methods:{
    async access(){
      try { 
        await this.form.patch('save/password') ;
        // statements 
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
      } catch(e) {
        // statements
        console.log(e);
      }
     
    
    }
  }
}
</script>
