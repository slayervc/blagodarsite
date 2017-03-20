<?php
    CUtil::InitJSCore(array('window', 'ajax'));
?>

<div class="header__auth-container">
    <span style="vertical-align: middle"><?echo $arResult['CURRENT_CITY']?></span>
    <a href="javascript:" onclick="showDialog()" class="btn btn-default header__auth-button" style="float:right">Изменить</a>
</div>