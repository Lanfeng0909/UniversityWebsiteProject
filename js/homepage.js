let navLogin = document.getElementById("login");
let navLogout = document.getElementById("logout");
let username = window.localStorage.getItem('username');
/*
//user login//
if (username == null){
	navLogin.style.cssText = "display: block;";
	navLogout.style.cssText = "display: none;";
} else {
	navLogout.style.cssText = "display: block;";
	navLogin.style.cssText = "display: none;";
}

//user logout//
navLogout.addEventListener('click', onClick => {
	window.localStorage.removeItem('username');
})
*/