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
