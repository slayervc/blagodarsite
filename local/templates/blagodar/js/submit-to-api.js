$(document).ready(function () {

	var regForm = $('form[name="regform"]');

	var regFormInputs = regForm.find('input');

	var getCodeButton = $('#get_code_button');

	regForm.on('submit', function (event) {
		

		if (phoneCode !== '') {
			return;
		}
		

		event.preventDefault();
	});


	getCodeButton.on('click', function (e) {
		
		e.preventDefault();

		var _self = $(this);

		var url = $(this).attr('data-get-code-url');

		var phoneNumber = regFormInputs.filter('input[name="REGISTER[PERSONAL_MOBILE]"]').val();


		if (_self.hasClass('disabled')) {
			return;
		}

		var codeResponse = AjaxRequester.getAuthCode(url, {
			login: phoneNumber,
			type: 'json'
		});

		codeResponse.done(function(response) {
			console.log(response);

			var $response = JSON.parse(response);

			_self.parent().find('.alert').remove();

			var alertElement = document.createElement('div');

			$(alertElement).addClass('alert');

			if ($response.status == "ERROR") {
				$(alertElement).addClass('alert-danger');

				$(alertElement).html($response.info);
			}
			if ($response.status == "OK") {
				$(alertElement).addClass('alert-success');

				$(alertElement).html('Код был выслан на номер:' + $response.info)
			}

			_self.parent().append(alertElement);

		});

	});


	var AjaxRequester = (function () {

		var _self = this;

		var AjaxRequester = {

			getAuthCode: function($url, $data) {
				var res = this.makeRequest('GET', $url, $data);
				return res;
			},

			makeRequest: function($method, $url, $dataObj) {
				return $.ajax({
					url: $url,
					type: $method,
					data: $dataObj
				});
			}

		}


		return AjaxRequester;
	})();



});










