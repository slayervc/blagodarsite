import $ from "jquery";
export default class PageLoader {

	/**
	 * @param  Object options
	 * @return void
	 */
	constructor(options) {
		this.container = $(options.container)
		this.template = options.template
	}


	updateContainer() {
		this.container.append(this.renderPage())
	}

	setData(dataObj){
		this.data = dataObj
	}

	renderPage(){
		return this.template(this.data)
	}


}