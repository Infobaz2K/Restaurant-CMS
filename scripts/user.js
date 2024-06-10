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

function validateFormInfoInsert() {
    
    var businessname = document.getElementById("businessname").value;
    var regnum = document.getElementById("regnum").value;
    var address = document.getElementById("address").value;
    var bank = document.getElementById("bank").value;
    var swift = document.getElementById("swift").value;
    var bankaccnum = document.getElementById("bankaccnum").value;
    var image = document.getElementById("post_image").value;

    var businessnameError = document.getElementById("businessname-error");
    var regnumError = document.getElementById("regnum-error");
    var addressError = document.getElementById("address-error");
    var bankError = document.getElementById("bank-error");
    var swiftError = document.getElementById("swift-error");
    var bankaccnumError = document.getElementById("bankaccnum-error");
    var imageError = document.getElementById("image-error");

    businessnameError.innerHTML = "";
    regnumError.innerHTML = "";
    addressError.innerHTML = "";
    bankError.innerHTML = "";
    swiftError.innerHTML = "";
    bankaccnumError.innerHTML = "";
    imageError.innerHTML = "";

    var isValid = true;

    if (businessname.trim() === "") {
        businessnameError.innerHTML = "Lūdzu ievadiet uzņēmuma nosaukumu";
        isValid = false;
    }

    if (regnum.trim() === "") {
        regnumError.innerHTML = "Lūdzu ievadiet reģistrācijas numuru";
        isValid = false;
    }

    if (address.trim() === "") {
        addressError.innerHTML = "Lūdzu ievadiet juridisko adresi";
        isValid = false;
    }

    if (bank.trim() === "") {
        bankError.innerHTML = "Lūdzu ievadiet bankas nosaukumu";
        isValid = false;
    }

    if (swift.trim() === "") {
        swiftError.innerHTML = "Lūdzu ievadiet SWIFT kodu";
        isValid = false;
    }

    if (bankaccnum.trim() === "") {
        bankaccnumError.innerHTML = "Lūdzu ievadiet konta numuru";
        isValid = false;
    }

    if (image === "") {
        imageError.innerHTML = "Lūdzu izvēlieties uzņēmuma logotipu";
        isValid = false;
    }

    return isValid;
}

function validateFormInfoEdit() {

    var businessname = document.getElementById("businessname").value;
    var regnum = document.getElementById("regnum").value;
    var address = document.getElementById("address").value;
    var bank = document.getElementById("bank").value;
    var swift = document.getElementById("swift").value;
    var bankaccnum = document.getElementById("bankaccnum").value;

    var businessnameError = document.getElementById("businessname-error");
    var regnumError = document.getElementById("regnum-error");
    var addressError = document.getElementById("address-error");
    var bankError = document.getElementById("bank-error");
    var swiftError = document.getElementById("swift-error");
    var bankaccnumError = document.getElementById("bankaccnum-error");

    businessnameError.innerHTML = "";
    regnumError.innerHTML = "";
    addressError.innerHTML = "";
    bankError.innerHTML = "";
    swiftError.innerHTML = "";
    bankaccnumError.innerHTML = "";

    var isValid = true;

    if (businessname.trim() === "") {
        businessnameError.innerHTML = "Lūdzu ievadiet uzņēmuma nosaukumu";
        isValid = false;
    }

    if (regnum.trim() === "") {
        regnumError.innerHTML = "Lūdzu ievadiet reģistrācijas numuru";
        isValid = false;
    }

    if (address.trim() === "") {
        addressError.innerHTML = "Lūdzu ievadiet juridisko adresi";
        isValid = false;
    }

    if (bank.trim() === "") {
        bankError.innerHTML = "Lūdzu ievadiet bankas nosaukumu";
        isValid = false;
    }

    if (swift.trim() === "") {
        swiftError.innerHTML = "Lūdzu ievadiet SWIFT kodu";
        isValid = false;
    }

    if (bankaccnum.trim() === "") {
        bankaccnumError.innerHTML = "Lūdzu ievadiet konta numuru";
        isValid = false;
    }

    return isValid;
}

document.getElementById("businessname").addEventListener("input", validateFormInfoEdit);
document.getElementById("regnum").addEventListener("input", validateFormInfoEdit);
document.getElementById("address").addEventListener("input", validateFormInfoEdit);
document.getElementById("bank").addEventListener("input", validateFormInfoEdit);
document.getElementById("swift").addEventListener("input", validateFormInfoEdit);
document.getElementById("bankaccnum").addEventListener("input", validateFormInfoEdit);
