let getUrlParam = ( identifier ) => {
	let url = window.location.href;
	return new URL(url).searchParams.get(identifier);
};
let changeLanguage = (lang) => {
	let url = new URL(window.location);
	let oldLang = getUrlParam('lang');
	if(oldLang === null) {
		url.searchParams.append('lang',lang);
		window.location = url.href;
	} else if(oldLang !== lang) {
		url.searchParams.set('lang',lang);
		window.location = url.href;
	}
};
