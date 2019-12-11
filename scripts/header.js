// Toggle the dropdown with a specific name 
function toggleDropDown(name) {
    let dropdown = document.querySelector(`#${name}`);
    let className = 'dropdown-show';
    if (dropdown.className.indexOf(className) === -1) {
        dropdown.className += ` ${className}`;
    } else {
        dropdown.className = dropdown.className.replace(` ${className}`, '');
    }
}

function openDropDownWithTimeout(name) {
  let dropdown = document.querySelector(`#${name}`);
  let className = 'dropdown-show';
  if (dropdown.className.indexOf(className) === -1) {
      dropdown.className += ` ${className}`;
      setTimeout(() => closeDropDown(name), 6000);
  }
}

function closeDropDown(name) {
  let dropdown = document.querySelector(`#${name}`);
  dropdown.className = dropdown.className.replace('dropdown-show', '');
}

function showSidebar() {
    let el = document.querySelector('.navigation-mobile');
    el.className = "navigation-mobile show";
}

// Logout from the page
let logout = () => {
    let formData = new FormData;
    formData.append('logout','logout');
    // Send request to the
    fetch('./utilities/helper.php',{method: 'POST',body: formData})
      .then((resp) => resp.json())
      .then(function(data) {
          if(data.status === 200) {
              window.location.reload();
          }
      });
};

// Get products of a specific search text
let search = () => {
	// Get the search string
	let searchString = document.querySelector('.search-text').value;
	// Append form data
	let formData = new FormData;
	formData.append('search','search');
	formData.append('searchstring',searchString);
	// Send a request to the backend
	fetch('./utilities/helper.php',{method: 'POST', body: formData})
		.then((resp) => resp.json())
		.then(function(data) {
			console.log(data);
		})
};

// Change the link on input changed
function changeLink (event) {
	let input = document.querySelector('.search-text');
	let element = document.querySelector('.search-link');
	// If the user click enter change page
	if(event.key === 'Enter') {
		changePage(`?site=products&type=search&searchstring=${input.value}`);
	} else {
		element.href = `?site=products&type=search&searchstring=${input.value}`;	
	}
}

let changePage = (url) => {
	document.location.href = url;
};
