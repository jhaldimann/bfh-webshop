let checkout = () => {
	// Get information about the customer
	let name = document.querySelector('#name');
	let preName = document.querySelector('#prename');
	let address = document.querySelector('#address');
	let houseNr = document.querySelector('#housenr');
	let zip = document.querySelector('#zip');
	let city = document.querySelector('#city');
	let country = document.querySelector('#country');
	let ccOwner = document.querySelector('#cc-owner');
	let ccNumber = document.querySelector('#cc-number');
	let ccDate = document.querySelector('#cc-date');
	let ccCcv = document.querySelector('#cc-ccv');

	// Fill the form data
	let formData = new FormData;
	formData.append('checkout','checkout');
	formData.append('name', name.value);
	formData.append('prename', preName.value);
	formData.append('address', address.value);
	formData.append('housenr', houseNr.value);
	formData.append('zip', zip.value);
	formData.append('city', city.value);
	formData.append('country', country.value);
	formData.append('ccowner', ccOwner.value);
	formData.append('ccnumber', ccNumber.value);
	formData.append('ccdate', ccDate.value);
	formData.append('ccccv', ccCcv.value);

	fetch('/utilities/helper.php', {method: 'POST', body: formData})
		.then((r) => r.json())
		.then(data => {
			console.log(data);
		})
};


