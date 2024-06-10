function validateFormRegister() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var usernameError = document.getElementById("username-error");
    var passwordError = document.getElementById("password-error");

    usernameError.innerHTML = "";
    passwordError.innerHTML = "";

    var isValid = true;

    if (username.trim() === "") {
        usernameError.innerHTML = "Lūdzu, ievadiet lietotājvārdu";
        isValid = false;
    }

    if (password.trim() === "") {
        passwordError.innerHTML = "Lūdzu, ievadiet paroli";
        isValid = false;
    }

    return isValid;
}