function validateEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function validateDate(date) {
    var regex = /^\d{2}.\d{2}.\d{4}$/;
    return regex.test(date);
}

function validateINN(INN) {
    var regex = /^[0-9]{10,12}$/;
    return regex.test(INN);
}

function validateAmount(amount) {
    var regex = /^[1-9][0-9]{2,5}$/;
    return regex.test(amount);
}

function showErrorMessage(message){
    $('#clientFormMessage').attr('class', 'alert alert-danger');
    $('#clientFormMessage').html(message);
    $('#clientFormMessage').show();
}

function showPasswordErrorMessage(message){
    $('#clientPasswordMessage').attr('class', 'alert alert-danger');
    $('#clientPasswordMessage').html(message);
    $('#clientPasswordMessage').show();
}

function showRelationsErrorMessage(message){
    $('#clientRelationsMessage').attr('class', 'alert alert-danger');
    $('#clientRelationsMessage').html(message);
    $('#clientRelationsMessage').show();
}

function showPartnerErrorMessage(message){
    $('#findPartnerMessage').attr('class', 'alert alert-danger');
    $('#findPartnerMessage').html(message);
    $('#findPartnerMessage').show();
}

function showCardErrorMessage(message){
    $('#cardMessage').attr('class', 'alert alert-danger');
    $('#cardMessage').html(message);
    $('#cardMessage').show();
}

function showSuccessMessage(message){
    $('#clientFormMessage').attr('class', 'alert alert-success');
    $('#clientFormMessage').html(message);
    $('#clientFormMessage').show();
}

function showPasswordSuccessMessage(message){
    $('#clientPasswordMessage').attr('class', 'alert alert-success');
    $('#clientPasswordMessage').html(message);
    $('#clientPasswordMessage').show();
}

function showRelationsSuccessMessage(message){
    $('#clientRelationsMessage').attr('class', 'alert alert-success');
    $('#clientRelationsMessage').html(message);
    $('#clientRelationsMessage').show();
}

function showPartnerSuccessMessage(message){
    $('#findPartnerMessage').attr('class', 'alert alert-success');
    $('#findPartnerMessage').html(message);
    $('#findPartnerMessage').show();
}

function showCardSuccessMessage(message){
    $('#cardMessage').attr('class', 'alert alert-success');
    $('#cardMessage').html(message);
    $('#cardMessage').show();
}

function showWhaitingMessage(){
    $('#clientFormMessage').attr('class', 'alert alert-info');
    $('#clientFormMessage').html('<p>Подождите...</p>');
    $('#clientFormMessage').show();
}

function showPasswordWhaitingMessage(){
    $('#clientPasswordMessage').attr('class', 'alert alert-info');
    $('#clientPasswordMessage').html('<p>Подождите...</p>');
    $('#clientPasswordMessage').show();
}

function showRelationsWhaitingMessage(){
    $('#clientRelationsMessage').attr('class', 'alert alert-info');
    $('#clientRelationsMessage').html('<p>Подождите...</p>');
    $('#clientRelationsMessage').show();
}

function showPartnerWhaitingMessage(){
    $('#findPartnerMessage').attr('class', 'alert alert-info');
    $('#findPartnerMessage').html('<p>Подождите...</p>');
    $('#findPartnerMessage').show();
}

function showPartnerInfoMessage(partner){
    $('#findPartnerMessage').attr('class', 'alert alert-warning');
    $('#findPartnerMessage').html('<p>На ваш телефон отправлен СМС код подтверждения.</p><p>Внимательно проверьте данные Партнера перед подтверждением перевода:</p><p><b>Наименование: </b>'
        + partner.name + '</p><p><b>Город: </b>' + partner.city + '</p><p><b>ИНН: </b>' + partner.INN + '</p>');
    $('#findPartnerMessage').show();
}

function updateClientForm(data){
    $('#clientName').val(data.name);
    $('#clientEmail').val(data.email);
    $('#clientBirthday').val(data.birthday);
    $('#clientSendSystem').val(data.sendSystem);
    $('#clientSendAdvertising').val(data.sendAdvertising);
}

