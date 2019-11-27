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

let logout = () => {
    let formData = new FormData;
    formData.append('logout','logout');
    fetch('./utilities/helper.php',{method: 'POST',body: formData})
      .then((resp) => resp.json())
      .then(function(data) {
          if(data.status === 200) {
              window.location.reload();
          }
      });
};

let changePage = (url) => {
  document.location.href = url;
};

let search = () => {
	let searchString = document.querySelector('.search-text').value;
	console.log(searchString);
	let formData = new FormData;
	formData.append('search','search');
	formData.append('searchstring',searchString);
	fetch('./utilities/helper.php',{method: 'POST', body: formData})
		.then((resp) => resp.json())
		.then(function(data) {
			console.log(data);
		})
};

function changeLink (event) {
	let input = document.querySelector('.search-text');
	let element = document.querySelector('.search-link');
	
	element.href = `?site=products&type=search&searchstring=${input.value}`;
}
