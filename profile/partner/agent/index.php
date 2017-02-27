<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?><div class="col-md-12 personal-content">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
 					<a href="/profile/partner/" class="button button--small"> <span class="glyphicon glyphicon-chevron-left"></span> Назад</a>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<?$APPLICATION->IncludeComponent(
				"evrysoft:external.partner.agent.app",
				"",
				Array()
			);?>
		</div>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>