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
						"evrysoft:external.client.report",
						".default",
						Array(
							"DATE_AFTER" => "",
							"DATE_BEFORE" => "",
							"DEBUG" => "Y",
							"USE_PRELOAD" => "Y"
						)
					);?>
				</div>
			</div>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>