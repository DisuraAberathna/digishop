var loader = document.querySelector(".loader");
window.addEventListener("load", vanish);

function vanish() {
  loader.classList.add("hidden");
}

function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}

function showPassword_1() {
  var i = document.getElementById("password");
  var eye = document.getElementById("e-1");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "bi bi-eye-fill";
  } else {
    i.type = "password";
    eye.className = "bi bi-eye-slash-fill";
  }
}

function showPassword_2() {
  var i = document.getElementById("confirmPassword");
  var eye = document.getElementById("e-2");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "bi bi-eye-fill";
  } else {
    i.type = "password";
    eye.className = "bi bi-eye-slash-fill";
  }
}

function signUp() {
  var f = document.getElementById("fname");
  var l = document.getElementById("lname");
  var e = document.getElementById("email");
  var p1 = document.getElementById("password");
  var p2 = document.getElementById("confirmPassword");
  var m = document.getElementById("mobile");
  var g = document.getElementById("gender");

  var form = new FormData();
  form.append("f", f.value);
  form.append("l", l.value);
  form.append("e", e.value);
  form.append("p", p1.value);
  form.append("cp", p2.value);
  form.append("m", m.value);
  form.append("g", g.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "  Success.") {
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
        window.location.reload();
      } else {
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "./process/signUpProcess.php", true);
  request.send(form);
}

function signIn() {
  var e = document.getElementById("e");
  var p = document.getElementById("p");
  var c = document.getElementById("checkBox");

  var form = new FormData();
  form.append("e", e.value);
  form.append("p", p.value);
  form.append("c", c.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "  Success.") {
        window.location = "home.php";
      } else {
        document.getElementById("msg2").innerHTML = text;
        document.getElementById("msgdiv2").className = "d-block";
      }
    }
  };

  request.open("POST", "./process/signInProcess.php", true);
  request.send(form);
}

var fpm;
var e = document.getElementById("e");

function forgotPassword() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "  Success.") {
        var alertModal = document.getElementById("alertModal");
        fpm = new bootstrap.Modal(alertModal);
        fpm.show();
        document.getElementById("msg3").className = "bi bi-check2-circle";
        document.getElementById("alertdiv3").classList = "alert alert-success";
        document.getElementById("msg3").innerHTML =
          "  Verification code has sent to your email. Please check your inbox.";
      } else {
        var alertModal = document.getElementById("alertModal");
        fpm = new bootstrap.Modal(alertModal);
        fpm.show();
        document.getElementById("msg3").innerHTML = text;
      }
    }
  };

  request.open("GET", "./process/forgotPasswordProcess.php?e=" + e.value, true);
  request.send();
}

function goToReset() {
  if (
    document.getElementById("msg3").innerHTML ==
    "  Verification code has sent to your email. Please check your inbox."
  ) {
    window.location = "resetPassword.php?e=" + e.value;
  } else if (
    document.getElementById("msg3").innerHTML ==
    "  Password has been successfully reset."
  ) {
    window.location = "index.php";
  } else if (
    document.getElementById("msg3").innerHTML ==
      "  Verification code sending failed !!!" ||
    document.getElementById("msg3").innerHTML == "  Invalid Email Address !!!"
  ) {
    fpm.hide();
  }
}

function showPassword_3() {
  var i = document.getElementById("newPassword");
  var eye = document.getElementById("e-3");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "bi bi-eye-fill";
  } else {
    i.type = "password";
    eye.className = "bi bi-eye-slash-fill";
  }
}

function showPassword_4() {
  var i = document.getElementById("retypePassword");
  var eye = document.getElementById("e-4");

  if (i.type == "password") {
    i.type = "text";
    eye.className = "bi bi-eye-fill";
  } else {
    i.type = "password";
    eye.className = "bi bi-eye-slash-fill";
  }
}

var rm;

function resetPassword() {
  var email = document.getElementById("e");
  var nPassword = document.getElementById("newPassword");
  var rPassword = document.getElementById("retypePassword");
  var vCode = document.getElementById("vCode");

  var form = new FormData();
  form.append("e", email.value);
  form.append("n", nPassword.value);
  form.append("r", rPassword.value);
  form.append("v", vCode.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "  Success.") {
        var resetModal = document.getElementById("alertModal");
        rm = new bootstrap.Modal(resetModal);
        rm.show();
        document.getElementById("msg3").innerHTML =
          "  Password has been successfully reset.";
        document.getElementById("msg3").className = "bi bi-check2-circle";
        document.getElementById("alertdiv3").classList = "alert alert-success";
      } else {
        var resetModal = document.getElementById("alertModal");
        rm = new bootstrap.Modal(resetModal);
        rm.show();
        document.getElementById("msg3").innerHTML = text;
      }
    }
  };

  request.open("POST", "./process/resetPasswordProcess.php", true);
  request.send(form);
}

function signout() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "Success") {
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "./process/signOutProcess.php", true);
  request.send();
}

var mybutton = document.getElementById("top-Btn");

window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
  document.documentElement.scrollTop = 0;
}

function load_district() {
  var province = document.getElementById("province").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      document.getElementById("district").innerHTML = text;
    }
  };

  request.open("GET", "./process/loadDistrict.php?p=" + province, true);
  request.send();
}

