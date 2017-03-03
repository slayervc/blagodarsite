<template>
	<div class="partner-list">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<h3>Работа с партнерами</h3>
				</div>
				<div class="col-md-12">
					<button v-if="showCreateNewPartnerForm == false" class="button button--small" @click="showCreateNewPartnerForm = true">
						<i class="glyphicon glyphicon-plus-sign"></i> Добавить партнера
					</button>
					<button v-else class="button button--small" @click="showCreateNewPartnerForm = false">
						<i class="glyphicon glyphicon-remove"></i> Скрыть
					</button>
				</div>
				<div class="col-md-12">
					<div v-show="showCreateNewPartnerForm" class="panel" :class="error ? 'panel-danger' : 'panel-default'">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-12 form-horizontal">
									<label class="control-label col-sm-2" for="newName">
										Имя партнера
									</label>
									<div class="col-sm-10">
										<input v-model="newPartner.name" name="newName" class="form-control" type="text" placeholder="Имя">
									</div>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div v-if="error" class="col-md-12">
								<div class="alert alert-danger">
									<span>{{error}}</span>
								</div>
							</div>
							<h3>Данные пользователя</h3>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Логин</label>
										<input v-model="newPartner.partner_login" type="text" class="form-control" placeholder="Логин">
									</div>
									<div class="form-group">
										<label>Пароль для нового партнера</label>
										<input v-model="newPartner.partner_password" type="password" class="form-control" placeholder="Пароль">
									</div>
									<div class="form-group">
										<label>Полное описание клиента</label>
										<textarea v-model="newPartner.descr" placeholder="Полное описание" class="form-control"></textarea>
									</div>
									<div class="form-group">
										<label>Email</label>
										<input v-model="newPartner.email" type="text" class="form-control" placeholder="Почтовый ящик">
									</div>
									<div class="form-group">
										<label>Фактический адрес</label>
										<input v-model="newPartner.address" type="text" class="form-control" placeholder="Адрес">
									</div>
									<div class="form-group">
										<label>Номера телефонов</label>
										<input v-model="newPartner.phones" type="text" class="form-control" placeholder="Номера телефонов через запятую">
										<span class="help-block">Указать телефоны через запятую</span>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<label>Показывать в каталоге</label>
											</div>
											<div class="col-xs-6">
												<label>Да</label>
												<input v-model="newPartner.showInCatalog" value="1" type="radio">
											</div>
											<div class="col-xs-6">
												<label>Нет</label>
												<input v-model="newPartner.showInCatalog" value="0" type="radio">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label>Категория партнера</label>
												<select v-model="newPartner.category_id" class="form-control">
													<option v-for="category in categories" :value="category.id">{{category.name}}</option>
												</select>
											</div>
											<div class="col-md-6">
												<label>Город</label>
												<select v-model="newPartner.city_id" class="form-control">
													<option v-for="city in cities" :value="city.id">{{city.name}}</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-6">
									<button class="button button--full" @click="addNewPartner">Добавить</button>
								</div>
								<div class="col-xs-6">
									<button class="button button--full" @click="showCreateNewPartnerForm = false">Отмена</button>
								</div>								
							</div>
						</div>
					</div>
					<div v-for="partner in partnerList" class="panel panel-default">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-6">
									<span class="text-left">ID партнера: {{partner.id}} </span>
									<span><strong>Имя: </strong> {{partner.name}}</span>
								</div>
								<div class="col-md-6">
									<span class="text-right"></span>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<p><strong>Логин партнера: </strong>{{partner.login}}</p>
							<p><strong>Описание партнера: </strong>{{partner.descr}}</p>
							<p><strong>Категория партнера: </strong>{{partner.category}}</p>
							<p>
								<strong>Город партнера: </strong>
								<span v-for="city in cities">
									<span v-if="city.id == partner.city_id">{{city.name}}</span>
								</span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
import ScreenPopup from "BaseComponents/ScreenPopup/ScreenPopup.vue"
export default {

	data(){
		return {
			showCreateNewPartnerForm: false,
			partnerList: [],
			categories: [],
			cities: [],
			newPartner: {
				name: '',
				category_id: null,
				showInCatalog: 0,
				proc_commision: null,
				city_id: null,
				partner_login: '',
				partner_password: '',
				min_balance: null,
				min_comission: null,
				email: '',
				phones: '',
				proc: null,
				address: '',
				site: '',
				descr: '',
				holding_agent: false,
				proc_agent: null,
				prog_info: ''
			},
			error: null
		}
	},

	methods: {

		addNewPartner(){
			console.log('new partner added', this.newPartner);

			let placeholder = {
				name: '',
				category_id: null,
				showInCatalog: 0,
				proc_commision: null,
				city_id: null,
				partner_login: '',
				partner_password: '',
				min_balance: null,
				min_comission: null,
				email: '',
				phones: '',
				proc: null,
				address: '',
				site: '',
				descr: '',
				holding_agent: false,
				proc_agent: null,
				prog_info: ''
			};

			this.$http.post('', {
				type: 'add-partner-by-agent',
				data: this.newPartner
			})
			.then((res) => {
				console.log(res)
				this.error = null
				this.showCreateNewPartnerForm = false
				this.newPartner = placeholder
				this.getPartnerList()
			}, (error) => {
				console.log(error)
				this.error = error.body.info
			})

		},

		makeTestList() {
			for (var i = 1; i <= 4; i++) {
				console.log(i)
				this.partnerList.push({
					id: `${i}`,
					name: "Test user",
					level: "1",
					login: "login test",
					descr: "Краткое описание партнера",
					category: `Категория для партнера с id: ${i}`,
					city_id: "4",
					blocked: "0",
					parent_id: "идентификатор партнёра, для которого текущий партнёр является агентом"
				})
			}
		},

		getPartnerList(){
			this.$http.get('', {
				params: {
					type: 'get-partners-list-agent'
				}
			})
			.then((response) => {
				console.log(response.body.info.list)
				this.partnerList = response.body.info.list
			}, (error) => {
				console.log(error)
			})
		}
	},

	created() {
		
		this.categories = this.$parent.categories

		this.cities = this.$parent.cities

		this.getPartnerList()

		// this.makeTestList()
	}

}
</script>



