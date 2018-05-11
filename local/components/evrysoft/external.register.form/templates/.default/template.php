<?
/**
 * ShadowFiend Template for bitrix:main.register component
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="auth-block">

				<form id="registerOptionForm">
					<div class="form-group">
						<label>Ваш город: </label>
						<input type="hidden" id="registerCity" value="<?=$_SESSION['SESS_CURRENT_CITY']['CITY_ID']?>">
						<a href="javascript:" onclick="showDialog()" class="map-btn ">
							<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>
							<span style="vertical-align: middle"><?=$_SESSION['SESS_CURRENT_CITY']['CITY_NAME']?></span>
						</a>
					</div>

					<div class="form-group">
						<label>Зарегистрироваться в качестве</label>
						<select id="registerFormType" class="form-control partner-form__text-input" onchange="switchForm()">
							<option value="1" selected>Клиента</option>
							<option value="2">Партнера</option>
						</select>
					</div>
				</form>

				<h4 id="registerFormTitle" class="auth-block__form-header auth-block__form-header--centered">
					Регистрация Клиента
				</h4>

				<div id="registerFormMessage" class="alert alert-danger" style="display: none;"></div>

				<div id="formBorder" class="auth-block__form auth-block__form--expanded auth-block__form--bordered">

					<form id="confirmationForm" class="form" style="display: none">

						<div class="form-group">
							<label>Код подтверждения</label>
							<div class="row">
								<div class="col-md-6">
									<input type="number" id="clientConfirmationCode" class="form-control auth-block__form-control">
									<input type="hidden" id="clientConfirmationId">
								</div>
								<div class="col-md-6">
									<a class="button button-success" onclick="confirmClientRegistration()">Подтвердить регистрацию</a>
								</div>
							</div>
						</div>

					</form>

					<form id="clientForm" class="form">

						<div class="form-group">
							<label>ФИО <span class="star-required-field">*</span></label>
							<input type="text" id="clientName" class="form-control auth-block__form-control" placeholder="ФИО">
						</div>

						<div class="form-group">
							<label>Номер телефона <span class="star-required-field"">*</span></label>
							<input type="tel" id="clientPhone" class="form-control auth-block__form-control" placeholder="Номер телефона">
						</div>

						<div class="form-group">
							<label>e-mail</label>
							<input type="text" id="clientEmail" class="form-control auth-block__form-control" placeholder="e-mail">
						</div>

						<div class="form-group">
							<label>День рождения (дд.мм.гггг)</label>
							<input type="text" id="clientBirthday" class="form-control auth-block__form-control" placeholder="День рождения (дд.мм.гггг)">
						</div>

						<div class="form-group" id="clientInnBlock" style="display: none">
							<label>ИНН <span class="star-required-field"">*</span></label>
							<input type="number" id="clientINN" class="form-control auth-block__form-control" placeholder="ИНН">
						</div>

						<div class="form-group">
							<label><input type="checkbox" id="clientIsLegal" onchange="switchClientINN()"> Юридическое лицо</label>
						</div>

						<input id="" type="button" class="auth-block__button auth-block__button--full" name="register_submit_button" value="Регистрация" onclick="registerClient()">
					</form>

					<form id="partnerForm" class="form" style="display: none">

						<input type="hidden" id="partnerReferer" value="<?=filter_input(INPUT_GET, 'ref', FILTER_VALIDATE_INT)?>">

						<div class="form-group">
							<label>Наименование <span class="star-required-field"">*</span></label>
							<input type="text" id="partnerName" class="form-control auth-block__form-control" placeholder="Наименование">
						</div>

						<div class="form-group">
							<label>ИНН <span class="star-required-field"">*</span></label>
							<input type="number" id="partnerINN" class="form-control auth-block__form-control" placeholder="ИНН">
						</div>

                        <div class="form-group">
                            <label>Контактная информация <span class="star-required-field"">*</span></label>
                            <textarea id="partnerContacts" class="form-control auth-block__form-control" placeholder="Контактная информация"></textarea>
                        </div>

						<input id="" type="button" class="auth-block__button auth-block__button--full" name="register_submit_button" value="Отправить заявку"  onclick="registerPartner()">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script language="JavaScript">
    setFormKind();
</script>




