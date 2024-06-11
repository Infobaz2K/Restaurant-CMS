function validateFormLogin() {
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
    } else if (password.length < 8) {
        passwordError.innerHTML = "Parolei jābūt vismaz 8 rakstzīmēm garai";
        isValid = false;
    }

    return isValid;
}
