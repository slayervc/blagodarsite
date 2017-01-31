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
	<?php if ($arParams['VIEW_TYPE'] == 'FILE'): ?>
		<a href="<?php echo $_SERVER['REQUEST_URI'] ?>">Получить отчет</a>
	<?php else: ?>
		<div class="row">
			<div class="col-md-12">
				<h2>CURRENT PAGE IS <?php echo $arResult['CURRENT_PAGE'] ?></h2>

				<a href="?page=<?php echo $arResult['NEXT_PAGE'] ?>"><?php echo $arResult['NEXT_PAGE'] ?></a>
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
<?php endif ?>




