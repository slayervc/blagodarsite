<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?php if ($arParams['DEBUG']): ?>
	<p class="text-center alert alert-warning">
		<strong>Debug mode</strong>
	</p>
<?php endif ?>

<?php if ($arResult['PARTNERS']): ?>
	<?php foreach ($arResult['PARTNERS'] as $partner): ?>
		<p>
			Партнер:<strong><?php echo $partner['name'] ?></strong> ID: <small>#<?php echo $partner['id'] ?></small> 
			Категория партнера: <strong><?php echo $partner['category'] ?></strong>
		</p>
	<?php endforeach ?>
<?php endif ?>


