<template>
<div class="category">
	<div class="row">
		<div class="col-md-12">
			<h3>Работа с категориями</h3>
		</div>
		<div class="col-md-12" style="margin-bottom:10px;">
			<button class="button button--small" @click="showPopup">
				<i class="glyphicon glyphicon-plus-sign"></i> 
				<span>Добавить</span>
			</button>
		</div>
		<div class="col-md-12" v-for="category in categoryList" :key="category.id">
			<transition name="slide-down-fade" mode="out-in">
				<div class="panel panel-default" key="show" v-if="category !== editedCategory">
					<div class="panel-heading">
						<div class="button button--small" @click="editCategory(category)">
							<i class="glyphicon glyphicon-pencil"></i>
						</div>
						<span>{{ category.name }}</span>
					</div>
					<div class="panel-body">
						<div class="category-description" v-if="category !== editedCategory">
							<p>
								<span v-if="category.descr !== ''">
									{{category.descr}}
								</span>
								<span v-else>Нет описания категории</span>
							</p>
						</div>
					</div>
				</div>
				<div class="panel" :class="[categoryErrors == null ? 'panel-default' : 'panel-danger']" key="edit" v-else>
					<div class="panel-heading">
						<form class="form-horizontal">
							<div class="form-group">
								<div class="col-sm-2">
									<label>Имя:</label>
								</div>
								<div class="col-sm-10">
									<input v-category-focus 
										   class="form-control" 
										   type="text" 
										   v-model="category.name"
										   @input="categoryErrors = null"
									>
									<span v-if="category.name == '' && categoryErrors == null" class="help-block">
										<strong>
											Имя категории должно быть заполнено
										</strong>
									</span>
									<span v-else-if="categoryErrors !== null">
										<strong>
											{{categoryErrors.info.message}}
										</strong>
									</span>
								</div>
							</div>
						</form>
					</div>
					<div class="panel-body">
						<div class="category-input-form">
							<div class="form-group">
								<textarea class="form-control form-textarea form-textarea--vertical" rows="4" type="text" v-model="category.descr" placeholder="Текст описания">
								</textarea>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-xs-6">
										<button class="button button--small button--full" :class="{'button--disabled': categoryEditLoading}" @click="doneEdit(category)">
											<span v-if="!categoryEditLoading">
												<i class="glyphicon glyphicon-ok-circle"></i>
												Сохранить
											</span>
											<span v-else>Ответ</span>
										</button>
									</div>
									<div class="col-xs-6">
										<button class="button button--small button--full" @click="cancelEdit(category)">
											<i class="glyphicon glyphicon-remove"></i>
											Отменить
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</transition>
		</div>	
	</div>
</div>
</template>
<style lang="sass">
	.slide-down-fade-enter-active, .slide-down-fade-leave-active {
	  transition: all .2s ease;
	}
	.slide-down-fade-enter, .slide-down-fade-leave-to{
	  transform: translateY(-7px);
	  opacity: 0;
	}
</style>
<script src="./script/index.js"></script>

