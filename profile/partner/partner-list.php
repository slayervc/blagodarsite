<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Лист партнеров");
?>
<div class="container">
	<div class="row">
		<div class="col-md-4 sidebar">
		<?$APPLICATION->IncludeComponent(
			"evrysoft:external.user.info",
			"",
			Array(
				"DEBUG" => "Y",
				"DONT_SHOW" => array()
			)
		);?>
		</div>
		<div class="col-md-8 personal-content">
		<?$APPLICATION->IncludeComponent(
			"evrysoft:external.user.partner-list",
			"",
			Array(
				"DEBUG" => "Y"
			)
		);?>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>


