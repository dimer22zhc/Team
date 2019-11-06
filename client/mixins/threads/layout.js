export default{
	data:()=>({
			options: false,
		    menu: false,
		    body:'',
		    emojiesPallete: false,
		    y_menu_position:'',
		    modal: false,
		    edit: false,
		    hover: false
		}),
	methods:{

		optionsTrue() {

	      if (!this.menu) {
	        this.options = true
	      }
	    },
	    optionsFalse() {
	      if (!this.menu) {
	        this.options = false
	      }
	    },
	    refresh() {
	      // this.$store.commit('layout/POPOVER_OVERLAY')
	      this.menu = false
	      this.emojiesPallete = false
	      this.options = false
	    },
	    reset() {
	      this.menu = false;
	      this.options = false;
	      this.$store.commit('layout/POPOVER_OVERLAY_FALSE')
	    },
	},
}
