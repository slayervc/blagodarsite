<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<?php if ($arParams['DEBUG'] == 'Y' && $USER->IsAdmin()): ?>
	<p class="text-center alert alert-warning">
		<strong>Debug mode enabled</strong>
	</p>
<?php endif ?>
<?php foreach ($arResult['USER_SHOW_DATA'] as $arKey => $arValue): ?>
	<div class="sidebar__info">
		<p class="sidebar__info-content sidebar__info-content--small">
			<?php if (!empty(GetMessage($arKey))): ?>
				<?php echo GetMessage($arKey) ?>
			<?php else: ?>
				<?php echo $arKey ?>
			<?php endif ?>
		</p>
		<p class="sidebar__info-content sidebar__info-content--medium">
			<?php echo $arValue ?>
		</p>
	</div>
<?php endforeach ?>