function load_city() {
  var district = document.getElementById("district").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      document.getElementById("city").innerHTML = text;
    }
  };

  request.open("GET", "./process/loadCity.php?d=" + district, true);
  request.send();
}

var um;

function saveUserDetails() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");

  var type;

  if (document.getElementById("type-1").checked) {
    type = "1";
  } else if (document.getElementById("type-2").checked) {
    type = "2";
  } else {
    type = "0";
  }

  var form = new FormData();
  form.append("fn", fname.value);
  form.append("ln", lname.value);
  form.append("m", mobile.value);
  form.append("t", type);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "  Success.") {
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML = "  User Details Updated";
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
      } else {
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "./process/saveUserDetailsProcess.php", true);
  request.send(form);
}

var oim;

function openImgModal() {
  var openImgModal = document.getElementById("editImgModal");
  oim = new bootstrap.Modal(openImgModal);
  oim.show();
}

function changeProfileImage() {
  var view = document.getElementById("viewImg");
  var file = document.getElementById("profileImg");

  file.onchange = function () {
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);
    view.src = url;

    document.getElementById("saveImg").classList.remove("disabled");
  };
}

function deleteProfileImage(email) {
  var form = new FormData();
  form.append("e", email);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "success") {
        oim.hide();
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML =
          "  Profile Image Delete Successfuly.";
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
      } else {
        oim.hide();
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "./process/deleteProfileImageProcess.php", true);
  request.send(form);
}

function saveImage() {
  var image = document.getElementById("profileImg");

  var form = new FormData();

  if (image.files.length == 0) {
    var confirmation = confirm(
      "Are you sure You don't want to Update Profile Image?"
    );

    if (confirmation) {
      alert("You have not selected any Image");
    }
  } else {
    form.append("image", image.files[0]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "  Success.") {
        oim.hide();
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML =
          "  Profile Image Updated Successfuly.";
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
      } else {
        oim.hide();
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "./process/saveProfileImageProcess.php", true);
  request.send(form);
}

function saveUserAddress() {
  var line1 = document.getElementById("line-1");
  var line2 = document.getElementById("line-2");
  var line3 = document.getElementById("line-3");
  var province = document.getElementById("province");
  var district = document.getElementById("district");
  var city = document.getElementById("city");
  var pcode = document.getElementById("pCode");

  var form = new FormData();
  form.append("l1", line1.value);
  form.append("l2", line2.value);
  form.append("l3", line3.value);
  form.append("p", province.value);
  form.append("d", district.value);
  form.append("c", city.value);
  form.append("pc", pcode.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "  Success.") {
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML =
          "  User's Address Details Updated";
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
      } else {
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "./process/saveUserAddressProcess.php", true);
  request.send(form);
}

function understood() {
  var msg = document.getElementById("msg");

  if (
    msg.innerHTML == "  Success." ||
    msg.innerHTML == "  Profile Image Updated Successfuly." ||
    msg.innerHTML == "  User Details Updated" ||
    msg.innerHTML == "  Profile Image Delete Successfuly." ||
    msg.innerHTML == "  Smoething Went Wrong !!!" ||
    msg.innerHTML == "  User's Address Details Updated"
  ) {
    window.location.reload();
  } else if (
    msg.innerHTML == "  Enter First Name !!!" ||
    msg.innerHTML == "  First Name must have less than 50 characters."
  ) {
    um.hide();
    document.getElementById("fname").className =
      "form-control rounded-5 border-danger";
  } else if (
    msg.innerHTML == "  Enter Last Name !!!" ||
    msg.innerHTML == "  Last Name must have less than 50 characters."
  ) {
    um.hide();
    document.getElementById("lname").className =
      "form-control rounded-5 border-danger";
  } else if (
    msg.innerHTML == "  Enter Mobile !!!" ||
    msg.innerHTML == "  Mobile must have 10 characters." ||
    msg.innerHTML == "  Invalid Mobile."
  ) {
    um.hide();
    document.getElementById("mobile").className =
      "form-control rounded-5 border-danger";
  } else if (msg.innerHTML == "  Select a User Type !!!") {
    um.hide();
    document.getElementById("l").className = "text-danger";
  } else if (msg.innerHTML == "  Enter Address Line 1 !!!") {
    um.hide();
    document.getElementById("line-1").className =
      "form-control rounded-5 border-danger";
  } else if (msg.innerHTML == "  Enter Address Line 2 !!!") {
    um.hide();
    document.getElementById("line-2").className =
      "form-control rounded-5 border-danger";
  } else if (msg.innerHTML == "  Enter Address Line 3 !!!") {
    um.hide();
    document.getElementById("line-3").className =
      "form-control rounded-5 border-danger";
  } else if (msg.innerHTML == "  Must select a Province !!!") {
    um.hide();
    document.getElementById("province").className =
      "form-select rounded-5 border-danger";
  } else if (msg.innerHTML == "  Must select a District !!!") {
    um.hide();
    document.getElementById("district").className =
      "form-select rounded-5 border-danger";
  } else if (msg.innerHTML == "  Must select a City !!!") {
    um.hide();
    document.getElementById("city").className =
      "form-select rounded-5 border-danger";
  } else if (msg.innerHTML == "  Must select a Category !!!") {
    apm.hide();
    document.getElementById("ca_title").className =
      "form-label fw-bold text-danger";
  } else if (msg.innerHTML == "  Must select a Brand !!!") {
    apm.hide();
    document.getElementById("b_title").className =
      "form-label fw-bold text-danger";
  } else if (msg.innerHTML == "  Must select a Model !!!") {
    apm.hide();
    document.getElementById("m_title").className =
      "form-label fw-bold text-danger";
  } else if (
    msg.innerHTML == "  Enter a Title !!!" ||
    msg.innerHTML == "  Title should have lower than 100 characters"
  ) {
    apm.hide();
    document.getElementById("t_title").className =
      "form-label fw-bold text-danger";
  } else if (msg.innerHTML == "  Please select Colour or Input Colour !!!") {
    apm.hide();
    document.getElementById("clr_title").className =
      "form-label fw-bold text-danger";
  } else if (
    msg.innerHTML == "  Please Enter the Quantity !!!" ||
    msg.innerHTML == "  Invalid input for Quantity !!!"
  ) {
    apm.hide();
    document.getElementById("q_title").className =
      "form-label fw-bold text-danger";
  } else if (
    msg.innerHTML == "  Please Enter the Price !!!" ||
    msg.innerHTML == "  Invalid input for Cost !!!"
  ) {
    apm.hide();
    document.getElementById("c_title").className =
      "form-label fw-bold text-danger";
  } else if (
    msg.innerHTML == "  Please Enter the delivery fee for Colombo !!!" ||
    msg.innerHTML == "  Invalid input for delivery cost inside Colombo !!!"
  ) {
    apm.hide();
    document.getElementById("dwc_title").className =
      "form-label fw-bold text-danger";
  } else if (
    msg.innerHTML == "  Please Enter the delivery fee for out of Colombo !!!" ||
    msg.innerHTML == "  Invalid input for delivery cost out of Colombo !!!"
  ) {
    apm.hide();
    document.getElementById("doc_title").className =
      "form-label fw-bold text-danger";
  } else if (
    msg.innerHTML == "  Please Enter a Description !!!" ||
    msg.innerHTML == "  Description is too short !!!"
  ) {
    apm.hide();
    document.getElementById("desc_title").className =
      "form-label fw-bold text-danger";
  } else if (msg.innerHTML == "  Invalid Image type !!!") {
    apm.hide();
    document.getElementById("i_title").className =
      "form-label fw-bold text-danger";
  } else if (
    msg.innerHTML == "  Product Saved Successfully." ||
    msg.innerHTML == "  Product Updated Successfully."
  ) {
    window.location = "sellerProducts.php";
  } else if (
    msg.innerHTML == "  Invalid image count !!!" ||
    msg.innerHTML == "  File type not allowed !!!"
  ) {
    upm.hide();
    document.getElementById("im_title").className =
      "form-label fw-bold text-danger";
  }
}

function load_brand() {
  var category = document.getElementById("category").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      document.getElementById("brand").innerHTML = text;
    }
  };

  request.open("GET", "./process/loadBrand.php?c=" + category, true);
  request.send();
}

