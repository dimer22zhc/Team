<template>
  <div>
  	<div>Replies</div>
    <reply v-for="reply in replies" :reply="reply" :key="reply.id"/>
    <reply-input :thread="thread"/>
  </div>
</template>
<script>
import Reply from './Reply'
export default {
  props: { replies: { type: Array },thread:{ type:Object } },
  components:{Reply},
  name: "Replies",
  data: () => ({
  	data:'',
    hover: false
  }),
}

</script>
