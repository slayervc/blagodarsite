<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?php 
$this->addExternalJs('/local/js/operationFormSubmit.js'); 
?>
<div class="row">
	<div class="col-md-12">
		<?php if ($arParams['ALERTS_IN_FORMS'] == 'Y'): ?>
			<div id="error-container-<?php echo $arResult['FORM_OPTIONS']['FORM_ID']?>"></div>	
		<?php endif ?>
		<form name="<?php echo $arResult['FORM_OPTIONS']['FORM_ID'] ?>" 
			  action="<?php echo $arResult['FORM_OPTIONS']['FORM_ACTION'] ?>" 
			  method="POST" 
			  class="form partner-form"
			  <?php if ($arParams['ALERTS_IN_FORMS'] == 'Y'): ?>
					data-alert-container="#error-container-<?php echo $arResult['FORM_OPTIONS']['FORM_ID']?>"
			  	<?php else: ?>
					data-alert-container="#error-container-global"
			  <?php endif ?>
			  
		>
		<h2 class="partner-form__header">
			<?php echo $arParams['FORM_HEADER'] ?>
		</h2>
			<input name="uri_alias" type="hidden" value="<?php echo $arParams['URI_ALIAS'] ?>">
			<?php foreach ($arResult['SHOW_FIELDS'] as $field):?>
				<div class="form-group">
				<?php if ($field == $arResult['PASSED_FIELD_STR']): ?>
					<div class="row">
						<div class="col-md-6 col-xs-6">
							<input type="text" name="FORM[<?php echo $field ?>]" 
								   class="form-control partner-form__text-input" 
								   placeholder="<?php echo GetMessage($field) ?>"
							>
						</div>
						<div class="col-md-6 col-xs-6">
							<input type="submit" class="partner-form__button partner-form__button--block" 
								data-action="get-code" 
								data-response-success="Код отправлен на номер:"
								data-response-error="Ошибка:" value="Отправить код"
							>
						</div>
					</div>
					<?php else: ?>
						<input type="text" class="form-control partner-form__text-input" name="FORM[<?php echo $field ?>]" placeholder="<?php echo GetMessage($field) ?>">
					<?php endif ?>
				</div>
			<?php endforeach ?>
			<div class="form-group">
				<input type="submit" class="partner-form__button" value="<?php echo GetMessage('SUBMIT_BUTTON') ?>">
			</div>
		</form>
	</div>
</div>