function load_model() {
  var brand = document.getElementById("brand").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      document.getElementById("model").innerHTML = text;
    }
  };

  request.open("GET", "./process/loadModel.php?b=" + brand, true);
  request.send();
}

function changeProductImage() {
  var image = document.getElementById("imageUploader");

  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 3) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("i" + x).src = url;
      }
    } else {
      alert("Please Select 3 or less than 3 Images.");
    }
  };
}

var apm;

function addProduct() {
  var category = document.getElementById("category");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");
  var title = document.getElementById("title");

  var condition = 0;

  if (document.getElementById("b").checked) {
    condition = 1;
  } else if (document.getElementById("u").checked) {
    condition = 2;
  }

  var colour = document.getElementById("colour");
  var colour_input = document.getElementById("colour_input");
  var qty = document.getElementById("qty");
  var cost = document.getElementById("cost");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var desc = document.getElementById("desc");
  var image = document.getElementById("imageUploader");

  var form = new FormData();
  form.append("ca", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("t", title.value);
  form.append("con", condition);
  form.append("col", colour.value);
  form.append("col_in", colour_input.value);
  form.append("qty", qty.value);
  form.append("cost", cost.value);
  form.append("dwc", dwc.value);
  form.append("doc", doc.value);
  form.append("desc", desc.value);

  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
    form.append("image" + x, image.files[x]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "  Product Saved Successfully.") {
        var alertModal = document.getElementById("alertModal");
        apm = new bootstrap.Modal(alertModal);
        apm.show();
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
        document.getElementById("msg").innerHTML = text;
      } else {
        var alertModal = document.getElementById("alertModal");
        apm = new bootstrap.Modal(alertModal);
        apm.show();
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open("POST", "./process/addProductProcess.php", true);
  request.send(form);
}

var spm;

function changeStatus(id) {
  var pid = id;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "Product Deactivated") {
        var alertModal = document.getElementById("alertModal");
        spm = new bootstrap.Modal(alertModal);
        spm.show();
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("msg").innerHTML = "  Product Deactivated";
      } else if (text == "Product Activated") {
        var alertModal = document.getElementById("alertModal");
        spm = new bootstrap.Modal(alertModal);
        spm.show();
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
        document.getElementById("msg").innerHTML = "  Product Activated";
      } else {
        var alertModal = document.getElementById("alertModal");
        spm = new bootstrap.Modal(alertModal);
        spm.show();
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open("GET", "./process/changeStatusProcess.php?id=" + pid, true);
  request.send();
}

function sellersProductSearch(x) {
  var search = document.getElementById("search").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      document.getElementById("sort").innerHTML = text;
    }
  };

  request.open(
    "GET",
    "./process/sellersProductSearchProcess.php?s=" + search + "&page=" + x,
    true
  );
  request.send();
}

