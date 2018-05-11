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

function validatePhone(phone) {
    var regex = /^(8|\+7|7)\d{10}$/;
    return regex.test(phone);
}

function showErrorMessage(message){
    $('#registerFormMessage').attr('class', 'alert alert-danger');
    $('#registerFormMessage').html(message);
    $('#registerFormMessage').show();
}

function showSuccessMessage(message){
    $('#registerFormMessage').attr('class', 'alert alert-success');
    $('#registerFormMessage').html(message);
    $('#registerFormMessage').show();
}

function showWhaitingMessage(){
    $('#registerFormMessage').attr('class', 'alert alert-info');
    $('#registerFormMessage').html('<p>Подождите...</p>');
    $('#registerFormMessage').show();
}

function switchForm(){
    $('#registerFormMessage').hide();

    if ($('#registerFormType').val() == 1){
        $('#clientForm').show();
        $('#partnerForm').hide();
        $('#registerFormTitle').text('Регистрация Клиента');
    }
    else{
        $('#clientForm').hide();
        $('#partnerForm').show();
        $('#registerFormTitle').text('Регистрация Партнера');
    }
}

function switchClientINN(){
    if ($('#clientIsLegal').prop('checked')) $('#clientInnBlock').show()
    else $('#clientInnBlock').hide();
}

function showConfirmationForm(){
    showSuccessMessage('<p>На ваш телефон отправлена СМС с кодом подтверждения. ' + getRetryConfirmationLink() +
        '</p><p>Вводя код регистрации, вы соглашаетесь с <a href="' + window.location.protocol + '//' + window.location.host +
        '/about/description.php" target="blank">правилами</a>.</p>');
    $('#confirmationForm').show();
    $('#registerOptionForm').hide();
    $('#clientForm').hide();
}

function getRetryConfirmationLink(){
    return '<a href="javascript:retryClientConfirmation()">Отправить код повторно</a>';
}

function registerClient(){
    $('#registerFormMessage').hide();

    var errorMessages = '';

    if (!$('#clientName').val() || !$('#clientPhone').val()) errorMessages += '<p>Поля, отмеченные звездочкой, обязательны для заполнения.</p>';
    if (!validatePhone($('#clientPhone').val())) errorMessages += '<p>Введите корректный номер телефона. Например, 71230987654</p>';
    if ($('#clientEmail').val() && !validateEmail($('#clientEmail').val())) errorMessages += '<p>Введите корректный e-mail.</p>';
    if ($('#clientBirthday').val() && !validateDate($('#clientBirthday').val())) errorMessages += '<p>Введите дату рождения в формате дд.мм.гггг.</p>';
    if ($('#clientIsLegal').prop('checked') && !validateINN($('#clientINN').val())) errorMessages += '<p>ИНН должен содержать 10-12 цифр.</p>'

    if (errorMessages){
        showErrorMessage(errorMessages);
        return;
    }

    showWhaitingMessage();

    var clientData = {
        method: 'registerClient',
        apikey: 'secret',
        params: {
            siteCity: $('#registerCity').val(),
            name: $('#clientName').val(),
            login: $('#clientPhone').val(),
            email:$('#clientEmail').val(),
            birthday: $('#clientBirthday').val(),
            isLegal: $('#clientIsLegal').prop('checked') ? 1: 0,
        }
    };

    if ($('#clientIsLegal').prop('checked')) clientData.params.INN = $('#clientINN').val();

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', clientData, function(answer){
        answer.message = answer.message ? answer.message : '';

        switch (answer.code){
            case 200:
                $('#clientConfirmationId').val(answer.data.id);
                showConfirmationForm();
                break;
            case 422:
                showErrorMessage('<p>При проверке введенных вами значений сервер выдал ошибку:</p>' + answer.message)
                break;
            case 500:
                $('#clientConfirmationId').val(answer.data.id);
                showErrorMessage('<p>Не удалось отправить код подтверждения ' + getRetryConfirmationLink() + '</p>')
                break;
            default:
                showErrorMessage('<p>Произошла непредвиденная ошибка на сервере:</p>' + answer.message)
                break;
        }
    }, 'json');
}

