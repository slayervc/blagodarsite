<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?><div class="col-md-4 sidebar">
	 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.user.info",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"DEBUG" => "N",
		"DONT_SHOW" => array(0=>"LEVEL",1=>"BLOCKED",2=>"ID",),
		"URI" => ""
	)
);?>
</div>
<div class="col-md-8 personal-content">
	<div class="row">
		<div class="col-md-12">
			<div class="personal-content__menu">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
 <a href="<?php echo $APPLICATION->GetCurPage() . 'send-form.php' ?>" class="btn btn-block btn-success"> Отправить смс </a>
							</div>
							<div class="col-md-6">
 <a href="<?php echo $APPLICATION->GetCurPage() . 'info/client.php' ?>" class="btn btn-block btn-success"> Получить информацию по клиенту </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.partner.operation.multi-form",
	"",
	Array(
		"DEBUG" => "N",
		"FIELDS" => array(),
		"PASSED_FIELD" => "",
		"URI_ALIAS" => "info"
	)
);?>
		</div>
		<div class="col-md-12">
			 <?$APPLICATION->IncludeComponent(
	"evrysoft:external.user.report",
	"",
	Array(
		"DATE_AFTER" => "",
		"DATE_BEFORE" => "",
		"DEBUG" => "N",
		"LIMIT" => "",
		"USE_PRELOAD" => "Y",
		"VIEW_TYPE" => "TABLE"
	)
);?>
		</div>
	</div>
</div>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>