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


//text image uploads span

document.getElementById('post_image').addEventListener('change', function() {
    var fileName = this.files[0].name;
    document.getElementById('file-name').textContent = fileName;
});

//

//save button onlick

document.getElementById('saveButton').addEventListener('click', function() {
    var form = document.querySelector('.post-info form');
    
    form.querySelector('input[name="action"]').value = 'editInfo';
    form.submit();
});

//

// auto submit update image

document.getElementById('post_image').addEventListener('change', function() {
    document.getElementById('autoPostImage').submit();
});

//



