!function ($, undefined) {

	"use strict";

	// variables
	var $doc = $(document);

	// init
	// this can be called after ajax reloads to init the interface again
	function init() {
		// wysiwyg
		$('.wysiwyg').summernote({
			height: 250
		});
	}

	$(function () {

		// confirmation class
		$doc.on('click', '.btn-danger:not(.no-prompt)', function (e) {
			return confirm('Are you sure you want to continue?');
		});

		// nav links
		$doc.on('click', 'a', function (e) {
			e.preventDefault();
			$.ajax({
				cache: false,
				type: 'get',
				url: $(this).attr('href'),
				success: function (response) {
					$('.content-container').replaceWith($(response).find('.content-container'));
					init();
				}
			});
		});

		// form submissions
		$doc.on('submit', 'form', function (e) {
			e.preventDefault();
			$.ajax({
				cache: false,
				type: $(this).attr('method'),
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function (response) {
					$('.content-container').replaceWith($(response).find('.content-container'));
					init();
				}
			});
		});

	});

}(jQuery);