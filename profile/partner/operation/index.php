<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Личный кабинет");
?><div class="container">
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
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"DEBUG" => "N",
		"FIELDS" => array(0=>"login",),
		"PASSED_FIELD" => "0",
		"URI_ALIAS" => "gen-reg-code",
		"URI_ALIASES" => "info"
	)
);?>
				</div>
				<div class="col-md-12">
					 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.form",
	".default",
	Array(
		"DEBUG" => "N",
		"FIELDS" => array(0=>"login",1=>"name",2=>"code",),
		"PASSED_FIELD" => "0",
		"URI_ALIAS" => "regclient"
	)
);?>
				</div>
				<div class="col-md-12">
					 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.form",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"DEBUG" => "N",
		"FIELDS" => array(0=>"sum",1=>"partner_id",),
		"PASSED_FIELD" => "",
		"URI_ALIAS" => "add-partner-balace"
	)
);?>
				</div>
				<div class="col-md-12">
					 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.form",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"DEBUG" => "N",
		"FIELDS" => array(0=>"sum",1=>"login",),
		"PASSED_FIELD" => "1",
		"URI_ALIAS" => "add-client-balance"
	)
);?><br>
					 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.form",
	"",
	Array(
		"DEBUG" => "N",
		"FIELDS" => array("sum","login"),
		"PASSED_FIELD" => "1",
		"URI_ALIAS" => "add-client-balance-proc"
	)
);?><br>
					 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.form",
	"",
	Array(
		"DEBUG" => "N",
		"FIELDS" => array("login"),
		"PASSED_FIELD" => "0",
		"URI_ALIAS" => "gen-balance-code"
	)
);?><br>
					 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.form",
	"",
	Array(
		"DEBUG" => "N",
		"FIELDS" => array("sum","login","code"),
		"PASSED_FIELD" => "1",
		"URI_ALIAS" => "remove-client-balance"
	)
);?><br>
				</div>
			</div>
		</div>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>