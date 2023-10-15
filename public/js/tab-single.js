// document.addEventListener('DOMContentLoaded', function() {
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('#tabs li');
    const tabContents = document.querySelectorAll('.tab-content .tab-pane');
    const activateItem2Button = document.getElementById('activateItem2');

    // Set the first tab as active when the page loads
    updateTabDisplay(0);

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => {
            updateTabDisplay(index);
        });
    });

    // Activate Item 2 when the button is clicked
    activateItem2Button.addEventListener('click', (e) => {
        e.preventDefault();
        updateTabDisplay(1);
        scrollIntoView('tab-content-2');
    });

    function updateTabDisplay(selectedTabIndex) {
        // Hide all tab contents
        tabContents.forEach(content => {
            content.style.display = 'none';
        });

        // Remove 'active' class from all tabs
        tabs.forEach(t => {
            t.classList.remove('active');
        });

        // Show the selected tab content
        tabContents[selectedTabIndex].style.display = 'block';
        tabs[selectedTabIndex].classList.add('active');
    }
    function scrollIntoView(elementId) {
        const element = document.getElementById(elementId);
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }
});


// File open tab
function openItem(item) {
    var itemContent = item.querySelector('.download-wrapper');
  
    // Hide all item contents
    // var allItemContents = document.querySelectorAll('.download-wrapper');
    // allItemContents.forEach(function(content) {
    //   content.classList.remove('active');
    // });
  
    // Toggle the 'active' class to show/hide the item content
    itemContent.classList.toggle('active');
  }
  