function removeFromSellersProduct(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "success") {
        var alertModal = document.getElementById("alertModal");
        spm = new bootstrap.Modal(alertModal);
        spm.show();
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
        document.getElementById("msg").innerHTML =
          "  Product Move to Recycle Bin";
      } else {
        var alertModal = document.getElementById("alertModal");
        spm = new bootstrap.Modal(alertModal);
        spm.show();
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open(
    "GET",
    "./process/removeFromSellersProductProcess.php?id=" + id,
    true
  );
  request.send();
}

function sort_1(x) {
  var search = document.getElementById("search").value;
  var qty = "0";

  if (document.getElementById("h").checked) {
    qty = "1";
  } else if (document.getElementById("l").checked) {
    qty = "2";
  }

  var condition = "0";

  if (document.getElementById("b").checked) {
    condition = "1";
  } else if (document.getElementById("u").checked) {
    condition = "2";
  }

  var form = new FormData();
  form.append("s", search);
  form.append("q", qty);
  form.append("c", condition);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      document.getElementById("sort").innerHTML = text;
    }
  };

  request.open("POST", "./process/sortProcess.php", true);
  request.send(form);
}

function sendId(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "success") {
        window.location = "updateProduct.php";
      } else {
        var alertModal = document.getElementById("alertModal");
        spm = new bootstrap.Modal(alertModal);
        spm.show();
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open("GET", "./process/sendProductProcess.php?id=" + id, true);
  request.send();
}

var upm;

function updateProduct() {
  var title = document.getElementById("t");
  var qty = document.getElementById("q");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var desc = document.getElementById("desc");
  var images = document.getElementById("imageUploader");

  var form = new FormData();
  form.append("t", title.value);
  form.append("q", qty.value);
  form.append("dwc", dwc.value);
  form.append("doc", doc.value);
  form.append("desc", desc.value);

  var img_count = images.files.length;

  for (var x = 0; x < img_count; x++) {
    form.append("i" + x, images.files[x]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "success") {
        var alertModal = document.getElementById("alertModal");
        upm = new bootstrap.Modal(alertModal);
        upm.show();
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
        document.getElementById("msg").innerHTML =
          "  Product Updated Successfully.";
      } else if (text == "  File type not allowed !!!success") {
        var alertModal = document.getElementById("alertModal");
        upm = new bootstrap.Modal(alertModal);
        upm.show();
        document.getElementById("msg").innerHTML =
          "  File type not allowed !!!";
      } else {
        var alertModal = document.getElementById("alertModal");
        upm = new bootstrap.Modal(alertModal);
        upm.show();
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open("POST", "./process/updateProdutProcess.php", true);
  request.send(form);
}

function basicSearch(x) {
  var search_text = document.getElementById("basicSearchText");
  var search_select = document.getElementById("basicSearchSelect");

  var form = new FormData();
  form.append("t", search_text.value);
  form.append("s", search_select.value);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      document.getElementById("basicSearchResult").innerHTML = text;
    }
  };

  request.open("POST", "./process/basicSearchProcess.php", true);
  request.send(form);
}

var hm;

function addToWatchlist(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "removed") {
        document.getElementById("heart" + id).classList =
          "bi bi-heart text-danger fs-5";
      } else if (text == "added") {
        document.getElementById("heart" + id).classList =
          "bi bi-heart-fill text-danger fs-5";
      } else {
        var alertModal = document.getElementById("alertModal");
        hm = new bootstrap.Modal(alertModal);
        hm.show();
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open("GET", "./process/addToWatchlistProcess.php?id=" + id, true);
  request.send();
}

function removeFromWatchlist(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "success") {
        window.location.reload();
      } else {
        var alertModal = document.getElementById("alertModal");
        spm = new bootstrap.Modal(alertModal);
        spm.show();
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open("GET", "./process/removeWatchlistProcess.php?id=" + id, true);
  request.send();
}

function loadMainImg(id) {
  var img = document.getElementById("productImg" + id).src;
  var main = document.getElementById("main-img");
  main.style.backgroundImage = "url(" + img + ")";
}

function checkValue(qty) {
  var input = document.getElementById("qty_input");

  if (input.value <= 0) {
    alert("Quantity must be 1 or more");
    input.value = 1;
  } else if (input.value > qty) {
    alert("Maximum Quantity achieved");
    input.value = qty;
  }
}

function qty_inc(qty) {
  var input = document.getElementById("qty_input");

  if (input.value < qty) {
    var newValue = parseInt(input.value) + 1;
    input.value = newValue.toString();
  } else {
    alert("Maximum Quantity has achieved");
    input.value = qty;
  }
}

function qty_dec() {
  var input = document.getElementById("qty_input");

  if (input.value > 1) {
    var newValue = parseInt(input.value) - 1;
    input.value = newValue.toString();
  } else {
    alert("Minimum Quantity has achieved");
    input.value = 1;
  }
}

