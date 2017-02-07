<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<?php if ($arParams['DEBUG'] == 'Y' && $USER->IsAdmin()): ?>
	<p class="text-center alert alert-warning">
		<strong>Debug mode enabled</strong>
	</p>
<?php endif ?>
<div class="row">
	<div class="col-md-12 sidebar__menu">
		<button role="button" 
		   data-toggle="collapse" 
		   data-target=".sidebar__wrapper" 
		   aria-expanded="false" 
		   class="button button--small button--bordered"
		>
			Личная информация
		</button>
	</div>
	<div class="col-md-12 collapse sidebar__wrapper">
		<?php foreach ($arResult['USER_SHOW_DATA'] as $arKey => $arValue): ?>
			<div class="sidebar__info sidebar__info--full">
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
	</div>
</div>
