import Vue from 'vue';
import { directive as onClickaway } from 'vue-clickaway';
const clickaway = {
install(Vue, options){
    Vue.mixin({
      directives: {
		   onClickaway: onClickaway,
		},
    })
  }
};
Vue.use(clickaway);