function restoreProduct(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "success") {
        var alertModal = document.getElementById("alertModal");
        spm = new bootstrap.Modal(alertModal);
        spm.show();
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
        document.getElementById("msg").innerHTML = "  Product Restored";
      } else {
        var alertModal = document.getElementById("alertModal");
        spm = new bootstrap.Modal(alertModal);
        spm.show();
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open("GET", "./process/restoreProductProcess.php?id=" + id, true);
  request.send();
}

function deleteForever(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "success") {
        var alertModal = document.getElementById("alertModal");
        spm = new bootstrap.Modal(alertModal);
        spm.show();
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
        document.getElementById("msg").innerHTML = "  Product Deleted";
      } else {
        var alertModal = document.getElementById("alertModal");
        spm = new bootstrap.Modal(alertModal);
        spm.show();
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open(
    "GET",
    "./process/productDeleteForeverProcess.php?id=" + id,
    true
  );
  request.send();
}

function addToCart(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (
        text == "  Product Added Successfully" ||
        text == "  Product Updated"
      ) {
        var alertModal = document.getElementById("alertModal");
        hm = new bootstrap.Modal(alertModal);
        hm.show();
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
        document.getElementById("msg").innerHTML = text;
      } else {
        var alertModal = document.getElementById("alertModal");
        hm = new bootstrap.Modal(alertModal);
        hm.show();
        document.getElementById("msg").className =
          "bi bi-exclamation-triangle-fill";
        document.getElementById("alertdiv").classList = "alert alert-danger";
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open("GET", "./process/addToCartProcess.php?id=" + id, true);
  request.send();
}

function d() {
  var msg = document.getElementById("msg");

  if (
    msg.innerHTML == "  Product Added Successfully" ||
    msg.innerHTML == "  Product Already Added"
  ) {
    hm.hide();
  } else {
    window.location.reload();
  }
}

function removeFromCart(id) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "success") {
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "./process/deleteFromCartProcess.php?id=" + id, true);
  request.send();
}

function updateCartQty(id, pqty) {
  var qty = document.getElementById("qty_input").value;

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var text = request.responseText;

      if (text == "  Quantity Updated") {
        var alertModal = document.getElementById("alertModal");
        hm = new bootstrap.Modal(alertModal);
        hm.show();
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
        document.getElementById("msg").innerHTML = text;
      } else if (text == "  Maximum Quantity Reached") {
        qty_inc(pqty);
      } else {
        var alertModal = document.getElementById("alertModal");
        hm = new bootstrap.Modal(alertModal);
        hm.show();
        document.getElementById("msg").className =
          "bi bi-exclamation-triangle-fill";
        document.getElementById("alertdiv").classList = "alert alert-danger";
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open(
    "GET",
    "./process/updateCartQtyProcess.php?id=" + id + "&qty=" + qty,
    true
  );
  request.send();
}

function Alert() {
  if (
    document.getElementById("msg").innerHTML ==
      "  Please Log In or Sign Up !!!" ||
    document.getElementById("msg").innerHTML ==
      "  Log In or Sign Up First !!!" ||
    document.getElementById("msg").innerHTML == "    Log In First"
  ) {
    window.location = "index.php";
  } else if (
    document.getElementById("msg").innerHTML ==
    "  Please Update Your Profile First !!!"
  ) {
    window.location = "userProfile.php";
  } else if (
    document.getElementById("msg").innerHTML == "  Something Went Wrong !!!" ||
    document.getElementById("msg").innerHTML == "  Message Was Sent" ||
    document.getElementById("msg").innerHTML == "  Product Updated" ||
    document.getElementById("msg").innerHTML == "  Quantity Updated" ||
    document.getElementById("msg").innerHTML == "  Invalid Quantity" ||
    document.getElementById("msg").innerHTML == "  Product Added Successfully"
  ) {
    window.location.reload();
  } else if (
    document.getElementById("msg").innerHTML ==
    "  Name Field Can Not Be Empty !!!"
  ) {
    hm.hide();
    document.getElementById("name").classList =
      "form-control rounded-5 border-danger";
  } else if (
    document.getElementById("msg").innerHTML ==
    "  Email Field Can Not Be Empty !!!"
  ) {
    hm.hide();
    document.getElementById("email").classList =
      "form-control rounded-5 border-danger";
  } else if (
    document.getElementById("msg").innerHTML ==
      "  Subject Field Can Not Be Empty !!!" ||
    document.getElementById("msg").innerHTML ==
      "  Subject Must Have 100 Characters !!!"
  ) {
    hm.hide();
    document.getElementById("subject").classList =
      "form-control rounded-5 border-danger";
  } else if (
    document.getElementById("msg").innerHTML ==
    "  Message Field Can Not Be Empty !!!"
  ) {
    hm.hide();
    document.getElementById("message").classList =
      "form-control rounded-3 border-danger";
  }
}

function printInvoice() {
  var body = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = body;
}

var ddm;

function deleteOne(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "1") {
        window.location.reload();
      } else {
        var alertModal = document.getElementById("alertModal");
        ddm = new bootstrap.Modal(alertModal);
        ddm.show();
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open("GET", "./process/deleteOneProcess.php?id=" + id, true);
  request.send();
}

function deleteAll() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "1") {
        window.location.reload();
      } else {
        var alertModal = document.getElementById("alertModal");
        ddm = new bootstrap.Modal(alertModal);
        ddm.show();
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open("GET", "./process/deleteAllProcess.php", true);
  request.send();
}

