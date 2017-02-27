import ScreenPopupAddCategory from "./../Components/ScreenPopupAddCategory/ScreenPopupAddCategory.vue"
import MoonLoader from "vue-spinner/src/MoonLoader.vue"
import _ from "lodash"
export default {
	data() {
		return {
			categoryList: {},
			editedCategory: null,
			categoryErrors: null,
			categoryEditLoading: false,
			loaded: false,
			showPopup: false
		}
	},
	methods: {
		sortCategories(categories) {
			return _.orderBy(categories, 'id', 'desc')
		},
		showPopup() {
			this.$parent.showPopup = true
		},
		editCategory(category) {
			this.beforeEditCache = {
				name: category.name,
				descr: category.descr
			}
			this.editedCategory = category
		},
		doneEdit(category) {
			// Send http request to backend with type == method for controller
			// 
			this.categoryEditLoading = true

			this.$http.post('', {
				type: 'update-category',
				data: category
			})
			.then((res) => {
				console.log(res.body)
				if (res.body.status == 'success') {
					this.categoryEditLoading = false
					this.editedCategory = null
				} else {
					window.location.reload()
				}
				
			}, (err) => {
				console.log(err)
				this.categoryErrors = err.body
			})	
		},
		cancelEdit(category) {
			category.name = this.beforeEditCache.name
			category.descr = this.beforeEditCache.descr

			this.editedCategory = null
		}

	},


	components: {
		'screen-popup': ScreenPopupAddCategory,
		'preloader': MoonLoader
	},

	directives: {
		'category-focus': {
			inserted: (el) => {
				el.focus()
			}
		}
	},
	created() {
		// Fetch data form backend
		this.$http.get('', {
			params: {
				type: 'get-category-list'	
			}
		})
		.then((res) => {
			this.categoryList.count = res.body.info.count
			if (res.body.info.count !== 0) {
				let dataList = res.body.info.list
				this.categoryList.list = this.sortCategories(dataList)	
			} else {
				this.categoryList.list = null
			}

			this.loaded = true
		})
	}
}