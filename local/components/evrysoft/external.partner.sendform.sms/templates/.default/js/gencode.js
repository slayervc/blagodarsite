
/**
 * [description]
 * @param  {[type]} ){	var form          [description]
 * @return {[type]}         [description]
 */

$(document).ready(function (){

	var form = $('.form')[0];

	var formAction = $(form).attr('action');
	var formMethod = $(form).attr('method');

	var login = $(form).find('input[name="cl-login"]');

	var button = $(form).find('input[name="submit"]');

	button.on('click', function(event){
		event.preventDefault();

		// Remove all alerts after click
		$('.alert').remove();

		var preloader = '<p class="alert alert-info preloader">Downloading...</p>';

		$(form).prepend(preloader);

		// Login value from input
		var _login = login.val();

		// Send Ajax Request
		$.ajax(formAction, {
			method: formMethod,
			data: {
				'cl-login': _login
			}
		}).done(function(res){

			$(form).find('.preloader').remove();

			var data = JSON.parse(res);

			var alertContent = data.status == 'ERROR' ? data.info : 'Отправлено по номеру ' + data.info

			var alert = $('<p>'+ alertContent +'</p>');

			alert.addClass('alert');

			if (data.status === 'ERROR') {
				alert.addClass('alert-danger');
			} else {
				alert.addClass('alert-success');
			}

			$(form).prepend(alert);

		});
	});

});






