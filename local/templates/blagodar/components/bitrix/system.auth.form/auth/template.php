<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<div class="bx-system-auth-form">

	<pre>
		<?php var_dump($arResult); ?>
	</pre>

	<!-- <a href="<?php echo $arResult['~PROFILE_URL'] ?>">Profile</a> -->
	<?php if (!$USER->IsAuthorized()): ?>
		<a href="<?php echo $arResult['AUTH_REGISTER_URL'] ?>"></a>
	<?php endif ?>

</div>
