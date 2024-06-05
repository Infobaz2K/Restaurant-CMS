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