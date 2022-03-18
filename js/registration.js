
//change role with student and staff//
function onRoleValueChange(event) {
  var role = event.target.value;
  if (role === "student") {
    var studentFields = document.getElementById("student-fields");
    studentFields.classList.remove("form-hidden");
    var staffFields = document.getElementById("staff-fields");
    staffFields.classList.add("form-hidden");
  } else {
    var studentFields = document.getElementById("student-fields");
    studentFields.classList.add("form-hidden");
    var staffFields = document.getElementById("staff-fields");
    staffFields.classList.remove("form-hidden");
  }
}
//validator setting//
$.validator.addMethod(
  "checklower",
  function(value) {
    return /[a-z]/.test(value);
  },
  "Password should include at least one lowercase letter"
);
$.validator.addMethod(
  "checkupper",
  function(value) {
    return /[A-Z]/.test(value);
  },
  "Password should include at least one uppercase letter"
);
$.validator.addMethod(
  "checkdigit",
  function(value) {
    return /[0-9]/.test(value);
  },
  "Password should include at least one digit"
);
$.validator.addMethod(
  "checkspecialcharacters",
  function(value) {
    return /[!@#$%^]/.test(value);
  },
  "Password should include special characters !@#$%^ "
);
$.validator.addMethod(
  "validPhone",
  function(value) {
    return /[0-9]{8,10}/.test(value);
  },
  "Phone number should be 8-10 digits"
);

//validator using//
$(document).ready(function() {
  $("form").validate({
    onclick: false,
    onkeyup: false,
    rules: {
      fname: "required",
      lname: "required",
      studentid:"required",
      studentemail: {
        required: true,
        email: true
      },
      staffemail: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 6,
        maxlength: 12,
        checklower: true,
        checkupper: true,
        checkdigit: true,
        checkspecialcharacters: true
      },
      cpassword: {
        required: true,
        equalTo: "#password"
      },
      SID: "required",
      Expertise: "required",
      Qualification: "required",
      sphone: {
        required: true,
        validPhone: true
      },
      spassword: {
        required: true,
        minlength: 6,
        checklower: true,
        checkupper: true,
        checkdigit: true,
        checkspecialcharacters: true
      },
      scpassword: {
        required: true,
        equalTo: "#spassword"
      },
    }

  });
});
