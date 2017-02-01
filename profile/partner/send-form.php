<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
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
			 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.sendform.sms",
	".default",
	Array(
		"DEBUG" => "Y"
	)
);?><br>
		</div>
	</div>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>