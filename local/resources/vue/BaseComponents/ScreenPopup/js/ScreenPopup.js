import MoonLoader from "vue-spinner/src/MoonLoader.vue"
export default {
	data() {
		return {
			loading: false,
			category: {
				name: '',
				descr: ''	
			}
		}
	},
	props: ['header'],
	methods: {
		closePopup() {
			this.$parent.showPopup = false
		},
		addCategory() {
			this.loading = true;
			this.$http.post('', {
				type: 'add-category',
				data: this.category
			})
			.then((res) => {
				if (res.body.status == 'success') {
					window.location.reload()
				}
			}, (err) => {
				this.closePopup()
			})
			// this.$parent.categoryList.push(this.category)
			// this.closePopup()
		}
	},
	components: {
		'preloader': MoonLoader
	},
	created() {
		window.addEventListener('keyup', (e) => {
			if (e.keyCode == 27) {
				this.closePopup()
			}
		})
	}
}