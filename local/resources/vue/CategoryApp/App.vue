<template>
	<div class="app">
		<div class="row">
			<div class="col-md-12">
				<keep-alive>
					<transition name="slide-fade">
						<router-view></router-view>
					</transition>
				</keep-alive>
			</div>
		</div>
	</div>
</template>
<style lang="sass">

	.preloader {
		width: 100%;
		height: auto;
		&__container {
			position: relative;
			min-height: 60px;
		}
		&__item {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}
		
	}

	.slide-fade-enter-active {
	  transition: all .3s ease-in;
	}
	.slide-fade-leave-active {
	  transition: all .3s ease-out;
	}
	.slide-fade-enter, .slide-fade-leave-to{
	  transform: translateY(3px);
	  opacity: 0;
	}
</style>
<script>
import _ from 'lodash'
import MoonLoader from "vue-spinner/src/MoonLoader.vue"

export default {
	data() {
		return {
		}
	},
	components: {
		'preloader': MoonLoader
	},
}





</script>



