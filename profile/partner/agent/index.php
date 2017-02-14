<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?><!-- <div class="col-md-4 sidebar">
</div> -->
<div class="col-md-12 personal-content">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
 					<a href="/profile/partner/" class="button button--small">
 						<span class="glyphicon glyphicon-chevron-left"></span> 
 						Назад
 					</a>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.form", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"DEBUG" => "N",
		"FIELDS" => array(
			0 => "category_name",
		),
		"FORM_HEADER" => "Добавление категории",
		"MULTI_FIELD" => "",
		"PASSED_FIELD" => "",
		"REQUEST_API_METHOD" => "GET",
		"URI_ALIAS" => "add-category",
		"URI_ALIAS_MULTI" => "info"
	),
	false
);?>
		</div>
		<div class="col-md-6">
			<?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.form", 
	".default", 
	array(
		"DEBUG" => "N",
		"FIELDS" => array(
			0 => "category_id",
		),
		"PASSED_FIELD" => "0",
		"REQUEST_API_METHOD" => "POST",
		"URI_ALIAS" => "set-category",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
		</div>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>