<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?><div class="col-md-4 sidebar">
	 <?$APPLICATION->IncludeComponent(
		"evrysoft:external.user.info", 
		".default", 
		array(
			"COMPONENT_TEMPLATE" => ".default",
			"DEBUG" => "N",
			"DONT_SHOW" => array(
				0 => "LEVEL",
				1 => "BLOCKED",
				2 => "ID",
				3 => "CAN_CREATE_AGENTS"
			),
			"URI" => ""
		),
		false
	);?>
</div>
<div class="col-md-8 personal-content">
	<div class="row">
		<div class="col-md-12">
			 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.multi-form", 
	".default", 
	array(
		"DEBUG" => "N",
		"FIELDS" => array(
			0 => "sum",
			1 => "login",
			2 => "code",
		),
		"PASSED_FIELD" => "1",
		"URI_ALIAS" => "remove-client-balance",
		"FORM_HEADER" => "Списание баланса с клиента",
		"COMPONENT_TEMPLATE" => ".default",
		"MULTI_FIELD" => "2",
		"URI_ALIAS_MULTI" => "gen-balance-code",
		"REQUEST_API_METHOD" => "GET"
	),
	false
);?>
		</div>
		<div class="col-md-12">
			 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.multi-form", 
	".default", 
	array(
		"DEBUG" => "N",
		"FIELDS" => array(
			0 => "login",
			1 => "name",
			2 => "code",
		),
		"PASSED_FIELD" => "0",
		"URI_ALIAS" => "regclient",
		"FORM_HEADER" => "Добавление клиента",
		"COMPONENT_TEMPLATE" => ".default",
		"MULTI_FIELD" => "2",
		"URI_ALIAS_MULTI" => "gen-reg-code",
		"REQUEST_API_METHOD" => "GET"
	),
	false
);?>
		</div>
		<div class="col-md-12">
			<?$APPLICATION->IncludeComponent("evrysoft:external.partner.operation.form", ".default", array(
	"DEBUG" => "N",
		"FIELDS" => array(
			0 => "sum",
			1 => "partner_id",
		),
		"PASSED_FIELD" => "",
		"URI_ALIAS" => "add-partner-balance",
		"COMPONENT_TEMPLATE" => ".default",
		"REQUEST_API_METHOD" => "GET"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>
		</div>
		<div class="col-md-12">
			 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.form", 
	".default", 
	array(
		"DEBUG" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"FIELDS" => array(
			0 => "login",
		),
		"PASSED_FIELD" => "0",
		"URI_ALIAS" => "get-client-info",
		"REQUEST_API_METHOD" => "GET"
	),
	false
);?>
		</div>
		<div class="col-md-12">
			 <?$APPLICATION->IncludeComponent(
				"evrysoft:external.user.report", 
				".default", 
				array(
					"DATE_AFTER" => "",
					"DATE_BEFORE" => "",
					"DEBUG" => "N",
					"LIMIT" => "5",
					"USE_PRELOAD" => "Y",
					"VIEW_TYPE" => "BLOCK",
					"COMPONENT_TEMPLATE" => ".default",
					"DONT_SHOW" => array(
					)
				),
				false
			);?>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

