function fieldVisibility(event){
    // Onclick checkbox button
    const checkbox = event.target;

    // Function arguments loop
    for (var i = 1; i < arguments.length; i++) {

        const elements = document.querySelectorAll('[data-hidden="'+arguments[i]+'"]');
        // console.log(elements);
        elements.forEach(field => {
            //console.log(field);
            if (checkbox && field) {
                // Checkbox type
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
                    //field.querySelector('input').setAttribute('disabled', 'disabled');
                    field.style.display = 'none'; // Show the field
                } else {
                    //field.querySelector('input').removeAttribute('disabled');
                    field.style.display = 'table-row'; // Hide the field
                }
            }
        });
    }
}

// Call the function when the page loads
document.addEventListener('DOMContentLoaded', function () {

        const inputFields = document.querySelectorAll('input[data-onload]');
        //console.log(inputFields);
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
                                //field.querySelector('input').setAttribute('disabled', 'disabled');
                                field.style.display = 'none'; // Show the field
                            } else {
                                //field.querySelector('input').removeAttribute('disabled');
                                field.style.display = 'table-row'; // Hide the field
                            }
                        }
                    });
                }
            }
        });
});


function fieldVisibilitySelect(event) {
     // Onclick select button
     const selectbox = event.target;

     // Function arguments loop
     for (var i = 1; i < arguments.length; i++) {
        //console.log(arguments[i]);
        const selectedValue = selectbox.value;

        const trElements = document.querySelectorAll('[data-select="'+arguments[i]+'"]');
        //console.log(trElements);
        trElements.forEach(element => {
            if(selectedValue && element){
                if (element.dataset.value === (selectedValue)) {
                    //field.querySelector('input').removeAttribute('disabled');
                    element.style.display = 'table-row';
                } else {
                    //field.querySelector('input').setAttribute('disabled', 'disabled');
                    element.style.display = 'none';
                }
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {

    const selectFields = document.querySelectorAll('select[data-onload]');
    //console.log(selectFields);

    selectFields.forEach(function (input) {
        // Onclick select button
        const selectbox = input;
        const selectedValue = input.value;

        const onloadParams = input.dataset.onload;

        if (onloadParams) {
            const paramsArray = onloadParams.split(',');

            for (var i = 0; i < paramsArray.length; i++) {
                const elements = document.querySelectorAll('[data-select="'+paramsArray[i]+'"]');
                //console.log(elements);
                elements.forEach(element => {
                    //console.log(field);
                    if (selectedValue && element) {
                        if (element.dataset.value === (selectedValue)) {
                            //field.querySelector('input').removeAttribute('disabled');
                            element.style.display = 'table-row';
                        } else {
                            //field.querySelector('input').setAttribute('disabled', 'disabled');
                            element.style.display = 'none';
                        }
                    }
                });
            }
        }
    });
    
});