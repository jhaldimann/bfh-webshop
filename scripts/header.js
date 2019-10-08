function toggleDropDown() {
    let dropdown = document.getElementById('user-dropdown');
    let className = 'dropdown-show';
    if (dropdown.className.indexOf(className) === -1) {
        dropdown.className += ` ${className}`;
    } else {
        dropdown.className = dropdown.className.replace(` ${className}`, '');
    }
}

function showSidebar() {
    let el = document.querySelector('.navigation-mobile');
    el.className = "navigation-mobile show";
}

let logout = () => {
    let formData = new FormData;
    formData.append('logout','logout');
    fetch('/utilities/helper.php',{method: 'POST',body: formData})
      .then((resp) => resp.json())
      .then(function(data) {
          console.log(data);
      });
}