function sendNewClientData(){
    $('#clientFormMessage').hide();

    var errorMessages = '';

    if ($('#clientEmail').val() && !validateEmail($('#clientEmail').val())) errorMessages += '<p>Введите корректный e-mail.</p>';
    if ($('#clientBirthday').val() && !validateDate($('#clientBirthday').val())) errorMessages += '<p>Введите дату рождения в формате дд.мм.гггг.</p>';

    if (errorMessages){
        showErrorMessage(errorMessages);
        return;
    }

    showWhaitingMessage();

    var clientData = {
        method: 'edit',
        apikey: 'secret',
        params: {
            name: $('#clientName').val(),
            email:$('#clientEmail').val(),
            birthday: $('#clientBirthday').val(),
            sendSystems: $('#clientSendSystems').prop('checked') ? 1: 0,
            sendAdvertising: $('#clientSendAdvertising').prop('checked') ? 1: 0,
        }
    };

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', clientData, function(answer){
        answer.message = answer.message ? answer.message : '';

        switch (answer.code){
            case 200:
                showSuccessMessage('<p>Сохранение прошло успешно.</p>');
                updateClientForm(answer.data);
                break;
            case 401:
                location.reload();
                break;
            case 422:
                showErrorMessage('<p>При проверке введенных вами значений сервер выдал ошибку:</p>' + answer.message)
                break;
            default:
                showErrorMessage('<p>Произошла непредвиденная ошибка на сервере.</p>')
                break;
        }
    }, 'json');
}

function sendNewClientPassword(){
    $('#clientPasswordMessage').hide();

    var errorMessages = '';

    if (!$('#clientOldPassword').val() || !$('#clientNewPassword').val() || !$('#clientNewPasswordRepeat').val())
        errorMessages += '<p>Заполните все три поля.</p>';

    if ($('#clientNewPassword').val().length < 6) errorMessages += '<p>Новый пароль должен быть не короче 6 символов.</p>';

    if ($('#clientNewPassword').val() == $('#clientOldPassword').val()) errorMessages += '<p>Новый пароль должен отличаться от старого.</p>';

    if ($('#clientNewPassword').val() != $('#clientNewPasswordRepeat').val()) errorMessages += '<p>Введенные вами новые пароли не совпадают.</p>';

    if (errorMessages){
        showPasswordErrorMessage(errorMessages);
        return;
    }

    showPasswordWhaitingMessage();

    var passwordData = {
        method: 'changePassword',
        apikey: 'secret',
        params: {
            oldPassword: $('#clientOldPassword').val(),
            newPassword: $('#clientNewPassword').val()
        }
    };

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', passwordData, function(answer){
        switch (answer.code){
            case 200:
                showPasswordSuccessMessage('<p>Пароль успешно изменен.</p>');
                break;
            case 401:
                showPasswordErrorMessage('<p>Старый пароль введен неверно.</p>')
                break;
            default:
                showPasswordErrorMessage('<p>Произошла непредвиденная ошибка на сервере.</p>')
                break;
        }
    }, 'json');
}

function sendClientRelations(){
    $('#clientRelationsMessage').hide();
    showRelationsWhaitingMessage();

    var relations = $('#clientRelations').prop('checked') ? [1] : [];
    var passwordData = {
        method: 'saveRelations',
        apikey: 'secret',
        params: relations
    };

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', passwordData, function(answer){
        switch (answer.code){
            case 200:
                showRelationsSuccessMessage('<p>Сохранено.</p>');
                break;
            default:
                showRelationsErrorMessage('<p>Произошла непредвиденная ошибка на сервере.</p>')
                break;
        }
    }, 'json');
}

