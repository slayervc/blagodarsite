<template>
	<div class="popup">
		<div class="popup__container">
			<div class="popup__close" @click="closePopup">
				<i class="glyphicon glyphicon-remove"></i>
			</div>
			<form class="popup__form">
				<div class="row">
					<div class="col-md-12">
						<h3 class="text-center">{{ header }}</h3>
						<div class="form-group">
							<input name="category_name" type="text" class="form-control" placeholder="Имя категории" v-model="category.name">
						</div>
						<div class="form-group">
							<textarea name="category_description" 
								      rows="3" 
								      class="form-control form-textarea form-textarea--vertical" 
								      placeholder="Описание категории"
								      v-model="category.descr"
							>
						    </textarea>
						</div>
						<div class="form-group" v-if="!loading">
							<button class="button button--small button--full" @click.prevent="addCategory">Добавить</button>
						</div>
						<div class="col-md-12" v-else>
							<div class="preloader">
								<div class="preloader__container">
									<div class="preloader__item">
										<preloader :color="'#7aa700'"></preloader>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>
<style lang="sass">
	.popup{
		height: 100%;
		width: 100%;
		top:0;
		left:0;
		z-index: 999;
		position: fixed;
		background: rgba(#000, .4);
		&__container {
			z-index: 9999;
			position: absolute;
			height: 50%;
			width: 75%;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			margin: auto;
		}
		&__form {
			display: block;
			border-radius: 5px;
			box-shadow: 1px 1px 3px rgba(#000, .8);
			padding: 30px;
			background: #fff;
		}
		&__preloader {
			display: block;
			padding: 30px;
			background: #fff;
		}
		&__close {
			position: absolute;
			right: 5px;
			cursor: pointer;
			top: 5px;
		}
	}
</style>
<script>
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
</script>