var dm;

function deleteModal() {
  var verificationmodel = document.getElementById("alertModal-1");
  dm = new bootstrap.Modal(verificationmodel);
  dm.show();
}

var cm;

function new_chat() {
  var chatModal = document.getElementById("chatModal");
  cm = new bootstrap.Modal(chatModal);
  cm.show();
}

var cam;

function start_chat() {
  var name = document.getElementById("name").value;

  if (name != 0) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState == 4) {
        var text = request.responseText;

        if (
          text == "  Invalid Seller !!!" ||
          text == "  Something Went Wrong !!!"
        ) {
          cm.hide();
          var alertModal = document.getElementById("alertModal");
          cam = new bootstrap.Modal(alertModal);
          cam.show();
          document.getElementById("msg").innerHTML = text;
        } else {
          var email = text;

          cm.hide();
          viewMessages(email);
        }
      }
    };

    request.open("GET", "./process/startChatProcess.php?name=" + name, true);
    request.send();
  }
}

function viewMessages(email) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      document.getElementById("chat_box").innerHTML = text;
    }
  };

  request.open("GET", "./process/viewMsgProcess.php?e=" + email, true);
  request.send();
}

function send_msg() {
  var email = document.getElementById("rmail");
  var txt = document.getElementById("msg_text");

  var form = new FormData();
  form.append("e", email.innerHTML);
  form.append("t", txt.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      var object = JSON.parse(text);
      viewMessages(object.email);
    }
  };

  request.open("POST", "./process/sendMsgProcess.php", true);
  request.send(form);
}

function deleteChat(email) {
  var form = new FormData();
  form.append("e", email);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "1") {
        var alertModal = document.getElementById("alertModal");
        cam = new bootstrap.Modal(alertModal);
        cam.show();
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
        document.getElementById("msg").innerHTML = "Chat Deleted.";
      }
    }
  };

  request.open("POST", "./process/deleteChat.php", true);
  request.send(form);
}

function advancedSearch(x) {
  var txt = document.getElementById("search-field");
  var category = document.getElementById("category");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");
  var condition = document.getElementById("condition");
  var color = document.getElementById("colour");
  var priceFrom = document.getElementById("price-from");
  var priceTo = document.getElementById("price-to");
  var p1 = document.getElementById("p1");
  var p2 = document.getElementById("p2");
  var q1 = document.getElementById("q1");
  var q2 = document.getElementById("q2");

  var sort1 = "0";
  var sort2 = "0";

  if (p1.checked) {
    sort1 = "1";
  } else if (p2.checked) {
    sort1 = "2";
  }

  if (q1.checked) {
    sort2 = "1";
  } else if (q2.checked) {
    sort2 = "2";
  }

  var form = new FormData();
  form.append("t", txt.value);
  form.append("c", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("con", condition.value);
  form.append("col", color.value);
  form.append("pf", priceFrom.value);
  form.append("pt", priceTo.value);
  form.append("s1", sort1);
  form.append("s2", sort2);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      document.getElementById("view_area").innerHTML = text;
      document.getElementById("emptyView").classList = "d-none";
    }
  };

  request.open("POST", "./process/advanceSearchProcess.php", true);
  request.send(form);
}

var avm;
var aam;

function adminSignin() {
  var email = document.getElementById("e");

  var form = new FormData();
  form.append("e", email.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "Success") {
        alert("Verification Code Sent to the Email, Please Check Your Inbox");
        var adminVerificationModal = document.getElementById(
          "adminVerificationModel"
        );
        avm = new bootstrap.Modal(adminVerificationModal);
        avm.show();
      } else {
        var alertModal = document.getElementById("alertModal");
        aam = new bootstrap.Modal(alertModal);
        aam.show();
        document.getElementById("msg").innerHTML = text;
      }
    }
  };

  request.open("POST", "./process/adminVerificationProcess.php", true);
  request.send(form);
}

function verify() {
  var verification = document.getElementById("vcode").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "success") {
        avm.hide();
        window.location = "adminPanel.php";
      } else {
        alert(text);
      }
    }
  };

  request.open(
    "GET",
    "./process/adminVerifyProcess.php?v=" + verification,
    true
  );
  request.send();
}

function downloadPDF() {
  var invoice = document.getElementById("invoice");
  console.log(invoice);
  console.log(window);
  var opt = {
    margin: 0,
    filename: "invoice.pdf",
    image: { type: "jpeg", quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
  };
  html2pdf().from(invoice).set(opt).save();
}

function select(email) {
  var row = document.getElementById("row" + email);
  var check = document.getElementById("check" + email);
  if (check.checked) {
    row.classList.remove("bg-light");
    row.style.backgroundColor = " #CCD1D1";
  } else {
    row.classList = "bg-light";
  }
}

function blockUser(email) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "1" || text == "2") {
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };
  request.open("GET", "./process/blockUserProcess.php?email=" + email, true);
  request.send();
}

function blockProduct(id) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "1" || text == "2") {
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };
  request.open("GET", "./process/blockProductProcess.php?id=" + id, true);
  request.send();
}

