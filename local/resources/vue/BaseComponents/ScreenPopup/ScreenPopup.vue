<template>
	<div class="popup">
		<div class="popup__container">
			<div class="popup__close" @click="closePopup">
				<i class="glyphicon glyphicon-remove"></i>
			</div>
			<slot name="fields"></slot>
			<form class="popup__form">
				<div class="row">
					<div class="col-md-12">
						<h3 class="text-center">{{ header }}</h3>
						<div class="form-group">
							<input name="category_name" 
								   type="text" 
								   class="form-control" 
								   placeholder="Имя категории" 
								   v-model="category.name"
							>
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
							<button class="button button--small button--full" 
								    @click.prevent="addCategory">
								   Добавить
							</button>
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
<style src="./styles/sass/screen-popup.scss" lang="sass"></style>
<script src="./js/ScreenPopup.js"></script>


