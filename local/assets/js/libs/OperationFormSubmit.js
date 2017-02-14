import alertElement from "./elements/alertElement"
import $ from "jquery"


export default class OperationFormSubmit {


	/**
	 * [constructor description]
	 * @param  {[type]} form    [description]
	 * @param  {[type]} options [description]
	 * @return {[type]}         [description]
	 */
	constructor(form, options = null) {

		this.form            = $(form)
		this.form.formAction = this.form.attr('action')
		this.form.formMethod = this.form.attr('method')
		this.form.form_id    = this.form.attr('name')
		this.form.inputs     = this.form.find('input')
		this.form.inputs     = this.form.inputs.not('[type="submit"]')
		this.options = options

	}

	/**
	 * [setContainerAlert description]
	 * @param {[type]} alertContainer [description]
	 */
	setAlertContainer(alertContainer) {
		this.alertContainer = this.form.children(alertContainer)
		this.alertContainer.alerts = []
		// console.log(this.alertContainer)
	}

	makeAlert(alertType, content) {

		let element = new alertElement()

		element.addAlertModifyer(alertType)

		element.setContent(content)

		this.alertContainer.alerts.push(element.render())

		console.log(this.alertContainer.alerts)

	}


	displayAlerts() {
		this.alertContainer.alerts.forEach((el, index, arr,) => {
			this.alertContainer.html(el)
		})
	}


	clearAlertContainer(alert_id = null) {
		if (alert_id) {
			this.alertContainer.alerts.splice(alert_id, 1)
		} else {
			this.alertContainer.alerts = []
		}
	}

	// sendFormRequest() {
	// 	var formPromise = $.ajax(this.form.formAction, {
	// 		method: this.form.formMethod,
	// 		data: formData
	// 	});
	// }


}





// .done(function(res){
// 			console.log(res);

// 			$(form).find('.preloader').remove();

// 			var alertContent;

// 			if (typeof(JSON.parse(res) == 'object')) {
// 				var data = JSON.parse(res);
// 				alertContent = data.info;
// 			} else {
// 				var data = res;
// 				alertContent = data;
// 			}

// 			var alert = $('<div></div>');

// 			if (typeof(alertContent) == 'object') {
// 				for (var alertKey in alertContent) {
// 					alert.append('<p>' + alertKey + ' : ' + alertContent[alertKey] + '</p>');
// 				}
// 			} else {
// 				alert.prepend('<p>' + alertContent + '</p>');
// 			}

// 			alert.addClass('alert');

// 			if (data.status === 'ERROR') {
// 				alert.addClass('alert-danger');
// 			} else {
// 				alert.addClass('alert-success');
// 			}

// 			$(form).prepend(alert);

// 		})