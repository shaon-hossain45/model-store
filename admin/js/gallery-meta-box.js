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

		$( '.add_model_images' ).on( 'click', 'a', function ( event ) {
			event.preventDefault();

			var $el = $( this );

			var $product_images = $( '#model_images_container' ).find('ul.model_images');
			var $image_gallery_ids = $('#model_image_gallery');
			var frame = wp.media({
				title: 'Select or Upload Model Gallery Images',
				multiple: true
			});
	
			frame.on('select', function() {
				var attachmentIds = [];
				var selection = frame.state().get('selection');
				var attachment_ids = $image_gallery_ids.val();

				selection.map(function(attachment) {
					attachment = attachment.toJSON();
				
	
				// Display the selected images
					if ( attachment.id ) {
						attachment_ids = attachment_ids
							? attachment_ids + ',' + attachment.id
							: attachment.id;
						var attachment_image =
							attachment.sizes && attachment.sizes.thumbnail
								? attachment.sizes.thumbnail.url
								: attachment.url;
						
						$product_images.append('<li class="image" data-attachment_id="'+ attachment.id +'"><img src="'+ attachment_image +'"><ul class="actions"><li><a href="#" class="delete" data-title="'+ $el.data("delete") +'">'+ $el.data("text") +'</a></li></ul></li>');
					}
				});
				// Update the hidden input with the selected image IDs
				$('#model_image_gallery').val( attachment_ids );
			});

			// Remove the "Remove" action from the selected images
			// frame.on('update', function() {
			// 	var selection = frame.state().get('selection');
			// 	selection.map(function(attachment) {
			// 		attachment.off('remove');
			// 	});
			// });
	
			frame.open();
		});
		// Remove images.
		$( '#model_images_container' ).on( 'click', 'a.delete', function () {
			$( this ).closest( 'li.image' ).remove();

			var $image_gallery_ids = $('#model_image_gallery');

			var attachment_ids = '';

			$( '#model_images_container' )
				.find( 'ul li.image' )
				.css( 'cursor', 'default' )
				.each( function () {
					var attachment_id = $( this ).attr( 'data-attachment_id' );
					attachment_ids = attachment_ids + attachment_id + ',';
				} );

			$image_gallery_ids.val( attachment_ids );

			return false;
		} );


	var $product_images = $( '#model_images_container' ).find('ul.model_images');
		// Image ordering.
		$product_images.sortable( {
			items: 'li.image',
			cursor: 'move',
			scrollSensitivity: 40,
			forcePlaceholderSize: true,
			forceHelperSize: false,
			helper: 'clone',
			opacity: 0.65,
			placeholder: 'wc-metabox-sortable-placeholder',
			start: function ( event, ui ) {
				ui.item.css( 'background-color', '#f6f6f6' );
			},
			stop: function ( event, ui ) {
				ui.item.removeAttr( 'style' );
			},
			update: function () {
				var attachment_ids = '';

				$( '#model_images_container' )
					.find( 'ul li.image' )
					.css( 'cursor', 'default' )
					.each( function () {
						var attachment_id = $( this ).attr( 'data-attachment_id' );
						attachment_ids = attachment_ids + attachment_id + ',';
					} );

				$image_gallery_ids.val( attachment_ids );
			},
		} );
	});

})( jQuery );
