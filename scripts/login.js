// Check the login data of the user
let login = () => {
	// Get the input fields
	let email = document.querySelector('.email');
	let password = document.querySelector('.password');
	let warningAlert = document.querySelector('.alert-warning');
	// Append the data to the form data
	let formData = new FormData();
	formData.append('login', 'login');
	formData.append('email', email.value);
	formData.append('password', password.value);
	// Send request to the backend
	fetch('./utilities/helper.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( data ) {
			if (!data) {
				warningAlert.style.display = 'block';
			} else {
				// Reload the page and toggle the popup
				toggleLoginPopup();
				window.location.reload();
			}
		});
};

// Toggle the login popup
function toggleLoginPopup() {
	let el = document.getElementById('login');
	let className = 'login-show';
	if (el.className.indexOf(className) === -1) {
		el.className += ` ${className}`;
	} else {
		el.className = el.className.replace(` ${className}`, '');
	}
}
