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


//pievienot kategoriju

document.addEventListener('DOMContentLoaded', function() {
    var showMenuInfoButton = document.getElementById('showCategoryInfo');
    showMenuInfoButton.addEventListener('click', function() {
        var menuInfoInsert = document.querySelector('.category-info-insert');
        menuInfoInsert.classList.toggle('hidden');
    });
});

//


// category edit popup

function openEditCatPopup(cat_id) {
    var popup = document.getElementById("category-edit-popup-" + cat_id);
    if (popup) {
        popup.style.display = "block";
        document.body.style.overflow = 'hidden';
    }
}


function closeEditCatPopup(cat_id) {
    var popup = document.getElementById("category-edit-popup-" + cat_id);
    if (popup) {
        popup.style.display = "none";
        document.body.style.overflow = '';
    }
}

//


//text image upload

document.getElementById('cat_image').addEventListener('change', function() {
    var fileName = this.files[0].name;
    document.getElementById('file-name').textContent = fileName;
});

document.addEventListener('change', function(e) {
    if (e.target.classList.contains('edit_cat_image')) {
        const idSuffix = e.target.id.split('-')[1];
        var fileEditName = e.target.files[0].name;
        document.getElementById('edit-file-name-' + idSuffix).textContent = fileEditName;
    }
});

//

// save button onlick by id

document.addEventListener('DOMContentLoaded', function() {
    var buttons = document.querySelectorAll('.orangebtn');
    
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {

            var catId = button.id.split('-').pop();
            var form = document.getElementById('categoryForm-' + catId);
            
            if (form) {
                form.querySelector('input[name="action"]').value = 'editCategory';
                form.submit();
            }
        });
    });
});

//

// auto submit update image by id

document.addEventListener('DOMContentLoaded', function() {
    var fileInputs = document.querySelectorAll('.edit_cat_image');
    
    fileInputs.forEach(function(input) {
        input.addEventListener('change', function() {

            var catId = input.id.split('-').pop();
            var form = document.getElementById('autoCategoryImage-' + catId);
            if (form) {
                form.submit();
            }
        });
    });
});

//

