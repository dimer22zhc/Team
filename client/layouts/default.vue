<template>
  <div class="">
    <nav class="bg-white border-b-2 border-gray-300  pt-2 md:pt-1 pb-1 px-3 py-2 mt-0 h-auto fixed w-full z-20 top-0">
      <div class="flex flex-wrap justify-between  items-center">
        <div :class="!user && $route.name !== 'teamname'? 'flex justify-center':'flex md:w-1/3 justify-center flex-shrink  md:justify-start  '"  class="flex ">
          <router-link :to="'/'" class="flex cursor-pointer">
            <img src="./../assets/logo.png" height="38" width="42" alt="">
            <span class="font-extrabold focus:no-underline text-black text-3xl mx-2">Team</span> 
          </router-link>
        </div>
        <div  class="flex font-semibold text-gray-700 w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
          <ul v-if="!user && $route.name !== 'teamname'" class="list-reset flex justify-between flex-1 md:flex-none items-center">
            <router-link :tag="'li'" :to="{name:'getStarted'}"  class="flex-1 cursor-pointer md:flex-none md:mr-3">
              <span class="inline-block py-2 px-3 text-lg no-underline">Product</span>
            </router-link>
             <router-link :tag="'li'" :to="{name:'getStarted'}"  class="flex-1 cursor-pointer md:flex-none md:mr-3">
              <span class="inline-block py-2 px-3 text-lg no-underline">Support</span>
            </router-link>
             <router-link :tag="'button'" :to="{name:'login'}"  class="inline-block rounded font-semibold  items-center border-2 mx-3 border-green-500 px-2 px-3 text-lg no-underline">
              Sign In
            </router-link>
            <router-link :tag="'li'" :to="{name:'getStarted'}"  class="flex-1 cursor-pointer md:flex-none md:mr-3">
              <button class="inline-block rounded font-semibold bg-gray-300  items-center mx-3 px-3 border-2 border-gray-600 text-lg no-underline">
              I'm new to Team
              </button>
            </router-link>
          </ul>
        </div>
      </div>
    </nav>
    <nuxt class="flex-1 mt-20 md:mt-20" />
  </div>
</template>
<script>
  export default{
    name:"Default",
    computed:{
      user:function(){
        return this.$store.getters['auth/user']
      }
    }
  }
</script>
<style lang="scss">
</style>
