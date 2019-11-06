<template>
	<right-top-nav>
		<template v-slot:navContent>
			<input type="file" @change="selected" accept="image/*" name="file" id="input" />
      <canvas id="preview"></canvas>
		</template>
	</right-top-nav>
</template>
<script>
	import RightTopNav from '~/components/RightTopNav'
	export default{
		components:{RightTopNav},
    name:"Activities",
    methods:{
      selected(e){
        try {
            const file = e.target.files[0]
            const $preview = document.getElementById('preview')
            const previewCtx = $preview.getContext('2d')
            const image = new Image()
            
            createImageBitmap(file)
              .then((bitmap)=>{
                console.log(bitmap)
                $preview.width= bitmap.width
                $preview.height= bitmap.height
                previewCtx.drawImage(bitmap,0,0)
                // applyFilter(bitmap)

            })

        } catch (error) {
          console.log(error)
        }
      },
    },
	}
</script>
<style scoped>
</style>
