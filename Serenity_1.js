// Adm js
// Side Panel onClick
  var hamBtn = document.getElementsByClassName("hamBtn")[0];
  var closeBtn = document.getElementsByClassName("closeBtn")[0];
  var sideBar = document.getElementsByClassName("sideBar")[0];
  var contentContainer = document.getElementsByClassName("contentContainer")[0];
  
  hamBtn.onclick = function() {
    sideBar.style.display = "block";
    hamBtn.style.display = "none";
    contentContainer.style.display = "none";
  }
  closeBtn.onclick = function() {
    sideBar.style.display = "none";
    hamBtn.style.display = "block";
    contentContainer.style.display = "block";
  }
  window.onclick = function(event) {
    if (event.target == sideBar) {
      sideBar.style.display = "none";
      hamBtn.style.display = "block";
      contentContainer.style.display = "block";
    }
  }
  // Check screen width on window resize and adjust hamBtn display
  window.onresize = function() {
    if (window.innerWidth > 990) {
      hamBtn.style.display = "none";
      sideBar.style.display = "block";
      contentContainer.style.display = "block";
    } else {
      hamBtn.style.display = "block";
      sideBar.style.display = "none";
    }
  }
 
  
//   // Purchase Checked 
//   var rdoCode = document.getElementsByClassName("rdoCode")[0];
//   var rdoSupplier = document.getElementsByClassName("rdoSupplier")[0];
//   var rdoDate = document.getElementsByClassName("rdoDate")[0];
//   var optCode = document.getElementsByClassName("optCode")[0];
//   var optSupplier = document.getElementsByClassName("optSupplier")[0];
//   var optDate = document.getElementsByClassName("optDate")[0];
//   var rdoStaff = document.getElementsByClassName("rdoStaff")[0];
//   var optStaff = document.getElementsByClassName("optStaff")[0];
  
//   // Order Checked
//   var rdoCustomer = document.getElementsByClassName("rdoCustomer")[0];
//   var optCustomer = document.getElementsByClassName("optCustomer")[0];
//   var rdoOCode = document.getElementsByClassName("rdoOCode")[0];
//   var optOCode = document.getElementsByClassName("optOCode")[0];
//   var rdoODate = document.getElementsByClassName("rdoODate")[0];
//   var optODate = document.getElementsByClassName("optODate")[0];
  
//   // Purchase Event
//   rdoCode.addEventListener("change", function() {
//     if (rdoCode.checked) {
//       optCode.style.display = "block";
//       optSupplier.style.display = "none";
//       optDate.style.display = "none";
//       optStaff.style.display = "none";
//     }
//   });
  
//   rdoSupplier.addEventListener("change", function() {
//     if (rdoSupplier.checked) {
//       optCode.style.display = "none";
//       optSupplier.style.display = "block";
//       optDate.style.display = "none";
//       optStaff.style.display = "none";
//     }
//   });
  
//   rdoDate.addEventListener("change", function() {
//     if (rdoDate.checked) {
//       optCode.style.display = "none";
//       optSupplier.style.display = "none";
//       optDate.style.display = "block";
//       optStaff.style.display = "none";
//     }
//   });
  
//   rdoStaff.addEventListener("change", function() {
//     if (rdoStaff.checked) {
//       optCode.style.display = "none";
//       optSupplier.style.display = "none";
//       optDate.style.display = "none";
//       optStaff.style.display = "block";
//     }
//   });
  
  
//   // Order Event
  
//   rdoOCode.addEventListener("change", function() {
//     if (rdoOCode.checked) {
//       optOCode.style.display = "block";
//       optCustomer.style.display = "none";
//       optODate.style.display = "none";
//       // optStaff.style.display = "none";
//     }
//   });
//   rdoODate.addEventListener("change", function() {
//     if (rdoODate.checked) {
//       optOCode.style.display = "none";
//       optCustomer.style.display = "none";
//       optODate.style.display = "block";
//       // optStaff.style.display = "none";
//     }
//   });
//   rdoCustomer.addEventListener("change", function() {
//     if (rdoCustomer.checked) {
//       optOCode.style.display = "none";
//       optCustomer.style.display = "block";
//       optODate.style.display = "none";
//       // optStaff.style.display = "none";
//     }
//   });