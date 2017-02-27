export default class alertElement {

	/**
	 * [constructor description]
	 * @param  {[type]} template [description]
	 * @return {[type]}          [description]
	 */
	constructor(template = null) {
		this.template = template ? template : require('./../../templates/handlebars/default-alert.handlebars')
		this.classes = []
		this.alertContent = ''
	}

	addAlertModifyer(modifyerName) {
		this.classes.push(`alert-${modifyerName}`)
	}

	setContent(content) {
		this.alertContent = content
	}

	render() {
		return this.template({
			content: this.alertContent,
			classes: this.classes
		})
	}

	// methods
}