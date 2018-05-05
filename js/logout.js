$('document').ready(function() {

    function logout() {
        document.cookie = "SessionToken=NULL";
        setTimeout(' window.location.href = "client_login.html"; ', 4000);
    }
    logout();
});