function confirmClientRegistration(){
    showWhaitingMessage();

    var clientData = {
        method: 'confirmClient',
        apikey: 'secret',
        params: {
            code: $('#clientConfirmationCode').val(),
            client: $('#clientConfirmationId').val(),
        }
    };

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', clientData, function(answer){
        answer.message = answer.message ? answer.message : '';

        switch (answer.code){
            case 200:
                showSuccessMessage('<p>Регистрация прошла успешно. Вам отправлена СМС с паролем для входа в личный кабинет.</p><p><a href="javascript:resetPassword()">Сгенерировать новый пароль и отправить еще раз</a></p>');
                $('#confirmationForm').hide();
                $('#formBorder').hide();
                break;
            default:
                showErrorMessage('<p>Произошла непредвиденная ошибка на сервере:</p>' + answer.message + '<p>' + getRetryConfirmationLink() + '</p>')
                break;
        }
    }, 'json');
}

function retryClientConfirmation(){
    showConfirmationForm();
    showWhaitingMessage();

    var clientData = {
        method: 'retryClientConfirmation',
        apikey: 'secret',
        params: $('#clientConfirmationId').val(),
    };

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', clientData, function(answer){
        answer.message = answer.message ? answer.message : '';

        switch (answer.code){
            case 200:
                showSuccessMessage('<p>Код подтверждения повторно отправлен на ваш телефон. ' + getRetryConfirmationLink() + '</p>');
                break;
            default:
                showErrorMessage('<p>Произошла непредвиденная ошибка на сервере:</p>' + answer.message + '<p>' + getRetryConfirmationLink() + '</p>')
                break;
        }
    }, 'json');
}

function resetPassword(){
    showWhaitingMessage();

    var clientData = {
        method: 'resetPassword',
        apikey: 'secret',
        params: $('#clientConfirmationId').val(),
    };

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', clientData, function(answer){
        answer.message = answer.message ? answer.message : '';

        switch (answer.code){
            case 200:
                showSuccessMessage('<p>Новый пароль был сгенерирован и отправлен вам по СМС.</p><p><a href="javascript:resetPassword()">Сгенерировать новый пароль и отправить еще раз</a></p>');
                break;
            default:
                showErrorMessage('<p>Произошла непредвиденная ошибка на сервере:</p>' + answer.message + '<p>' + getRetryConfirmationLink() + '</p>')
                break;
        }
    }, 'json');
}

function registerPartner(){
    $('#registerFormMessage').hide();

    var errorMessages = '';

    if (!$('#partnerName').val() || !$('#partnerINN').val() || !$('#partnerContacts').val()) errorMessages += '<p>Поля, отмеченные звездочкой, обязательны для заполнения.</p>';
    if (!validateINN($('#partnerINN').val())) errorMessages += '<p>ИНН должен содержать 10-12 цифр.</p>'

    if (errorMessages){
        showErrorMessage(errorMessages);
        return;
    }

    showWhaitingMessage();

    var partnerData = {
        method: 'registerPartner',
        apikey: 'secret',
        params: {
            siteCity: $('#registerCity').val(),
            name: $('#partnerName').val(),
            INN: $('#partnerINN').val(),
            contacts: $('#partnerContacts').val(),
        }
    };

    if ($('#partnerReferer').val()) partnerData.params.registeredDealer = $('#partnerReferer').val();

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', partnerData, function(answer){
        answer.message = answer.message ? answer.message : '';

        switch (answer.code){
            case 200:
                $('#registerOptionForm').hide();
                $('#partnerForm').hide();
                showSuccessMessage('<p>Заявка на регистрацию успешно отправлена.</p>');
                break;
            case 422:
                showErrorMessage('<p>При проверке введенных вами значений сервер выдал ошибку:</p>' + answer.message)
                break;
            default:
                showErrorMessage('<p>Произошла непредвиденная ошибка на сервере:</p>' + answer.message)
                break;
        }
    }, 'json');
}

function setFormKind() {
    var params = window
        .location
        .search
        .replace('?', '')
        .split('&')
        .reduce(
            function (p, e) {
                var a = e.split('=');
                p[decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                return p;
            },
            {}
        );

    if (params['form']) $('#registerFormType').val(params['form']).change();
}