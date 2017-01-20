<?php foreach ($arResult['USER_DATA'] as $arKey => $arValue): ?>
		<div class="sidebar__info">
			<p class="sidebar__info-content sidebar__info-content--small">
				<?php echo GetMessage($arKey) ?>
			</p>
			<p class="sidebar__info-content sidebar__info-content--medium">
				<?php echo $arValue ?>
			</p>
		</div>
<?php endforeach ?>
		<div class="sidebar__advertising">
			<img src="http://placehold.it/400x400" alt="placeholder">
		</div>
		<div class="sidebar__actions">
			<a href="/auth/login.php?logout=yes&backurl=/" class="button button--bottom-shadow">Выйти</a>
		</div>



