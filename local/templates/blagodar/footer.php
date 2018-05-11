			</div>
		</div>

	</main>

<footer class="footer">
	<div class="container">
		
		<div class="footer__main-foot">
			<div class="row">
				<div class="col-md-4">
					<div class="footer__logo">
						<img src="<?php echo SITE_TEMPLATE_PATH?>/dist/images/logo.png">
					</div>
					<div class="footer__copyright">
						© Copyright 2016. Все права защищены
					</div>
				</div>
				<div class="col-md-4 hidden-sm hidden-xs">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"bottom",
						Array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "left",
							"DELAY" => "N",
							"MAX_LEVEL" => "1",
							"MENU_THEME" => "site",
							"ROOT_MENU_TYPE" => "bottom",
							"USE_EXT" => "N"
						)
					);?>
				</div>
				<div class="col-md-4 hidden-sm hidden-xs">
					
				</div>
			</div>
		</div>
		<div class="footer__low-foot">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="footer__social-links">
						<span>Мы в соц.сетях: </span>
						<a href="#">
							<i class="footer__social-icon"></i>
						</a>
						<a href="#">
							<i class="footer__social-icon"></i>
						</a>
						<a href="#">
							<i class="footer__social-icon"></i>
						</a>
						<a href="#">
							<i class="footer__social-icon"></i>
						</a>
						<a href="#">
							<i class="footer__social-icon"></i>
						</a>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="footer__privacy-policy pull-right">
						<a href="#" class="footer__link">Политика конфиденциальности</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
</body>
</html>