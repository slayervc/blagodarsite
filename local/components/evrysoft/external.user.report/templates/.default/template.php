<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<?php if ($arParams['DEBUG'] == 'Y'): ?>
	<p class="text-center alert alert-warning">
		<strong>Debug mode enabled</strong>
	</p>
	<p class="alert alert-info">
		Отчет по операциям
	</p>
<?php endif ?>

<?php if ($arResult['REPORT_DATA']['ROWS_COUNT'] == 0 ): ?>
	Операций нет 
<?php else: ?>
	<div class="row">
		<div class="col-md-12">
			<h2>Таблица отчетов по операциям</h2>
		</div>
	</div>
	<table class="table table-striped personal-content__table">
		<thead class="personal-content__table-head">
			<tr>
				<?php foreach ($arResult['REPORT_DATA']['LIST_HEADERS'] as $tableHeader): ?>
					<th><?php echo GetMessage($tableHeader); ?></th>
				<?php endforeach ?>
			</tr>
		</thead>
		<?php foreach ($arResult['REPORT_DATA']['LIST'] as $listItem): ?>
			<tr>
				<?php foreach ($listItem as $itemKey => $itemValue): ?>
					<td><?php echo $itemValue ?></td>	
				<?php endforeach ?>
			</tr>
		<?php endforeach ?>
	</table>
<?php endif ?>




