/* Created by Tivotal */

let sideMenu = document.querySelectorAll(".nav-link");
sideMenu.forEach((item) => {
  let li = item.parentElement;

  item.addEventListener("click", () => {
    sideMenu.forEach((link) => {
      link.parentElement.classList.remove("active");
    });
    li.classList.add("active");
  });
});

let menuBar = document.querySelector(".menu-btn");
let sideBar = document.querySelector(".sidebar");
menuBar.addEventListener("click", () => {
  sideBar.classList.toggle("hide");
});


let searchFrom = document.querySelector(".content nav form");
let searchBtn = document.querySelector(".search-btn");
let searchIcon = document.querySelector(".search-icon");
searchBtn.addEventListener("click", (e) => {
  if (window.innerWidth < 576) {
    e.preventDefault();
    searchFrom.classList.toggle("show");
    if (searchFrom.classList.contains("show")) {
      searchIcon.classList.replace("fa-search", "fa-times");
    } else {
      searchIcon.classList.replace("fa-times", "fa-search");
    }
  }
});
document.getElementById('validationForm').addEventListener('submit', function(event) {
  event.preventDefault();
  const employeeId = new FormData(this).get('employeeId');
  // Mock validation
  if (employeeId === '1234') {
      document.getElementById('validationOutput').innerText = 'Employee 1234 validated.';
  } else {
      document.getElementById('validationOutput').innerText = 'Employee not found or not authorized.';
  }
});

window.addEventListener("resize", () => {
  if (window.innerWidth > 576) {
    searchIcon.classList.replace("fa-times", "fa-search");
    searchFrom.classList.remove("show");
  }
  if (window.innerWidth < 768) {
    sideBar.classList.add("hide");
  }
});

if (window.innerWidth < 768) {
  sideBar.classList.add("hide");
}

document.querySelector('.profile').addEventListener('click', function() {
  this.classList.add('active');
  setTimeout(() => this.classList.remove('active'), 300); // Duration of animation
});

    // JavaScript for logout functionality
    document.getElementById('logout-btn').addEventListener('click', function(event) {
      event.preventDefault();
      // Perform any necessary cleanup actions here, e.g., removing user session tokens
      
      // Redirect to the login page
      window.location.href = 'Login.html';
    });