function getTransactionCode(partner){
    if (partner) $('#findPartnerId').val(partner.id);

    var transactionData = {
        method: 'transaction',
        apikey: 'secret',
        params: {
            amount: $('#transactionAmount').val(),
            partner: $('#findPartnerId').val()
        }
    };

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', transactionData, function(answer){
        answer.message = answer.message ? answer.message : '';

        switch (answer.code){
            case 200:
                $('#transactionId').val(answer.data.id);
                if (partner) showPartnerInfoMessage(partner);
                $('#transactionForm').show();
                break;
            case 401:
                location.reload();
                break;
            case 400:
                showPartnerErrorMessage('<p>При попытке создать транзакцию сервер вернул ошибку:</p>' + answer.message)
                break;
            case 422:
                showPartnerErrorMessage('<p>При проверке введенных вами значений сервер выдал ошибку:</p>' + answer.message)
                break;
            default:
                showPartnerErrorMessage('<p>Произошла непредвиденная ошибка на сервере.</p>')
                break;
        }
    }, 'json');
}

function FindPartner(){
    $('#findPartnerMessage').hide();
    $('#transactionForm').hide();
    $('#findPartnerId').val('');

    var errorMessages = '';

    if (!validateINN($('#findPartnerINN').val())) errorMessages += '<p>ИНН должен содержать 10-12 цифр.</p>';
    if (!validateAmount($('#transactionAmount').val())) errorMessages += '<p>Сумма транзакции должна быть числом больше 99.</p>';

    if (errorMessages){
        showPartnerErrorMessage(errorMessages);
        return;
    }

    showPartnerWhaitingMessage();

    var partnerData = {
        method: 'getPartner',
        apikey: 'secret',
        params: $('#findPartnerINN').val()
    };

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', partnerData, function(answer){
        switch (answer.code){
            case 200:
                getTransactionCode(answer.data);
                break;
            case 401:
                location.reload();
                break;
            case 404:
                showPartnerErrorMessage('<p>Партнер с таким ИНН не найден.</p>')
                break;
            default:
                showPartnerErrorMessage('<p>Произошла непредвиденная ошибка на сервере.</p>')
                break;
        }
    }, 'json');
}

function confirmTransaction(){

    var confirmationData = {
        method: 'confirmTransaction',
        apikey: 'secret',
        params: {
            transaction: $('#transactionId').val(),
            code: $('#transactionCode').val()
        }
    };

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', confirmationData, function(answer){
        answer.message = answer.message ? answer.message : '';

        switch (answer.code){
            case 200:
                showPartnerSuccessMessage('<p>Платеж выполнен успешно.</p>');
                $('#transactionForm').hide();
                $('#clientBalance').text(answer.data.balance);
                break;
            case 401:
                location.reload();
                break;
            case 400:
                showPartnerErrorMessage('<p>При попытке провести транзакцию сервер вернул ошибку:</p>' + answer.message)
                break;
            default:
                showPartnerErrorMessage('<p>Произошла непредвиденная ошибка на сервере.</p>')
                break;
        }
    }, 'json');
}

function lockCard(id){

    if (! confirm('Разблокировать карту можно только обратившись к Оператору или любому Партнеру УБС "Благодарю". Заблокировать карту?')) return;

    var data = {
        method: 'lockCard',
        apikey: 'secret',
        params: id
    };

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', data, function(answer){

        switch (answer.code){
            case 200:
                showCardSuccessMessage('<p>Карта заблокирована.</p>');
                break;
            default:
                showCardErrorMessage('<p>Произошла непредвиденная ошибка на сервере.</p>')
                break;
        }
    }, 'json');
}

// табы
$(function() {
var tab = ('tabs');
// $(' .' + tab + '__caption   .' + tab + '__btn:first-child  ').addClass('active')
 // $('.' + tab + '__content:first-child ').addClass("active");
$('.' + tab + '__caption').on('click', '.' + tab + '__btn:not(.active)', function(e) {

  $(this)
    .addClass('active').addClass('current').siblings().removeClass('active')
    .closest('.' + tab + '').find('.' + tab + '__content').hide().removeClass('active')
    .eq($(this).index()).fadeIn().addClass('active');
   
    // $('.slider-small, .slider-big').slick('unslick');
    //  section_slider();
    return false;
});
});