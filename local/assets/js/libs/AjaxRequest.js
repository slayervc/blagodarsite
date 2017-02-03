import $ from 'jquery';

export default class AjaxRequest {
	
	setRequestUrl(url){
		this.url = url;
	}

	send(data, method = 'GET') {
		var promise = $.ajax({
			method: method,
			url: this.url,
			data: data
		});

		return promise;
	}
}