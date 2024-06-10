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

//pievienot edienkarti

document.addEventListener('DOMContentLoaded', function() {
    var showMenuInfoButton = document.getElementById('showMenuInfo');
    showMenuInfoButton.addEventListener('click', function() {
        var menuInfoInsert = document.querySelector('.menu-info-insert');
        menuInfoInsert.classList.toggle('hidden');
    });
});

//


//menu edit popup:

function openEditMenuPopup(menu_id) {
    var popup = document.getElementById("menu-edit-popup-" + menu_id);
    if (popup) {
        popup.style.display = "block";
        document.body.style.overflow = 'hidden';
    }
}

function closeEditMenuPopup(menu_id) {
    var popup = document.getElementById("menu-edit-popup-" + menu_id);
    if (popup) {
        popup.style.display = "none";
        document.body.style.overflow = '';
    }
}

// 


function validateFormMenuInsert() {

    var menu_name = document.getElementById("menu_name").value;

    var menu_name_error = document.getElementById("menu_name-error");


    menu_name_error.innerHTML = "";


    var isValid = true;

    if (menu_name.trim() === "") {
        menu_name_error.innerHTML = "Lūdzu ievadiet ēdienkartes nosaukumu";
        isValid = false;
    }

    return isValid;
}

function validateFormMenuEdit() {

    var edit_menu_name = document.getElementById("edit_menu_name").value;

    var edit_menu_name_error = document.getElementById("edit_menu_name-error");

    edit_menu_name_error.innerHTML = "";

    var isValid = true;

    if (edit_menu_name.trim() === "") {
        edit_menu_name_error.innerHTML = "Lūdzu ievadiet uzņēmuma nosaukumu";
        isValid = false;
    }

    return isValid;
}

document.getElementById("edit_menu_name").addEventListener("input", validateFormMenuEdit);