<template>
  <div @keydown.esc="$emit('cancel',edit)"  @keydown.enter="saveChanges" class="flex flex-row px-6 my-2  w-full">
    <div class="">
       <img src="" class="w-10 h-10 rounded mr-3">
    </div>
    <div class="flex flex-col  w-full">
      <div>
         <input v-model="newbody" class="w-full focus:outline-none rounded border border-gray-500 px-4 py-2" type="text">
      </div>
      <div class="my-2">
        <div class="flex items-center">
          <button @click="$emit('cancel',edit)"  class="text-sm focus:outline-none button-pad text-black border font-semibold opacity-75 border-gray-400 px-4 rounded">Cancel</button>
          <button @click="saveChanges" class="text-sm mx-2 focus:outline-none flex items-center button-pad text-white bg-green-600  font-semibold px-4 rounded">
            <a-icon type="enter" /> <span class="px-1 text-sm">Save changes</span> </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'
	export default{
    props:{id:{type:Number},body:{type:String},endpoint:{type:String}},
		name:"Edit",
		data:()=>({
			edit:false,
      newbody:''
		}),
    mounted(){
      this.newbody = this.body
    },
    methods:{
      saveChanges(){
        this.$store.commit('thread/U_S_T_B',{
          thread:this.id,
          body:this.newbody
        })
        this.$emit('updated', this.newbody)
        this.$emit('cancel',this.edit)
        axios.patch(this.endpoint,{body:this.newbody})
      }
    }
	}
</script>
<style lang="scss" scoped>
.button-pad{
  padding-top: 2.5px; padding-bottom: 2.5px
}
</style>