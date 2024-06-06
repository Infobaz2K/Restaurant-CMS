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