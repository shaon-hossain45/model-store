(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	jQuery(document).ready(function($) {
		$('#upload_model_store_file_button').click(function(e) {
			e.preventDefault();
        var customUploader = wp.media({
            title: 'Choose Files',
            button: {
                text: 'Choose Files'
            },
            multiple: true
        });

        customUploader.on('select', function() {
            var attachments = customUploader.state().get('selection').toJSON();
            var attachmentUrls = [];
			console.log(attachmentUrls);
            $.each(attachments, function(index, attachment) {
                attachmentUrls.push(attachment.url);
            });

            // Append the URLs to the file upload list
            var uploadList = $('#model_store_file_upload_list');
            $.each(attachmentUrls, function(index, url) {
                uploadList.append('<li><input type="text" name="model_store_file_upload_field[]" value="' + url + '" readonly /><button class="remove-file-button" data-index="' + index + '">Remove</button></li>');
            });
        });

        customUploader.open();
		});
		// Remove uploaded item on button click
		$(document).on('click', '.remove-file-button', function(e) {
			e.preventDefault();
			var indexToRemove = $(this).data('index');
			$(this).closest('li').remove();
		});
	});

})( jQuery );
