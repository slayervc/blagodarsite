<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?php $this->addExternalJs('/local/js/operationFormSubmit.js'); ?>

<div class="row">
	<div class="col-md-12">
		<?php if ($arParams['ALERTS_IN_FORMS'] == 'Y'): ?>
			<div id="error-container-<?php echo $arResult['FORM_OPTIONS']['FORM_ID'] ?>"></div>	
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
			<input name="uri_alias" type="hidden" value="<?php echo $arParams['URI_ALIAS'] ?>">
			<h2 class="partner-form__header">
				<?php echo GetMessage($arParams['URI_ALIAS']) ?>
			</h2>
			<?php foreach ($arResult['SHOW_FIELDS'] as $field):?>
				<div class="form-group">
					<input type="text" 
						   class="form-control partner-form__text-input" 
						   name="FORM[<?php if ($field == 'category_name' || $field == 'name'): ?>name<?php else: ?><?php echo $field ?><?php endif ?>]" 
						   placeholder="<?php 
								if ($arParams['URI_ALIAS'] == 'add-client-balance-proc' && $field == 'sum') {
									echo GetMessage($field . '_proc');
								} else { 
									echo GetMessage($field);
								}?>"
					>
				</div>
			<?php endforeach ?>
			<div class="form-group">
				<input type="submit" class="partner-form__button" value="<?php echo GetMessage("SUBMIT_{$arParams['URI_ALIAS']}") ?>">
			</div>
		</form>
	</div>
</div>




