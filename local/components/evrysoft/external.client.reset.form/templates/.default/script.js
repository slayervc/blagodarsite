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

function getCode() {
    $('#registerFormMessage').hide();

    var errorMessages = '';

    if (!validatePhone($('#phoneInput').val())) errorMessages += '<p>Введите корректный номер телефона. Например, 71230987654</p>';

    if (errorMessages){
        showErrorMessage(errorMessages);
        return;
    }

    showWhaitingMessage();

    var clientData = {
        method: 'resetPasswordRequest',
        apikey: 'secret',
        params: $('#phoneInput').val(),
    };

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', clientData, function(answer){
        answer.message = answer.message ? answer.message : '';

        switch (answer.code){
            case 200:
                showSuccessMessage('<p>На ваш телефон отправлена СМС с кодом для сброса пароля.</p><p><a href="javascript:getCode()">Отправить код повторно</a></p>');
                $('#idInput').val(answer.data.id);
                $('#codeInput').show();
                $('#resetButton').show();
                break;
            default:
                showErrorMessage('<p>Произошла непредвиденная ошибка на сервере:</p><p>' + answer.message + '</p><p>Попруйте еще раз через минуту.</p>')
                break;
        }
    }, 'json');
}

function resetPassword() {
    $('#registerFormMessage').hide();

    var errorMessages = '';

    if (!$('#codeInput').val()) errorMessages += '<p>Введите код сброса пароля.</p>';

    if (errorMessages){
        showErrorMessage(errorMessages);
        return;
    }

    showWhaitingMessage();

    var clientData = {
        method: 'resetPasswordById',
        apikey: 'secret',
        params: {
            code: $('#codeInput').val(),
            id: $('#idInput').val()
        }
    };

    $.post(window.location.protocol + '//' + window.location.host + '/clientPAajax.php', clientData, function(answer){
        answer.message = answer.message ? answer.message : '';

        switch (answer.code){
            case 200:
                showSuccessMessage('<p>Пароль успешно сброшен. Новый пароль отправлен по СМС на ваш номер телефона.</p>');
                break;
            default:
                showErrorMessage('<p>Произошла непредвиденная ошибка на сервере:</p><p>' + answer.message + '</p><p>Попруйте еще раз через минуту.</p>')
                break;
        }
    }, 'json');
}