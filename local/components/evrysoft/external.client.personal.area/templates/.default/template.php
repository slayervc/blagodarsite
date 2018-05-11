<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="col-md-4">
    <div class="row">
        <div class="col-md-12 collapse sidebar__wrapper">
            <div class="row">
                <div class="sidebar__info sidebar__info--full col-md-12 col-sm-6 col-xs-6">

                    <h4>Баланс</h4>

                    <? foreach ($arResult['CLIENT_DATA']['balance'] as $name => $value){
                        echo '<p class="sidebar__info-content sidebar__info-content--small">';
                        echo $name . '</p>';
                        echo '<p id="clientBalance" class="sidebar__info-content sidebar__info-content--medium">';
                        echo $value . '</p>';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-8 personal-content">

    <div class="tabs">
        <div class="tabs__caption">

            <div class="tabs__btn btn btn-accent  active">Отчет</div>

            <?php if ($arResult['CLIENT_DATA']['isLegal']): ?>
                <div class="tabs__btn btn btn-accent ">Оплата</div>
            <?php endif ?>

            <div class="tabs__btn btn btn-accent ">Сменить пароль</div>
            <div class="tabs__btn btn btn-accent ">Настройки</div>
            <div class="tabs__btn btn btn-accent ">Бонусные системы</div>
            <div class="tabs__btn btn btn-accent ">Карты</div>
        </div>
        <div class="tabs__wrap">
             <!-- start tabs__content -->
            <div class="tabs__content active">
                <h3>Последние операции</h3>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Тип</th>
                        <th>Сумма</th>
                        <th>Плательщик</th>
                        <th>Получатель</th>
                    </tr>
                    </thead>

                    <? foreach ($arResult['TRANSACTIONS'] as $transaction) {
                        echo '<tr>';
                        echo '<td>' . $transaction['created'] . '</td>';
                        echo '<td>' . $transaction['typeName'] . '</td>';
                        echo '<td>' . $transaction['amount'] . '</td>';
                        echo '<td>' . $transaction['senderName'] . '</td>';
                        echo '<td>' . $transaction['receiverName'] . '</td>';
                        echo '</tr>';
                    } ?>

                </table>   
            </div>
            <!-- end tabs__content -->
            <!-- start tabs__content -->
            <?php if ($arResult['CLIENT_DATA']['isLegal']): ?>
            <div class="tabs__content">

                    <h3>Перевести бонусы Партнеру</h3>

                    <div id="findPartnerMessage" class="alert alert-danger" style="display: none"></div>

                    <form id="transactionForm" class="form partner-form" style="display: none">
                        <input type="hidden" id="findPartnerId">
                        <input type="hidden" id="transactionId">

                        <div class="form-group">
                            <label>Код подтверждения</label>
                            <input type="text" id="transactionCode" class="form-control partner-form__text-input">
                        </div>

                        <div class="form-group btn-22">
                            <input type="button" class="partner-form__button" value="Подтвердить" onclick="confirmTransaction()">
                            <input type="button" class="partner-form__button" value="Повторить отправку кода" onclick="getTransactionCode()">
                        </div>
                         
                    </form>

                    <form name="FindPartnerForm" class="form partner-form">

                        <div class="form-group">
                            <label>ИНН Партнера</label>
                            <input type="number" id="findPartnerINN" class="form-control partner-form__text-input">
                        </div>
                        <div class="form-group">
                            <label>Сумма перевода</label>
                            <input type="number" id="transactionAmount" class="form-control partner-form__text-input">
                        </div>
                        <div class="form-group">
                            <input type="button" class="partner-form__button" value="Получить код подтверждения" onclick="FindPartner()">
                        </div>
                    </form>
            </div>
            <?php endif ?>
            <!-- end tabs__content -->
            <!-- start tabs__content -->
            <div class="tabs__content">
                <h3>Сменить пароль</h3>

                <div id="clientPasswordMessage" class="alert alert-danger" style="display: none"></div>

                <form name="clientPasswordForm" class="form partner-form">

                    <div class="form-group">
                        <label>Старый пароль</label>
                        <input type="password" id="clientOldPassword" class="form-control partner-form__text-input">
                    </div>
                    <div class="form-group">
                        <label>Новый пароль</label>
                        <input type="password" id="clientNewPassword" class="form-control partner-form__text-input">
                    </div>
                    <div class="form-group">
                        <label>Повторите новый пароль</label>
                        <input type="password" id="clientNewPasswordRepeat" class="form-control partner-form__text-input">
                    </div>
                    <div class="form-group">
                        <input type="button" class="partner-form__button" value="Сменить пароль" onclick="sendNewClientPassword()">
                    </div>

                </form>    
            </div>
            <!-- end tabs__content -->
            <!-- start tabs__content -->
            <div class="tabs__content">
                <h3>Редактировать личные данные</h3>

                <div id="clientFormMessage" class="alert alert-danger" style="display: none"></div>

                <form name="clientEditForm" class="form partner-form">

                    <div class="form-group">
                        <label>ФИО</label>
                        <input type="text" id="clientName" class="form-control partner-form__text-input" placeholder="ФИО"
                               value="<?= $arResult['CLIENT_DATA']['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label>e-mail</label>
                        <input type="text" id="clientEmail" class="form-control partner-form__text-input" placeholder="e-mail"
                               value="<?= $arResult['CLIENT_DATA']['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label>День рождения (дд.мм.гггг)</label>
                        <input type="text" id="clientBirthday" class="form-control partner-form__text-input"
                               placeholder="День рождения (дд.мм.гггг)" value="<?= $arResult['CLIENT_DATA']['birthday'] ?>">
                    </div>
                    <div class="form-group">
                        <label><input type="checkbox" id="clientSendSystems"
                                      checked="<?= $arResult['CLIENT_DATA']['sendSystems'] ?>"> Отправлять системные
                            сообщения</label>
                    </div>
                    <div class="form-group">
                        <label><input type="checkbox" id="clientSendAdvertising"
                                      checked="<?= $arResult['CLIENT_DATA']['sendAdvertising'] ?>"> Отправлять рекламные
                            сообщения</label>
                    </div>
                    <div class="form-group">
                        <input type="button" class="partner-form__button" value="Сохранить" onclick="sendNewClientData()">
                    </div>

                </form>    
            </div>
            <!-- end tabs__content -->
            <!-- start tabs__content -->
            <div class="tabs__content">
                <h3>Бонусные системы</h3>

                <p>
                    Если Вы являетесь участником бонусной программы службы такси «Шесть двоек», отметьте это,
                    установив флажок ниже и нажав «Сохранить». После этого, Вы сможете расплатиться с любым Партнером
                    УБС «Благодарю» бонусами службы такси «Шесть двоек».
                </p>

                <div id="clientRelationsMessage" class="alert alert-danger" style="display: none"></div>

                <form name="clientRelationsForm" class="form partner-form">

                    <div class="form-group">
                        <label><input type="checkbox" id="clientRelations" <? if (! empty($arResult['RELATIONS'])) echo 'checked'; ?>> Я являюсь участником бонусной системы "Шесть двоек"</label>
                    </div>

                    <div class="form-group">
                        <input type="button" class="partner-form__button" value="Сохранить" onclick="sendClientRelations()">
                    </div>
                </form>
            </div>
            <!-- end tabs__content -->
            <!-- start tabs__content -->
            <div class="tabs__content">
                <h3>Ваши пластиковые карты</h3>

                <div id="cardMessage" class="alert alert-danger" style="display: none"></div>

                <? if (empty($arResult['CARDS'])){
                    echo '<p>К вашему лицевому счету не подключено ни одной пластиковой карты.</p>';
                }
                else{
                    echo '<table class="table table-striped">';

                    foreach ($arResult['CARDS'] as $card){
                        $statusName = $card['status'] != 0 ? 'Неактивна' : 'Активна';

                        echo '<tr>';
                        echo '<td>' . $card['name'] . '</td>';
                        echo '<td>' . $statusName . '</td>';

                        if (! $card['status']) echo '<td><a href="javascript:lockCard(' . $card['id'] . ')">заблокировать</a></td>';
                        else echo '<td>&nbsp;</td>';

                        echo '</tr>';
                    }

                    echo '</table>';
                }

                ?>
            </div>
            <!-- end tabs__content -->
        </div>
    </div>

</div>
