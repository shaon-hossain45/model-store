(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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

	// Search Close Button
	document.addEventListener('DOMContentLoaded', function() {
		const searchInput = document.getElementById('search-input');
		const clearSearchBtn = document.getElementById('close');
	 
		// Function to toggle the clear button based on search input value and focus
		function toggleClearButtonVisibility() {
			const hasValue = searchInput.value.trim() !== '';
			const isFocused = document.activeElement === searchInput;
	
			clearSearchBtn.style.display = (hasValue || isFocused) ? 'block' : 'none';
		}

		// Event listener for search input changes
		searchInput.addEventListener('input', toggleClearButtonVisibility);

		// Event listener for input focus
		searchInput.addEventListener('focus', toggleClearButtonVisibility);
	
		// Event listener for input blur (when focus is lost)
		searchInput.addEventListener('blur', toggleClearButtonVisibility);

		// Event listener for the clear button
		clearSearchBtn.addEventListener('click', function() {
			// Reset the search input value
			searchInput.value = '';

			toggleClearButtonVisibility();
	
			// Clear the search results (optional)
			//const searchResults = document.getElementById('search-results');
			//searchResults.innerHTML = '';
		});
	});
	
})( jQuery );
