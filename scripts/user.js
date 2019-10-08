let loadUserInfo = () => {
  let rootElement = document.querySelector('.user-info');
  let formData = new FormData;
  formData.append('getUser','getUser');
  fetch('/utilities/helper.php',{method: 'POST', body: formData})
    .then((resp) => resp.json())
    .then(function(user) {
        rootElement.innerHTML =
          `<h1>Logged in as: ${user[0]['prename'] + " " + user[0]["name"]}</h1>`+
          `<p>Email: ${user[0]['email']}</p>`
    });
};
