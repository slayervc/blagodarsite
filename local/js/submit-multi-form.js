$(document).ready(function (){

	var formSubmits = $('input[type="submit"]');

	formSubmits.on('click', function(event){
		event.preventDefault();

		var _self = $(this);

		var form = $(this).parents('form');

		var formAction = $(form).attr('action');
		var formMethod = $(form).attr('method');
		var form_id = $(form).attr('name');
		var inputs = $(form).find('input');

		inputs = inputs.not('[type="submit"]');

		if ($(this).attr('data-action') == 'get-code') {
			var loginVal = inputs.filter('[name="FORM[login]"]').val();
			var alert = makeLoadAlert('Downloading...', 'alert-info');

			var codeRequest = makeGetCodeRequest(formAction, loginVal, form_id);

			_self.parent().find('.alert').remove();
			_self.parent().append(alert);

			codeRequest.then(function(response){
				console.log(response);
				response = JSON.parse(response);

				_self.parent().find('.alert').remove();

				var alertClass = 'alert-success';
				var message = _self.attr('data-response-success') + ' ' + response.info;

				if (response.status == 'ERROR')
					alertClass = 'alert-danger';

				var resAlert = makeLoadAlert(message, alertClass);
				
				_self.parent().append(resAlert);

			});
		} else {
			var formData = {};

			inputs.each(function(index, el) {
				formData[$(el).attr('name')] = $(el).val();
			});

			formData.form_id = $(form).attr('name');

			console.log(formData);

			// Remove all alerts after click
			$('.alert').remove();

			var preloader = '<p class="alert alert-info preloader">Downloading...</p>';

			$(form).prepend(preloader);

			// Send Ajax Request
			$.ajax(formAction, {
				method: formMethod,
				data: formData
			}).done(function(res){
				console.log(res);

				$(form).find('.preloader').remove();

				var alertContent;

				if (typeof(JSON.parse(res) == 'object')) {
					var data = JSON.parse(res);
					alertContent = data.info;
				} else {
					var data = res;
					alertContent = data;
				}

				var alert = $('<div></div>');

				if (typeof(alertContent) == 'object') {
					for (var alertKey in alertContent) {
						alert.append('<p>' + alertKey + ' : ' + alertContent[alertKey] + '</p>');
					}
				} else {
					alert.prepend('<p>' + alertContent + '</p>');
				}

				alert.addClass('alert');

				if (data.status === 'ERROR') {
					alert.addClass('alert-danger');
				} else {
					alert.addClass('alert-success');
				}

				$(form).prepend(alert);

			});
		}

	});	


	var makeGetCodeRequest = function(formAction, login, formId) {

		var clientLogin = login;

		return $.ajax({
			url: formAction,
			method: 'POST',
			data: {
				type: 'get-code',
				login: clientLogin,
				form_id: formId
			},
		});
		
	}


	var makeLoadAlert = function (message, alert_class) {
		
		var template = $('<div></div>');

		template.addClass('alert');

		template.addClass(alert_class);

		// Insert Data
		template.html('<p>'+ message +'</p>');

		return template;

	}



});




