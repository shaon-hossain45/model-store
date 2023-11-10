jQuery(document).ready(function ($) {
  var clickNumber = 1;
  var loading = false;
  var $loadMoreButton = $("#loadmoreButton");
  var $postContainer = $("#post-container");

  $loadMoreButton.on("click", function (event) {
    event.preventDefault(); // Prevent the default anchor link behavior

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

  function getCurrentPageNumber(currentUrl) {
    // Example: Assuming the page number is at the end of the URL
    //var currentPage = currentUrl.split('/');
    // Get the last two segments
    //var lastSegment = currentPage[currentPage.length - 1];

    var matchElement = currentUrl.match(/\/page\/(\d+)\//);
    return matchElement ? parseInt(matchElement[1]) : 1;
  }

  // Helper function to get the URL of the next page
  function getNextPageUrl(currentUrl) {
    // Example: Assuming the page number is at the end of the URL
    //var currentPage = currentUrl.split('/');
    // Get the last two segments
    //var lastSegment = currentPage[currentPage.length - 1];

    var matchElement = currentUrl.match(/\/page\/(\d+)\//);
    var currentPage = matchElement ? parseInt(matchElement[1]) : 1;
    var nextPage = currentPage + 1;

    return currentUrl.replace(/\/page\/\d+\//, "/page/" + nextPage + "/");
  }
});
