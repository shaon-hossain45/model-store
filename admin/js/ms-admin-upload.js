(function( $ ) {
	'use strict';

	jQuery(document).ready(function($) {
		$( '.add_model_files' ).on( 'click', 'a', function ( event ) {
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
            var uploadList = $('#ms_file_upload_list');
            $.each(attachmentUrls, function(index, url) {
                uploadList.append('<li><input type="text" name="ms_file_upload_field[]" value="' + url + '" readonly /><button class="remove-file-button" data-index="' + index + '">Remove</button></li>');
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
