import $ from "jquery"
import OperationFormSubmit from "./libs/OperationFormSubmit"


$(document).ready(() => {

	var formSubmits = $('input[type="submit"]');

	formSubmits.on('click', function(event){
		event.preventDefault();

		var _self = $(event.currentTarget);

		var form = new OperationFormSubmit(_self.parents('form'))

		form.makeAlert('info', 'Ожидание ответа от сервера...')

		form.displayAlerts()

		if (_self.attr('data-action') == 'get-code') {

			var inputs = form.getFormInputs()

			var login = $.trim(inputs.filter('[name="FORM[login]"]').val());

			form.sendCodeGenRequest({
				type: 'get-code',
				login: login,
				form_id: form.form.form_id
			})
			.then((response) => {
				form.clearAlertContainer()

				response = JSON.parse(response)

				if (response.status == 'ERROR') {
					form.makeAlert('danger', response)
				} else if(response.status == 'OK') {
					form.makeAlert('success', `Код отправлен на номер ${response.info}`)
				}

				form.displayAlerts()
			})

		} else {

			let inputs = form.form.inputs.toArray()
			let formData = {}

			inputs.forEach((el, index) => {
				formData[$(el).attr('name')] = $.trim($(el).val())
			})

			formData['form_id'] = form.form.form_id

			form.sendFormRequest({
				method: 'POST',
				data: formData 
			})
			.then((response) => {
				form.clearAlertContainer()
				console.log(response)

				response = JSON.parse(response)

				if (response.status == 'ERROR') {
					form.makeAlert('danger', response)
				} else if(response.status == 'OK') {
					form.makeAlert('success', response)
				}

				form.displayAlerts()
			})
	
		}

	});

});



