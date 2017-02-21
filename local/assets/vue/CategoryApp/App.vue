<template>
	<div class="app">
		<screen-popup v-if="showPopup" header="Добавить новость"></screen-popup>
		<div class="preloader" v-if="!loaded">
			<div class="preloader__container">
				<div class="preloader__item">
					<preloader :color="'#7aa700'"></preloader>
				</div>
			</div>
		</div>
		<div v-else class="col-md-12">
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
import ScreenPopupAddCategory from "./Components/ScreenPopupAddCategory/ScreenPopupAddCategory.vue"
import MoonLoader from "vue-spinner/src/MoonLoader.vue"

export default {
	data() {
		return {
			loaded: false,
			categoryList: [],
			showPopup: false
		}
	},
	created() {

		this.$http.get('', {
			params: {
				type: 'get-category-list'	
			}
		})
		.then((res) => {
			let dataList = res.body.info.list
			// dataList.forEach((el, index) => {
			// 	el.id = Number(el.id)
			// })

			this.categoryList = this.sortCategories(dataList)
			this.loaded = true
		})
	},
	methods: {
		sortCategories(categories) {
				return _.orderBy(categories, 'id', 'desc')
		}
	},
	components: {
		'screen-popup': ScreenPopupAddCategory,
		'preloader': MoonLoader
	},
}





</script>



