let register = () => {
	// Get the input fields
	let firstname = document.querySelector('#firstname');
	let name = document.querySelector('#name');
	let email = document.querySelector('#email');
	let password = document.querySelector('#password');
	let passwordConfirm = document.querySelector('#password-confirm');
	let formData = new FormData();

	// Append data to the form data
	formData.append('register', 'register');
	formData.append('firstname', firstname.value);
	formData.append('name', name.value);
	formData.append('email', email.value);
	formData.append('password', password.value);
	formData.append('password-confirm', passwordConfirm.value);

	// Send request to the backend
	fetch('./utilities/helper.php', {method: 'POST', body: formData})
		.then(( r ) => r.json())
		.then(( data ) => {
			switch (data.status) {
				case 200:
					window.location.href = "/";
					break;
				case 400:
					console.log(data.text);
					break;
			}
		});
};
