import PageLoader from './libs/PageLoader';
import $ from 'jquery';

$(document).ready(() => {

	var loader = new PageLoader('[data-report]');

	var button = $('[data-page]');

	loader.setUrl(button.attr('href'));

	console.log(button.attr('href'));

	// var res = loader.makeRequest({
	// 	page_id: button.attr('data-page')
	// });

	// res.done((res) => {
	// 	console.log(res)
	// });

});









