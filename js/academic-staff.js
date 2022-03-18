
//UC Page and DC Page change//
function onRoleValueChange(event) {
  var uctab = document.getElementsByClassName("uc")
  var dctab = document.getElementsByClassName("dc")
  var createbtn = document.getElementById("create")
  var role = event.target.value;
  if (role === "dc") {
    for (var i = 0; i <= uctab.length - 1; i++) {
      uctab[i].style.cssText = "display: none;";
    }
    for (var i = 0; i <= dctab.length - 1; i++) {
      dctab[i].style.cssText = "display: block;";
    }
    create.style.cssText = "display: block; margin-bottom: 40px;";
  } else {
    for (var i = 0; i <= uctab.length - 1; i++) {
      uctab[i].style.cssText = "display: block;";
    }
    for (var i = 0; i <= dctab.length - 1; i++) {
      dctab[i].style.cssText = "display: none;";
    }
    create.style.cssText = "display: none;";
  }
}

//Modal open and close for UC to allocate time and campus//
function openModal() {
    editModal.style.cssText = "display: block;";
}

function closeModal() {
    editModal.style.cssText = "display: none;";
}