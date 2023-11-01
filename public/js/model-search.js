(function ($) {
  "use strict";

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

  $(document).ready(function () {
    /**
     * Search modal close action
     * Modal active event
     * By Javascript EventListener
     */

    const closeModal = document.querySelector(".close");
    const searchModal = $(".model-modal");

    function closeFuncModal() {
      // Close the modal when the close button is clicked
      closeModal.addEventListener("click", function () {
        searchModal.css("display", "none");
      });

      // Close the modal when the user clicks outside the modal
      window.addEventListener("click", function (event) {
        if (event.target === searchModal[0]) {
          searchModal.css("display", "none");
        }
      });
    }

    var isSearchValid = true;

    // AJAX request on page load
    $("form#searchForm").on("submit", function (event) {
      event.preventDefault();

      var thisby = $(this);

      /**
       * Search Form validation
       * @return {[type]} [description]
       */
      searchInputValid();

      function searchInputValid() {
        isSearchValid = true;

        var searchDom = thisby.find('input[name="model_search"]');
        var searchDomval = searchDom.val();

        if (searchDomval == "") {
          isSearchValid = false;
          searchDom.addClass("error");
        } else {
          searchDom.removeClass("error");
        }
      }

      var loader = $(".preloader-container");

      if (isSearchValid == true) {
        var formData = thisby.serialize();

        $.ajax({
          type: "POST",
          url: search_object.ajax_url, // Defined in your localized script
          data: {
            action: search_object.action,
            values: formData,
            security: search_object.security,
          },
          beforeSend: function (xhr) {
            // Set an initial width
            loader.removeClass("d-none");
          },
          success: function (response, status, xhr) {
            // Handle the AJAX response here
            //console.log(response);
            if (response["data"]["exists"]["updated"] == "success") {
              // Display the modal
              $(".model-modal").css("display", "block");
              $(".search-results").html(response["data"]["output"]);
            }
          },
          complete: function (xhr, textStatus) {
            // Set an initial width
            loader.addClass("d-none");
            closeFuncModal();
          },
          error: function (error) {
            // Handle any errors
            console.error("Error:", error);
          },
        });
      }
    });
  });
})(jQuery);
