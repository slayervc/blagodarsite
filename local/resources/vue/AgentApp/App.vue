<template>
	<div class="app">
		<div v-if="loading < 100" class="col-md-12 loading">
			Loading ({{loading}}%)
		</div>
		<div v-else class="col-md-12">
			<transition name="slide-fade" mode="out-in">
				<keep-alive>
					<router-view></router-view>
				</keep-alive>
			</transition>
		</div>
	</div>
</template>
<style lang="sass">

	.app {
		margin-top: 30px;
	}

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
	  transition: all .25s ease-in;
	}
	.slide-fade-leave-active {
	  transition: all .25s ease-out;
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
			cities: [],
			categories: [],
			loading: 0
		}
	},

	methods: {
		// Get categories for application
		getCategories() {
			this.$http.get('', {
				params: {
					type: 'get-category-list'	
				} 
			}).then((res) => {
				console.log(res.body.info)
				this.categories = res.body.info.list
				this.loading += 50
			})
		},
		// Get cities data for application
		getCities() {
			this.$http.get('', {
				params: {
					type: 'get-cities-list'
				}
			}).then((res) => {
				this.cities = res.body.info.list
				this.loading += 50
			})
		}

	},

	created(){
		this.getCategories()
		this.getCities()
	},

	components: {
		'preloader': MoonLoader
	}
}





</script>



