<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("авторизация");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");

if ($_GET['out']){
    unset($_SESSION['CLIENT_PA_TOKEN']);
    unset($_SESSION['CLIENT_PA_LOGIN']);
    unset($_SESSION['CLIENT_NAME']);
    LocalRedirect("/");
}

?>

<?php if (!$_SESSION['CLIENT_PA_TOKEN'] || !$_SESSION['CLIENT_PA_LOGIN']): ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <? if ($_GET['message']): ?>
                    <div class="alert alert-danger">
                        <p class="text-center"><?php echo $_GET['message'] ?></p>
                    </div>
                <? endif ?>

                <? if ($_GET['resetpassword']) {
                    $APPLICATION->IncludeComponent(
                        "evrysoft:external.client.reset.form",
                        "",
                        array()
                    );
                }
                else{
                    $APPLICATION->IncludeComponent(
                        "evrysoft:external.client.login.form",
                        "",
                        array()
                    );
                }

                 ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <? $APPLICATION->IncludeComponent(
        "evrysoft:external.client.personal.area",
        "",
        array(
		)
    ); ?>
<?php endif ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>