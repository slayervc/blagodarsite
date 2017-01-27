$(document).ready(function(){

	var form = $('.form')[0];

	var cl_field = $(form).find('input[name="cl_field"]');

	var submit = $(form).find('input[type="submit"]');

	var wrapper = $(form).parent();

	var alert = $('<div class="alert"></div>');

	submit.on('click', function(event) {
		event.preventDefault();
		
		// console.log(event);

		var action = $(form).attr('action'),
			actionType = $(form).attr('method');

		alert.addClass('alert-info');

		alert.html('Download...');

		wrapper.append(alert);

		$.ajax({
			url: action,
			type: actionType,
			data: {
				cl_field: cl_field.val()
			}
		})
		.done(function(res) {

			var jsonData = JSON.parse(res);

			console.log(jsonData);

			alert.removeClass('alert-info alert-danger alert-success');
			if (jsonData.status == 'ERROR') {
				alert.addClass('alert-danger');
			} else {
				alert.addClass('well');
			}

			var templateRes = '<p> Баланс: ' + jsonData.info.balance + '</p>' + 
							  '<p> ean13: ' + jsonData.info.ean13 + '</p>' +
							  '<p> Email: ' + jsonData.info.email + '</p>' +
							  '<p> ФИО: ' + jsonData.info.name + '</p>' +
							  '<p> Телефон: ' + jsonData.info.tel + '</p>';

			alert.html(templateRes);
		});
		

	});


});

