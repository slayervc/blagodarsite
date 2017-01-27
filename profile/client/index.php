<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?>
<div class="container">
	<div class="row">
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
		<div class="col-md-8 personal-content">
			<?php
			$APPLICATION->IncludeComponent(
				'evrysoft:external.user.report',
				'',
				Array(
					'DATE_BEFORE' => '',
					'DATE_AFTER' => ''
				)
			);
			?>
			</div>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

