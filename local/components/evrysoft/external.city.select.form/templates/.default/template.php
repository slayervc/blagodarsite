<?php
    CUtil::InitJSCore(array('window', 'ajax'));
?>
<p><?echo $arResult['CURRENT_CITY']?></p>
<a href="javascript:" onclick="showDialog()">Выбрать город</a>