<template >
  <div  class="absolute bg-white border shadow rounded h-auto z-50"  style="top:-50px;width:290px; right:180px" >
      <div class="flex flex-col">
        <div class="h-8 bg-gray-100 border-b">
          <div v-for="cat in em_cat">
            <div class=" float-left font-semibold px-1">
              <span class="text-sm p-1 rounded-full hover:shadow-lg cursor-pointer  "> {{cat.emoji}} </span>
            </div>
          </div>
        </div>
        <div class="px-2 py-2">
          <input type="text" placeholder="Search emojies" class="border focus:outline-none px-2 py-1 pl-4 rounded-lg w-full" name="" value="">
        </div>
        <div id="custom-scroll-bar" class="float-left h-64 overflow-y-auto">
          <div v-for="(emojies, category ) in emojies">
            <div class="">
              <a-divider :orientation="'left'" style="margin:3px 0px"><span class="font-bold opacity-75">{{category}}</span></a-divider>
            </div>
            <div v-for="emoji in emojies"class="float-left">
              <div class="p-1 cursor-pointer text-lg rounded-full hover:bg-gray-200">{{emoji.emoji}}</div>
            </div>

          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  data:()=>({
    emojies:'',
    em_cat:[
      {name:"Peoples",emoji:"😀"},
      {name:"Symbols",emoji:"💛"},
      {name:"Nature",emoji:"🐶"},
      {name:"Objects",emoji:"⌚️"},
      {name:"Activity",emoji:"⚽️"},
      {name:"Foods",emoji:"🥑"},
      {name:"Places",emoji:"🚎"},
      {name:"Flags",emoji:"🏳️"}
    ]
  }),
  mounted(){
    var self = this
    setTimeout(function() {
      self.emojies = self.$store.state.emojies.emojies.reduce((groups, e) => {
        const c = e.category;
        if (!groups[c]) {
          groups[c] = [];
        }
        groups[c].push(e);
        return groups;
      }, {});
      console.log("cool")
    }, 100);
  }
}
</script>

<style lang="css" scoped>
</style>
