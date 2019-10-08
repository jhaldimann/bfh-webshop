var login = () => {
  let email = document.querySelector('.email');
  let password = document.querySelector('.password');
  let warningAlert = document.querySelector('.alert-warning');
  let formData = new FormData();
  formData.append('login','login');
  formData.append('email', email.value);
  formData.append('password', password.value);

  fetch('/utilities/helper.php',{method: 'POST', body: formData})
    .then((resp) => resp.json())
    .then(function(data) {
      console.log(data);
      if(!data) {
        warningAlert.style.display = 'block';
      } else {
        toggleLoginPopup();
        window.location.reload();
      }
    });
};

function toggleLoginPopup() {
  let el = document.getElementById('login');
  let className = 'login-show';
  if (el.className.indexOf(className) === -1) {
    el.className += ` ${className}`;
  } else {
    el.className = el.className.replace(` ${className}`, '');
  }
}
