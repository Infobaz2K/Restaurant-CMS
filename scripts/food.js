// header and footer

document.addEventListener('DOMContentLoaded', function() {
    fetch('addons/header.html')
        .then(response => response.text())
        .then(html => {
            document.getElementById('headerContainer').innerHTML = html;
        });

    fetch('addons/footer.html')
        .then(response => response.text())
        .then(html => {
            document.getElementById('footerContainer').innerHTML = html;
        });

});

//


//pievienot edienu

document.addEventListener('DOMContentLoaded', function() {
    var showMenuInfoButton = document.getElementById('showFoodInfo');
    showMenuInfoButton.addEventListener('click', function() {
        var menuInfoInsert = document.querySelector('.food-info-insert');
        menuInfoInsert.classList.toggle('hidden');
    });
});

// switch , to . price

document.getElementById('price').addEventListener('blur', function() {
    this.value = this.value.replace(',', '.');
});

document.querySelectorAll('.edit_price').forEach(function(input) {
    input.addEventListener('blur', function() {
        this.value = this.value.replace(',', '.');
    });
});

//


// text image upload

document.getElementById('food_image').addEventListener('change', function() {
    var fileName = this.files[0].name;
    document.getElementById('file-name').textContent = fileName;
});

document.addEventListener('change', function(e) {
    if (e.target.classList.contains('edit_food_image')) {
        const idSuffix = e.target.id.split('-')[1];
        var fileEditName = e.target.files[0].name;
        document.getElementById('edit-file-name-' + idSuffix).textContent = fileEditName;
    }
});

//


// food edit popup

function openEditFoodPopup(food_id) {
    var popup = document.getElementById("food-edit-popup-" + food_id);
    if (popup) {
        popup.style.display = "block";
        document.body.style.overflow = 'hidden';
    }
}


function closeEditFoodPopup(food_id) {
    var popup = document.getElementById("food-edit-popup-" + food_id);
    if (popup) {
        popup.style.display = "none";
        document.body.style.overflow = '';
    }
}

//

//save button onlick by id

document.addEventListener('DOMContentLoaded', function() {
    var buttons = document.querySelectorAll('.orangebtn');
    
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            var foodId = button.id.split('-').pop();
            var form = document.getElementById('foodForm-' + foodId);
            
            if (form) {
                form.querySelector('input[name="action"]').value = 'editFood';
                form.submit();
            }
        });
    });
});

//

// auto submit update image by id

document.addEventListener('DOMContentLoaded', function() {
    var fileInputs = document.querySelectorAll('.edit_food_image');
    
    fileInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            var foodId = input.id.split('-').pop();
            var form = document.getElementById('autoFoodImage-' + foodId);
            
            if (form) {
                form.submit();
            }
        });
    });
});

//

function validateFormFoodInsert() {

    var foodName = document.getElementById("food_name").value.trim();
    var description = document.getElementById("description").value.trim();
    var cooktime = document.getElementById("cooktime").value.trim();
    var foodPosition = document.getElementById("food_position").value.trim();
    var price = document.getElementById("price").value.trim();
    var image = document.getElementById("food_image").value;

    var foodNameError = document.getElementById("food_name-error");
    var descriptionError = document.getElementById("description-error");
    var cooktimeError = document.getElementById("cooktime-error");
    var foodPositionError = document.getElementById("food_position-error");
    var priceError = document.getElementById("price-error");
    var imageError = document.getElementById("food_image-error");

    foodNameError.textContent = "";
    descriptionError.textContent = "";
    cooktimeError.textContent = "";
    foodPositionError.textContent = "";
    priceError.textContent = "";
    imageError.textContent = "";

    var isValid = true;

    if (foodName === "") {
        foodNameError.textContent = "Lūdzu ievadiet produkta nosaukumu";
        isValid = false;
    }

    if (description === "") {
        descriptionError.textContent = "Lūdzu ievadiet ēdiena aprakstu";
        isValid = false;
    }

    if (cooktime === "") {
        cooktimeError.textContent = "Lūdzu ievadiet pagatavošanas laiku";
        isValid = false;
    }

    if (foodPosition === "") {
        foodPositionError.textContent = "Lūdzu ievadiet pozīciju";
        isValid = false;
    }

    if (price === "") {
        priceError.textContent = "Lūdzu ievadiet cenu";
        isValid = false;
    }

    if (image === "") {
        imageError.textContent = "Lūdzu izvēlieties attēlu";
        isValid = false;
    }

    return isValid;
}

function validateFormFoodEdit(formId) {

    var foodName = document.getElementById("edit_food_name-" + formId).value.trim();
    var description = document.getElementById("edit_description-" + formId).value.trim();
    var cooktime = document.getElementById("edit_cooktime-" + formId).value.trim();
    var foodPosition = document.getElementById("edit_food_position-" + formId).value.trim();
    var price = document.querySelector("#foodForm-" + formId + " .edit_price").value.trim();

    var foodNameError = document.getElementById("edit_food_name-error-" + formId);
    var descriptionError = document.getElementById("edit_description-error-" + formId);
    var cooktimeError = document.getElementById("edit_cooktime-error-" + formId);
    var foodPositionError = document.getElementById("edit_food_position-error-" + formId);
    var priceError = document.getElementById("edit_price-error-" + formId);

    foodNameError.textContent = "";
    descriptionError.textContent = "";
    cooktimeError.textContent = "";
    foodPositionError.textContent = "";
    priceError.textContent = "";

    var isValid = true;

    if (foodName === "") {
        foodNameError.textContent = "Lūdzu ievadiet produkta nosaukumu";
        isValid = false;
    }

    if (description === "") {
        descriptionError.textContent = "Lūdzu ievadiet ēdiena aprakstu";
        isValid = false;
    }

    if (cooktime === "") {
        cooktimeError.textContent = "Lūdzu ievadiet pagatavošanas laiku";
        isValid = false;
    }

    if (foodPosition === "") {
        foodPositionError.textContent = "Lūdzu ievadiet pozīciju";
        isValid = false;
    }

    if (price === "") {
        priceError.textContent = "Lūdzu ievadiet cenu";
        isValid = false;
    }

    var submitButton = document.getElementById("editFoodButton-" + formId);
    submitButton.disabled = !isValid;

    return isValid;
}

document.addEventListener("DOMContentLoaded", function() {

    var forms = document.querySelectorAll('form[id^="foodForm"]');

    forms.forEach(function(form) {
        form.addEventListener("submit", function(event) {
            var formId = form.id.split("-")[1];
            if (!validateFormFoodEdit(formId)) {
                event.preventDefault();
            }
        });

        var foodNameInput = form.querySelector('input[name="edit_food_name"]');
        var descriptionInput = form.querySelector('input[name="edit_description"]');
        var cooktimeInput = form.querySelector('input[name="edit_cooktime"]');
        var foodPositionInput = form.querySelector('input[name="edit_food_position"]');
        var priceInput = form.querySelector(".edit_price");

        foodNameInput.addEventListener("input", function() {
            var formId = form.id.split("-")[1];
            validateFormFoodEdit(formId);
        });

        descriptionInput.addEventListener("input", function() {
            var formId = form.id.split("-")[1];
            validateFormFoodEdit(formId);
        });

        cooktimeInput.addEventListener("input", function() {
            var formId = form.id.split("-")[1];
            validateFormFoodEdit(formId);
        });

        foodPositionInput.addEventListener("input", function() {
            var formId = form.id.split("-")[1];
            validateFormFoodEdit(formId);
        });

        priceInput.addEventListener("input", function() {
            var formId = form.id.split("-")[1];
            validateFormFoodEdit(formId);
        });
    });
});
