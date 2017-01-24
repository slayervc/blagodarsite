<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?>
<div class="container">
	<div class="row">
		<div class="col-md-4 sidebar">
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
					),
					"DEBUG" => 'Y'
				),
				false
			);?>
		</div>
		<div class="col-md-8 personal-content">
			<?php/* $APPLICATION->IncludeComponent(
					"evrysoft:external.client.report", 
					".default", 
					array(
						"DATE_BEFORE" => "",
						"DATE_AFTER" => "",
						"DEBUG" => "Y",
						"COMPONENT_TEMPLATE" => ".default"
					),
					false
				);*/
			?>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

