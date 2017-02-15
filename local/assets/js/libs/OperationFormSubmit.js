import $ from "jquery"
import alertElement from "./elements/alertElement"
import AlertContainer from "./AlertContainer/AlertContainer"

export default class OperationFormSubmit {


	/**
	 * [constructor description]
	 * @param  {[type]} form    [description]
	 * @param  {[type]} options [description]
	 * @return {[type]}         [description]
	 */
	constructor(form) {

		this.form                  = $(form)
		this.form.formAction       = this.form.attr('action')
		this.form.formMethod       = this.form.attr('method')
		this.form.form_id          = this.form.attr('name')
		this.form.inputs           = this.form.find('input')
		this.form.inputs           = this.form.inputs.not('[type="submit"]')
		this.alertContainerElement = $(this.form.attr('data-alert-container'))
		this.alertContainer        = AlertContainer

	}


	getFormInputs() {
		return this.form.inputs
	}


	/**
	 * [setContainerAlert description]
	 * @param {[type]} alertContainer [description]
	 */
	setAlertContainer(alertContainer) {
		this.alertContainer.setContainer($(alertContainer))
	}

	makeAlert(alertType, content) {

		let element = new alertElement()

		element.addAlertModifyer(alertType)

		element.setContent(content)

		this.alertContainer.push(element.render())

	}


	displayAlerts() {

		this.alertContainer = $.uniqueSort(this.alertContainer)

		// Clear the contianer element
		this.alertContainerElement.html('')

		// Append all errors to alertContainerElement
		this.alertContainer.forEach((el, index, arr) => {
			this.alertContainerElement.prepend(el)
		})
	}


	clearAlertContainer(alert_id = null) {
		if (alert_id) {
			this.alertContainer.splice(alert_id, 1)
		} else {
			this.alertContainer = []
		}
	}


	sendFormRequest(reqOptions) {
		return $.ajax(this.form.formAction, reqOptions);
	}

	sendCodeGenRequest(dataObj) {
		return this.sendFormRequest({
			method: 'POST',
			data: dataObj
		})
	}

}





