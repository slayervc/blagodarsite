import AjaxRequest from './AjaxRequest';

export default class PageLoader {

	constructor(container) {
		this.container = container;
		this.requester = new AjaxRequest;
	}

	setUrl(url){
		this.requester.setRequestUrl(url);
	}

	makeRequest() {
		return this.requester.send();
	}

}