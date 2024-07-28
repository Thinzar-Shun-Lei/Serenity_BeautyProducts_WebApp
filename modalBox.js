// // Modal box onClick

// document.addEventListener("DOMContentLoaded", function() {
var modal = document.getElementById("modalBox");
var logout = document.getElementById("onClickLogout");
var logoutSm = document.getElementById("onClickLogoutSm");
var close = document.getElementsByClassName("close")[0];
var cancel = document.getElementsByClassName("cancel")[0];

// console.log('logout');
// console.log('logoutSm');

logout.onclick = function() {
  modal.style.display = "block";
}

if (logoutSm !== null) {
    logoutSm.onclick = function() {
        modal.style.display = "block";
      }
}

close.onclick = function() {
  modal.style.display = "none";
}

cancel.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
// document.addEventListener("click", function(event) {
//     if (event.target.id === "onClickLogout") {
//         modal.style.display = "block";
//     } else if (event.target.id === "onClickLogoutSm") {
//         modal.style.display = "block";
//     } else if (event.target.classList.contains("close")) {
//         modal.style.display = "none";
//     } else if (event.target.classList.contains("cancel")) {
//         modal.style.display = "none";
//     }
// });
// });




// document.addEventListener("DOMContentLoaded", function() {
//     var modal = document.getElementById("modalBox");
//     var logout = document.getElementById("onClickLogout");
//     var logoutSm = document.getElementById("onClickLogoutSm");
//     var close = document.getElementsByClassName("close")[0];
//     var cancel = document.getElementsByClassName("cancel")[0];

//         logout.onclick = function() {
//             modal.style.display = "block";
//         }

//         logoutSm.onclick = function() {
//             modal.style.display = "block";
//         }

//         close.onclick = function() {
//             modal.style.display = "none";
//         }

//         cancel.onclick = function() {
//             modal.style.display = "none";
//         }

//     window.onclick = function(event) {
//         if (event.target == modal) {
//             modal.style.display = "none";
//         }
//     }
// });
