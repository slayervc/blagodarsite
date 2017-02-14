import $ from "jquery"
import OperationFormSubmit from "./libs/OperationFormSubmit"


$(document).ready(() => {

	var formSubmits = $('input[type="submit"]');

	formSubmits.on('click', function(event){
		event.preventDefault();

		var _self = $(event.currentTarget);

		var form = new OperationFormSubmit(_self.parents('form'))

		form.setAlertContainer('div[data-alert-container]')

		form.makeAlert('info', 'Ожидание ответа от сервера...')

		form.displayAlerts()

		// var resPromise = form.sendFormRequest()

		// inputs = inputs.not('[type="submit"]');

		if (_self.attr('data-action') == 'get-code') {
	// 		var loginVal = inputs.filter('[name="FORM[login]"]').val();
	// 		var alert = makeLoadAlert('Downloading...', 'alert-info');

	// 		var codeRequest = makeGetCodeRequest(formAction, loginVal, form_id);

	// 		_self.parent().find('.alert').remove();
	// 		_self.parent().append(alert);

	// 		codeRequest.then(function(response){
	// 			console.log(response);
	// 			response = JSON.parse(response);

	// 			_self.parent().find('.alert').remove();

	// 			var alertClass = 'alert-success';
	// 			var message = _self.attr('data-response-success') + ' ' + response.info;

	// 			if (response.status == 'ERROR')
	// 				alertClass = 'alert-danger';

	// 			var resAlert = makeLoadAlert(message, alertClass);
				
	// 			_self.parent().append(resAlert);

	// 		});
		} else {
	// 		var formData = {};

	// 		inputs.each(function(index, el) {
	// 			formData[$(el).attr('name')] = $.trim($(el).val());
	// 		});

	// 		formData.form_id = $(form).attr('name');

	// 		console.log(formData);

	// 		// Remove all alerts after click
	// 		$('.alert').remove();

	// 		var preloader = '<p class="alert alert-info preloader">Downloading...</p>';

	// 		$(form).prepend(preloader);

	// 		// Send Ajax Request
	
		}

	});	


	// var makeGetCodeRequest = function(formAction, login, formId) {

	// 	var clientLogin = login;

	// 	return $.ajax({
	// 		url: formAction,
	// 		method: 'POST',
	// 		data: {
	// 			type: 'get-code',
	// 			login: clientLogin,
	// 			form_id: formId
	// 		},
	// 	});
		
	// }

	// var makeLoadAlert = function (message, alert_class) {
		
	// 	var template = $('<div></div>');

	// 	template.addClass('alert');

	// 	template.addClass(alert_class);

	// 	// Insert Data
	// 	template.html('<p>'+ message +'</p>');

	// 	return template;

	// }


});