import PageLoader from './libs/PageLoader'
import $ from 'jquery'

$(document).ready(() => {

	var loadButton = $('a[data-page]');
	var startButtonText = loadButton.html();
	var actionUri = loadButton.attr('href');

	var pageLoader = new PageLoader({
		container: '.personal-content__report-container',
		template: require('./templates/handlebars/report-block.handlebars'),
	});

	loadButton.on('click', (event) => {
		event.preventDefault();
		var target = $(event.currentTarget);

		target.html('...');

		$.ajax({
			url: actionUri,
			type: 'GET',
			data: {NEXT_PAGE_ID: target.attr('data-page')},
		}).then((response) => {

			var resData = JSON.parse(response);
			console.log(resData.list);

			target.html(startButtonText);

			target.attr('data-page', resData.next_page);

			pageLoader.setData({blocks: resData.list});

			pageLoader.updateContainer();

			if (resData.next_page === -1) {
				target.remove();
			}

		});

	});

});









