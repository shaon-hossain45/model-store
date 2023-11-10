jQuery(document).ready(function ($) {
  var clickNumber = 1;
  var loading = false;
  var $collectButton = $(".print-extra .collect");
  var $modalContainer = $(".modal");

  $collectButton.on("click", function (event) {
    event.preventDefault(); // Prevent the default anchor link behavior
    //alert("Hi");

    $modalContainer.addClass("d-block");
    $(".CollectThingWindow").removeClass("d-block");
    $(this)
      .closest(".splide_abc")
      .find(".CollectThingWindow")
      .addClass("d-block");

    var currentPageUrl = $(this).attr("href");

    var currentPage = getCurrentPageNumber(currentPageUrl);

    // Increment the page number for the next page
    var nextPageUrl = currentPageUrl.replace(
      /\/page\/\d+\//,
      "/page/" + (currentPage + 1) + "/"
    );

    if (!loading) {
      loading = true;
      clickNumber++;
      $.ajax({
        type: "GET",
        url: ajax_object.ajax_url, // Defined in your localized script
        data: {
          action: ajax_object.action,
          values: currentPage,
          click: clickNumber,
          security: ajax_object.security,
        },
        beforeSend: function (xhr) {
          // Set an initial width
          //loader.removeClass("d-none");
        },
        success: function (response, status, xhr) {
          // Handle the AJAX response here
          //console.log(response);
          if (response["data"]["exists"]["updated"] == "success") {
            // Display the modal
            //$(".model-modal").css("display", "block");
            $(".shopmodel").append(response["data"]["output"]);
            $loadMoreButton.attr("href", getNextPageUrl(currentPageUrl));

            loading = false;

            if (response["data"]["lastpage"] == currentPage) {
              $loadMoreButton.hide();
            }

            $displayed_count = $(".shopmodel").find(".splide_abc").length;
            if ($displayed_count) {
              $(".razzi-posts__found .current-post").text(
                " " + $displayed_count + " "
              );
            }
          }
        },
        complete: function (xhr, textStatus) {
          // Set an initial width
          //loader.addClass("d-none");
          //closeFuncModal();
        },
        error: function (error) {
          // Handle any errors
          console.error("Error:", error);
        },
      });
    }
  });

  // Modal functionality
  function closeFuncModal() {
    const closeModal = document.querySelector(".cancel-anchor");
    const geolocModal = document.getElementById("geolocationModal");
    const prevWindow = document.querySelector(
      ".recommendation-modal__backdrop"
    );

    // Close the modal when the close button is clicked
    closeModal.addEventListener("click", function () {
      geolocModal.style.display = "none";
    });

    // Close the modal when the user clicks outside the modal
    window.addEventListener("click", function (event) {
      if (event.target === prevWindow) {
        geolocModal.style.display = "none";
      }
    });
  }
  //closeFuncModal();
});
