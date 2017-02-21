export default {
	data() {
		return {
			categoryList: [],
			editedCategory: null,
			categoryErrors: null,
			categoryEditLoading: false
		}
	},
	methods: {
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

	directives: {

		'category-focus': {
			inserted: (el) => {
				el.focus()
			}
		}

	},
	created() {
		this.categoryList = this.$parent.categoryList
	}
}