function toggleDropDown() {
    let dropdown = document.getElementById('user-dropdown');
    let className = 'dropdown-show';
    if (dropdown.className.indexOf(className) === -1) {
        dropdown.className += ` ${className}`;
    } else {
        dropdown.className = dropdown.className.replace(` ${className}`, '');
    }
}

function toggleLoginPopup() {
    let login = document.getElementById('login');
    let className = 'login-show';
    if (login.className.indexOf(className) === -1) {
        login.className += ` ${className}`;
    } else {
        login.className = login.className.replace(` ${className}`, '');
    }
}

function showSidebar() {
    let el = document.querySelector('.navigation-mobile');
    el.className = "navigation-mobile show";
}