function addCategory() {
  var category_name = document.getElementById("category_name").value;

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "1") {
        alert("Category Added Successfully");
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };
  request.open(
    "GET",
    "./process/addCategoryProcess.php?n=" + category_name,
    true
  );
  request.send();
}

function addBrand() {
  var brand_name = document.getElementById("brand_name").value;

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "1") {
        alert("Brand Added Successfully");
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };
  request.open("GET", "./process/addBrandProcess.php?n=" + brand_name, true);
  request.send();
}

function addModel() {
  var category = document.getElementById("category").value;
  var brand = document.getElementById("brand").value;
  var model = document.getElementById("model").value;

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "1") {
        alert("Model Added Successfully");
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };
  request.open(
    "GET",
    "./process/addModelProcess.php?m=" +
      model +
      "&b=" +
      brand +
      "&c=" +
      category,
    true
  );
  request.send();
}

function deleteCategory(c) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "1" || text == "2") {
        alert("Category Successfully Deleted");
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };
  request.open("GET", "./process/deleteCategory.php?c=" + c, true);
  request.send();
}

function deleteBrand(b) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "1" || text == "2") {
        alert("Brand Successfully Deleted");
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };
  request.open("GET", "./process/deleteBrand.php?b=" + b, true);
  request.send();
}

function deleteModel(m) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "1" || text == "2") {
        alert("Model Successfully Deleted");
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };
  request.open("GET", "./process/deleteModel.php?m=" + m, true);
  request.send();
}

function updateStatus(id, status) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "1") {
        alert("Status Successfully Updated");
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };
  request.open(
    "GET",
    "./process/updateStatus.php?id=" + id + "&s=" + status,
    true
  );
  request.send();
}

function findSellings(x) {
  var from = document.getElementById("from").value;
  var to = document.getElementById("to").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      document.getElementById("viewArea").innerHTML = text;
    }
  };

  request.open(
    "GET",
    "./process/findSellingsProcess.php?f=" +
      from +
      "&t=" +
      to +
      "&page_no=" +
      x,
    true
  );
  request.send();
}

function viewUserMessages(email) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      document.getElementById("chat_box").innerHTML = text;
    }
  };

  request.open("GET", "./process/viewUserMsgProcess.php?e=" + email, true);
  request.send();
}

function send_user_msg() {
  var email = document.getElementById("rmail");
  var txt = document.getElementById("msg_text");

  var form = new FormData();
  form.append("e", email.innerHTML);
  form.append("t", txt.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      var object = JSON.parse(text);
      viewUserMessages(object.email);
    }
  };

  request.open("POST", "./process/sendUserMsgProcess.php", true);
  request.send(form);
}

function clearChat(email) {
  var form = new FormData();
  form.append("e", email);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "1") {
        var alertModal = document.getElementById("alertModal");
        cam = new bootstrap.Modal(alertModal);
        cam.show();
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
        document.getElementById("msg").innerHTML = "Chat Deleted.";
      }
    }
  };

  request.open("POST", "./process/clearChat.php", true);
  request.send(form);
}

function start_user_chat() {
  var name = document.getElementById("name").value;

  if (name != 0) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState == 4) {
        var text = request.responseText;
        var object = JSON.parse(text);
        cm.hide();
        viewUserMessages(object.email);
      }
    };

    request.open(
      "GET",
      "./process/startUserChatProcess.php?name=" + name,
      true
    );
    request.send();
  }
}

function viewAdminMessages(email) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      document.getElementById("chat_box").innerHTML = text;
    }
  };

  request.open("GET", "./process/viewAdminMsgProcess.php?e=" + email, true);
  request.send();
}

function send_admin_msg() {
  var email = document.getElementById("rmail");
  var txt = document.getElementById("msg_text");

  var form = new FormData();
  form.append("e", email.innerHTML);
  form.append("t", txt.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      var object = JSON.parse(text);
      viewAdminMessages(object.email);
    }
  };

  request.open("POST", "./process/sendAdminMsgProcess.php", true);
  request.send(form);
}

function start_admin_chat() {
  var name = document.getElementById("name").value;

  if (name != 0) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
      if (request.readyState == 4) {
        var text = request.responseText;
        cm.hide();
        var object = JSON.parse(text);
        viewAdminMessages(object.email);
      }
    };

    request.open(
      "GET",
      "./process/startAdminChatProcess.php?name=" + name,
      true
    );
    request.send();
  }
}

function changeAdminProfileImage() {
  var view = document.getElementById("viewImg");
  var file = document.getElementById("profileImg");

  file.onchange = function () {
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);
    view.src = url;

    document.getElementById("saveImg").classList.remove("disabled");
  };
}

function saveAdminImage() {
  var image = document.getElementById("profileImg");

  var form = new FormData();

  if (image.files.length == 0) {
    var confirmation = confirm(
      "Are you sure You don't want to Update Profile Image?"
    );

    if (confirmation) {
      alert("You have not selected any Image");
    }
  } else {
    form.append("image", image.files[0]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "  Success.") {
        oim.hide();
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML =
          "  Profile Image Updated Successfuly.";
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
      } else {
        oim.hide();
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "./process/saveAdminProfileImageProcess.php", true);
  request.send(form);
}

function deleteAdminProfileImage(email) {
  var form = new FormData();
  form.append("e", email);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "success") {
        oim.hide();
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML =
          "  Profile Image Delete Successfuly.";
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
      } else {
        oim.hide();
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "./process/deleteAdminProfileImageProcess.php", true);
  request.send(form);
}

