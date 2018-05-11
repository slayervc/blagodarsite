<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?>
<div class="col-md-4">
	<?php $APPLICATION->IncludeComponent(
		"evrysoft:external.user.info", 
		".default", 
		array(
			"URI" => "",
			"COMPONENT_TEMPLATE" => ".default",
			"DONT_SHOW" => array(
				0 => "LEVEL",
				1 => "BLOCKED",
				2 => "ID",
			)
		),
		false
	);?>
</div>
<div class="col-md-8 personal-content">
	<?php
	$APPLICATION->IncludeComponent(
	"evrysoft:external.user.report", 
	".default", 
	array(
		"DATE_BEFORE" => "",
		"DATE_AFTER" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"DEBUG" => "N",
		"LIMIT" => "5",
		"USE_PRELOAD" => "N",
		"VIEW_TYPE" => "BLOCK",
		"DONT_SHOW" => array(
		)
	),
	false
);
	?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

