$(document).ready(function (){

	var formSubmits = $('input[type="submit"]');

	formSubmits.on('click', function(event){
		event.preventDefault();

		// $(this).addClass('btn-block');

		var form = $(this).parents('form');

		// console.log(form);

		var formAction = $(form).attr('action');
		var formMethod = $(form).attr('method');

		var inputs = $(form).find('input');

		inputs = inputs.not('[type="submit"]');

		var formData = {};

		inputs.each(function(index, el) {
			formData[$(el).attr('name')] = $(el).val();
		});

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






