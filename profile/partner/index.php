<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?><div class="container">
	<div class="row">
		<div class="col-md-4 sidebar">
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
		),
		"URI" => ""
	),
	false
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
									<div class="col-md-12">
 <br>
 <a href="<?php echo $APPLICATION->GetCurPage() . 'operation/'?>" class="btn btn-block btn-success">Провести операции </a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					 <?$APPLICATION->IncludeComponent(
						"evrysoft:external.user.report", 
						".default", 
						array(
							"DATE_AFTER" => "",
							"DATE_BEFORE" => "",
							"DEBUG" => "N",
							"USE_PRELOAD" => "Y",
							"COMPONENT_TEMPLATE" => ".default"
						),
						false
					);?>
				</div>
			</div>
		</div>
	</div>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>