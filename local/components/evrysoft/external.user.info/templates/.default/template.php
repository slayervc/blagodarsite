<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>


<div class="row">
	<div class="col-md-12 sidebar__menu">
		<a role="button" 
		   data-toggle="collapse" 
		   data-target=".sidebar__wrapper" 
		   aria-expanded="false" 
		   class="link"
		>
			Личная информация <span class="caret"></span>
		</a>
	</div>
	<div class="col-md-12 collapse sidebar__wrapper">
		<div class="row">
			<?php foreach ($arResult['USER_SHOW_DATA'] as $arKey => $arValue): ?>
				<?php if (!empty($arValue)): ?>
					<div class="sidebar__info sidebar__info--full col-md-12 col-sm-6 col-xs-6">
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
				<?php endif ?>
			<?php endforeach ?>
			<?php if ($arResult['USER_ALL_DATA']['CAN_CREATE_AGENTS'] || $USER->IsAdmin()): ?>
			<div class="sidebar__info sidebar__info--full col-md-12 col-sm-6 col-xs-6">
				<a href="/profile/partner/agent" class="button button--small button-full">Дилер</a>
			</div>
			<?php endif ?>
		</div>
	</div>
</div>
