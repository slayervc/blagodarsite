<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<?php if ($arParams['DEBUG'] == 'Y'): ?>
	<div class="well">
		<?php var_dump($arParams) ?>
	</div>
	<hr>
	<div class="well">
		<?php var_dump($arResult['REPORT_DATA']['LIST']) ?>
	</div>
<?php endif ?>


<?php 
	$this->addExternalJs('/local/js/reportLoader.js');
?>


<div class="personal-content__report" data-report="personal-content__report-container">
<?php if ($arResult['REPORT_DATA']['ROWS_COUNT'] == 0): ?>
	<h3>На данный момент у вас нет операций</h3>
<?php else: ?>
	<h3 class="personal-content__report-header">
		Отчет по выполненым операциям
	</h3>
	<div class="row">
		<div class="col-md-12 personal-content__report-container">
			<?php foreach ($arResult['REPORT_DATA']['LIST'] as $blockData): ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">
							<div class="row">
								<div class="col-md-6 pull-left">
									<?php echo $blockData['date'] ?>
								</div>
								<div class="col-md-6 pull-right text-right">
									<strong>
									Баланс:
									</strong>
									<span class="balance balance--before">
										<?php echo $blockData['balance_before'] ?>
									</span>
									<span class="balance balance--arrow">
										>
									</span>
									<span class="balance balance--after">
										<?php echo $blockData['balance_after'] ?>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6 text-left">
								<strong>Операция: <?php echo $blockData['operation_descr'] ?></strong>
							</div>
							<div class="col-md-6 text-right">
								Клиент/Контрагент : <?php echo $blockData['client'] ?>
							</div>
							<div class="col-md-6 text-left">
								<strong>
									<?php if ($blockData['sum_minus_partner']): ?>
										Списано: 
										<span class="sum">
											<?php echo $blockData['sum_minus_partner'] ?>
										</span>
									<?php else: ?>
										Зачислено: 
										<span class="sum">
											<?php echo $blockData['sum_plus_partner'] ?>
										</span>
									<?php endif ?>
								</strong>
							</div>
							<div class="col-md-6 text-right">
								<strong>Комиссия:</strong>
								<span class="sum">
									<?php echo $blockData['sum_comission_partner'] ?>
								</span>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">
							<div class="row">
								<div class="col-md-6 pull-left">
									<?php echo $blockData['date'] ?>
								</div>
								<div class="col-md-6 pull-right text-right">
									<strong>
										Баланс:
									</strong> 
									<span class="balance balance--before">
										<?php echo $blockData['balance_before'] ?>
									</span>
									<span class="balance balance--arrow">
										>
									</span>
									<span class="balance balance--after">
										<?php echo $blockData['balance_after'] ?>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6 text-left">
								<strong>Операция: <?php echo $blockData['operation_descr'] ?></strong>
							</div>
							<div class="col-md-6 text-right">
								Клиент/Контрагент : <?php echo $blockData['client'] ?>
							</div>
						</div>
					</div>
				</div> -->
			<?php endforeach ?>
		</div>
	</div>
	<div class="col-md-12 text-center">
		<a href="<?php echo $arResult['REQUEST_PAGE'] ?>" data-page="<?php echo $arResult['REPORT_DATA']['NEXT_PAGE_ID'] ?>" class="button button--download">
			Посмотреть еще
		</a>
	</div>
</div>
<?php endif ?>

