function fieldVisibility(event){
    // Onclick checkbox button
    const checkbox = event.target;

    // Function arguments loop
    for (var i = 0; i < arguments.length; i++) {

        const elements = document.querySelectorAll('[data-hidden="'+arguments[i]+'"]');
        //console.log(elements);
        elements.forEach(field => {
            //console.log(field);
            if (checkbox && field) {
                if (checkbox.checked) {
                    //field.querySelector('input').removeAttribute('disabled');
                    field.style.display = 'table-row'; // Show the field
                } else {
                    //field.querySelector('input').setAttribute('disabled', 'disabled');
                    field.style.display = 'none'; // Hide the field
                }
            }
        });

        const elementsPreview = document.querySelectorAll('[data-preview="'+arguments[i]+'"]');
        //console.log(elements);
        elementsPreview.forEach(field => {
            //console.log(field);
            if (checkbox && field) {
                if (checkbox.checked) {
                    //field.querySelector('input').removeAttribute('disabled');
                    field.style.display = 'none'; // Show the field
                } else {
                    //field.querySelector('input').setAttribute('disabled', 'disabled');
                    field.style.display = 'table-row'; // Hide the field
                }
            }
        });
    }
}

// Call the function when the page loads
document.addEventListener('DOMContentLoaded', function () {

        const inputFields = document.querySelectorAll('input[data-onload]');

        inputFields.forEach(function (input) {
            // Onclick checkbox button
            const checkbox = input;
            
            const onloadParams = input.dataset.onload;
    
            if (onloadParams) {
                const paramsArray = onloadParams.split(',');

                for (var i = 0; i < paramsArray.length; i++) {

                    const elements = document.querySelectorAll('[data-hidden="'+paramsArray[i]+'"]');
                    //console.log(elements);
                    elements.forEach(field => {
                        //console.log(field);
                        if (checkbox && field) {
                            if (checkbox.checked) {
                                //field.querySelector('input').removeAttribute('disabled');
                                field.style.display = 'table-row'; // Show the field
                            } else {
                                //field.querySelector('input').setAttribute('disabled', 'disabled');
                                field.style.display = 'none'; // Hide the field
                            }
                        }
                    });

                    const elementsPreview = document.querySelectorAll('[data-preview="'+paramsArray[i]+'"]');
                    //console.log(elements);
                    elementsPreview.forEach(field => {
                        //console.log(field);
                        if (checkbox && field) {
                            if (checkbox.checked) {
                                //field.querySelector('input').removeAttribute('disabled');
                                field.style.display = 'none'; // Show the field
                            } else {
                                //field.querySelector('input').setAttribute('disabled', 'disabled');
                                field.style.display = 'table-row'; // Hide the field
                            }
                        }
                    });
                }
            }
        });
});
