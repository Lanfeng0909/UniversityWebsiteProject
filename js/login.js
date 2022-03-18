let loginBtn = document.getElementById("loginbtn");
// let username = window.localStorage.getItem('username');
// console.log(username)
// only user login, they can access to other page
loginbtn.addEventListener('click', onClick => {
  let pwd = document.getElementById("pwd");
  let usr = document.getElementById("usr");
  if ((!pwd.value) || (!usr.value)) {
      alert('Please fill both the username and password!');
  } /////else {
    //let radioStudent = document.getElementById("radioStudent");
    //let radioStaff = document.getElementById("radioStaff");
    //if (radioStudent.checked == true) {
      //window.location.href = './unit-details.html';
    //} else if (radioStaff.checked == true) {
      //window.location.href = './academic-staff.html';
    //}
    //window.localStorage.setItem('username', usr.value)
  //}
})


