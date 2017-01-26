<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?>
<div class="container">
	<div class="row">
		<div class="col-md-4 sidebar">
			 <?$APPLICATION->IncludeComponent(
				"evrysoft:external.user.info",
				".default",
				Array(
					"COMPONENT_TEMPLATE" => ".default",
					"DEBUG" => "Y",
					"DONT_SHOW" => array(0=>"LEVEL",1=>"BLOCKED",2=>"ID",),
					"URI" => ""
				)
			);?>
		</div>
		<div class="col-md-8 personal-content">
			<div class="row">
				<div class="col-md-12">
					 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.form", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"FIELDS" => array(
			0 => "login",
		),
		"URI_ALIAS" => "gen-reg-code",
		"PASSED_FIELD" => "0",
		"URI_ALIASES" => "info",
		"DEBUG" => "N"
	),
	false
);?>
				</div>
				<div class="col-md-12">
					 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.form", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"FIELDS" => array(
			0 => "login",
			1 => "name",
			2 => "code",
		),
		"URI_ALIAS" => "regclient",
		"PASSED_FIELD" => "0",
		"DEBUG" => "N"
	),
	false
);?>
				</div>
				<div class="col-md-12">
					 <?$APPLICATION->IncludeComponent(
						"evrysoft:external.partner.operation.form", 
						".default", 
						array(
							"COMPONENT_TEMPLATE" => ".default",
							"FIELDS" => array(
								1 => "LOGIN_FIELD",
							),
							"URI_ALIAS" => "add-partner-balace"
						),
						false
					);?>
				</div>
			</div>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>