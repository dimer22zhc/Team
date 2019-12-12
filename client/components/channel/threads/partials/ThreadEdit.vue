<template>
	<div class="pb-6 px-6 my-3 flex-none" @keydown.esc="$emit('closeEditForm',false)">
        <!-- <span class="text-3xl text-grey border-r-2 border-grey p-1">
          <svg class="fill-current h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z" /></svg>
        </span> -->
        <textarea
					ref="edit"
					id="edit"
					cols="1"
          @keyup.enter="saveChanges"
          class="w-full px-4 py-2 overflow-hidden rounded border focus:outline-none"/></textarea>
          <div class="">
            <div class="flex">
              <button @click="$emit('closeEditForm',false)" type="button" name="button" class="font-semibold px-2 rounded mr-2 border opacity-75 hover:opacity-100">Cancel</button>
              <button @click="saveChanges" type="button" name="button" class="font-semibold px-2 rounded mr-2 bg-green-700 text-white border">Save changes</button>
            </div>
          </div>
  </div>
</template>
<script>
	import $ from 'jquery'
  import axios from 'axios'
	export default{
    props:{thread:{type:Object},content:{type:String},isPost:{type:Boolean},postDescription:{type:String}},
		name:"ThreadEdit",
    methods:{
      saveChanges(){
        this.$store.commit("channel/EDIT_THREAD",{
          threadId:this.thread.id,
          channelId:this.$route.params.channel_id,
          created_at:this.thread.created_at,
          isPost:this.isPost,
          postDescription:this.$refs.edit.value,
          content:this.$refs.edit.value
        })
        axios.patch('thread/update/'+this.thread.id,{
          body:this.$refs.edit.value,
          isPost:this.isPost,
          postDescription:this.$refs.edit.value,

        })
        this.$emit("closeEditForm",false)
      }
    },
    mounted(){
      if (!this.isPost) {
         this.$refs.edit.value = this.thread.body
       }else {
          this.$refs.edit.value = this.thread.files[0].description
       }
     
      $("#edit").on("keypress", function(e) {
        if ((e.keyCode == 10 || e.keyCode == 13)) {
          e.preventDefault();
        }
      });
      $('#edit').each(function () {
        this.setAttribute('style', 'height:' + ((this.scrollHeight) - 17) + 'px;overflow-y:hidden;');
      }).on('input', function () {
        this.style.height = 'auto';
        this.style.height =  ((this.scrollHeight) - 17) + 'px';
      });
    },
	}
</script>
