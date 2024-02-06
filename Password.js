function togglePassword() {
    var passwordField = document.getElementById("password");
    var showPasswordIcon = document.getElementById("show-password");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        showPasswordIcon.classList.remove("fa-eye");
        showPasswordIcon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        showPasswordIcon.classList.remove("fa-eye-slash");
        showPasswordIcon.classList.add("fa-eye");
    }
}


function toggle1Password() {
    var passwordField = document.getElementById("konfirmasi_password");
    var showPasswordIcon = document.getElementById("show-password1");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        showPasswordIcon.classList.remove("fa-eye");
        showPasswordIcon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        showPasswordIcon.classList.remove("fa-eye-slash");
        showPasswordIcon.classList.add("fa-eye");
    }
}