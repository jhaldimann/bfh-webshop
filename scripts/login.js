let login = () => {
  let email = document.querySelector('.email');
  let password = document.querySelector('.password');
  let warningAlert = document.querySelector('.alert-warning');
  let formData = new FormData();
  formData.append('login','login');
  formData.append('email', email.value);
  formData.append('password',password.value);

  fetch('/utilities/helper.php',{method: 'POST', body: formData})
    .then((resp) => resp.json())
    .then(function(data) {
      if(!data) {
        warningAlert.style.display = 'block';
      } else {
        toggleLoginPopup();
      }
    });
};

function toggleLoginPopup() {
  let login = document.getElementById('login');
  let className = 'login-show';
  if (login.className.indexOf(className) === -1) {
    login.className += ` ${className}`;
  } else {
    login.className = login.className.replace(` ${className}`, '');
  }
}
