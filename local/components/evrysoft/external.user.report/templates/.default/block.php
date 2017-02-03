<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?php 
	$this->addExternalJs('/local/js/same.js');
?>


<?php if ($arParams['DEBUG'] == 'Y'): ?>
	<div class="well">
		<?php var_dump($arParams) ?>
	</div>
	<hr>
	<div class="well">
		<?php var_dump($arResult) ?>
	</div>
<?php endif ?>


<div class="personal-content__report">
<?php if ($arResult['REPORT_DATA']['ROWS_COUNT'] == 0): ?>
	<h3>На данный момент у вас нет операций</h3>
<?php endif ?>
	<h3 class="personal-content__report-header">
		Отчет по выполненым операциям
	</h3>
<?php foreach ($arResult['REPORT_DATA']['LIST'] as $blockData): ?>

		<div class="well">
			<div class="row">
				<div class="col-md-6">
					<?php echo $blockData['date'] ?>
				</div>
				<div class="col-md-6">
					Баланс до операции: <?php echo $blockData['balance_before'] ?>
				</div>
				<div class="col-md-6">
					Баланс после: <?php echo $blockData['balance_after'] ?>
				</div>
				<!-- <div class="col-md-6">
					Снято: <?php echo $blockData['balance_after'] ?>
				</div>
				<div class="col-md-6">
					Зачислено: <?php echo $blockData['balance_after'] ?>
				</div> -->
				<div class="col-md-6">
					<strong>Операция: <?php echo $blockData['operation_descr'] ?></strong>
				</div>
				<div class="col-md-6">
					Клиент/Контрагент : <?php echo $blockData['client'] ?>
				</div>
			</div>
		</div>
<?php endforeach ?>
</div>

