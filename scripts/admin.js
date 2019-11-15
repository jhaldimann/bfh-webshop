let checkAdminLogin = () => {
	let username = document.querySelector('.username');
	let password = document.querySelector('.password');
	let formData = new FormData();
	formData.append('login','login');
	formData.append('email', username.value);
	formData.append('password', password.value);

	fetch('/utilities/admin.php',{method: 'POST', body: formData})
		.then((resp) => resp.json())
		.then(function(data) {
			console.log(data);
		});
};