function saveAdminDetails() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var gender = document.getElementById("gender");

  var form = new FormData();
  form.append("fn", fname.value);
  form.append("ln", lname.value);
  form.append("g", gender.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "  Success.") {
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML = "Profile Updated";
        document.getElementById("msg").className = "bi bi-check2-circle";
        document.getElementById("alertdiv").classList = "alert alert-success";
      } else {
        var alertModal = document.getElementById("alertModal");
        um = new bootstrap.Modal(alertModal);
        um.show();
        document.getElementById("msg").innerHTML = text;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "./process/saveAdminDetailsProcess.php", true);
  request.send(form);
}

function searchUser(x) {
  var name = document.getElementById("search_field").value;

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      document.getElementById("table_loader").innerHTML = text;
    }
  };
  request.open(
    "GET",
    "./process/searchUser.php?name=" + name + "&page_no=" + x,
    true
  );
  request.send();
}

function searchProducts(x) {
  var title = document.getElementById("search_field").value;

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      document.getElementById("table_loader").innerHTML = text;
    }
  };
  request.open(
    "GET",
    "./process/searchProducts.php?title=" + title + "&page_no=" + x,
    true
  );
  request.send();
}

function buyNow(id) {
  const qty = document.getElementById("qty_input").value;
  const req = new XMLHttpRequest();
  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      const res = req.responseText;
      const obj = JSON.parse(res);

      const mail = obj["mail"];
      const amount = obj["amount"];

      if (res == "1") {
        alert("Please log in or sign up");
        window.location = "index.php";
      } else if (res == "2") {
        alert("Please update your profile first");
        window.location = "userProfile.php";
      } else {
        payhere.onCompleted = function onCompleted(orderId) {
          saveInvoice(orderId, id, mail, amount, qty);

          console.log("Payment completed. OrderID:" + orderId);
        };

        payhere.onDismissed = function onDismissed() {
          console.log("Payment dismissed");
        };

        payhere.onError = function onError(error) {
          console.log("Error:" + error);
        };

        var payment = {
          sandbox: true,
          merchant_id: obj["merchant_id"],
          return_url: "http://localhost/digishop/sigleProductView.php?id=" + id, // Important
          cancel_url: "http://localhost/digishop/sigleProductView.php?id=" + id, // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["id"],
          items: obj["item"],
          amount: amount,
          currency: "LKR",
          hash: obj["hash"],
          first_name: obj["fname"],
          last_name: obj["lname"],
          email: mail,
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["city"],
          country: "Sri Lanka",
          delivery_address: obj["address"],
          delivery_city: obj["city"],
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        payhere.startPayment(payment);
      }
    }
  };
  req.open("GET", "./process/buyNowProcess.php?id=" + id + "&qty=" + qty, true);
  req.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {
  const form = new FormData();
  form.append("o", orderId);
  form.append("i", id);
  form.append("m", mail);
  form.append("a", amount);
  form.append("q", qty);

  const req = new XMLHttpRequest();

  req.onreadystatechange = () => {
    if (req.readyState == 4) {
      const res = req.responseText;
      if (res == "1") {
        window.location = "invoice.php?id=" + orderId;
      } else {
        alert(res);
      }
    }
  };

  req.open("POST", "./process/saveInvoice.php", true);
  req.send(form);
}

function checkout() {
  const req = new XMLHttpRequest();
  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      const res = req.responseText;
      const obj = JSON.parse(res);

      if (res == "1") {
        alert("Please update your profile first");
        window.location = "userProfile.php";
      } else {
        payhere.onCompleted = function onCompleted(orderId) {
          saveInvoiceCheckout(orderId);

          console.log("Payment completed. OrderID:" + orderId);
        };

        payhere.onDismissed = function onDismissed() {
          console.log("Payment dismissed");
        };

        payhere.onError = function onError(error) {
          console.log("Error:" + error);
        };

        var payment = {
          sandbox: true,
          merchant_id: obj["merchant_id"],
          return_url: "http://localhost/digishop/cart.php",
          cancel_url: "http://localhost/digishop/cart.php",
          notify_url: "http://sample.com/notify",
          order_id: obj["id"],
          items: obj["item"],
          amount: obj["amount"],
          currency: "LKR",
          hash: obj["hash"],
          first_name: obj["fname"],
          last_name: obj["lname"],
          email: obj["mail"],
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["city"],
          country: "Sri Lanka",
          delivery_address: obj["address"],
          delivery_city: obj["city"],
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        payhere.startPayment(payment);
      }
    }
  };
  req.open("GET", "./process/checkoutProcess.php", true);
  req.send();
}

function saveInvoiceCheckout(orderId) {
  const req = new XMLHttpRequest();
  req.onreadystatechange = () => {
    if (req.readyState == 4 && req.status == 200) {
      const res = req.responseText;
      if (res == "1") {
        window.location = "invoice.php?id=" + orderId;
      } else {
        alert(res);
      }
    }
  };
  req.open("POST", "./process/saveCheckoutInvoice.php", true);
  req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  req.send("orderId=" + orderId);
}
