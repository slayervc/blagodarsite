<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?php $this->addExternalJs('/local/js/operationFormSubmit.js'); ?>

<div class="row">
	<div class="col-md-12">
		<div id="error-container-<?php echo $arResult['FORM_OPTIONS']['FORM_ID'] ?>"></div>
		<form name="<?php echo $arResult['FORM_OPTIONS']['FORM_ID'] ?>" 
			  action="<?php echo $arResult['FORM_OPTIONS']['FORM_ACTION'] ?>" 
			  method="POST" 
			  class="form partner-form"
			  data-alert-container="#error-container-<?php echo $arResult['FORM_OPTIONS']['FORM_ID']?>"
		>
			<input name="uri_alias" type="hidden" value="<?php echo $arParams['URI_ALIAS'] ?>">
			<h2 class="partner-form__header">
				<?php echo GetMessage($arParams['URI_ALIAS']) ?>
			</h2>
			<?php foreach ($arResult['SHOW_FIELDS'] as $field):?>
				<div class="form-group">
					<input type="text" 
						   class="form-control partner-form__text-input" 
						   name="FORM[<?php if ($field == 'category_name' || $field == 'name'): ?>name<?php else: ?><?php echo $field ?><?php endif ?>]" 
						   placeholder="<?php echo GetMessage($field) ?>"
					>
				</div>
			<?php endforeach ?>
			<div class="form-group">
				<input type="submit" class="partner-form__button" value="<?php echo GetMessage('SUBMIT_BUTTON') ?>">
			</div>
		</form>
	</div>
</div>




