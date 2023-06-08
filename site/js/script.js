function showFormPart(partNumber) {
  var formParts = document.querySelectorAll('section');
  var progressBar = document.getElementById('progress-bar');

  for (var i = 0; i < formParts.length; i++) {
    formParts[i].style.display = 'none';
  }

  formParts[partNumber - 1].style.display = 'block';

  progressBar.style.width = ((partNumber - 1) * 50) + '%';
}

function updateProgress() {
  var progressBar = document.getElementById('progress-bar');
  var inputs = document.querySelectorAll('input, select');
  var count = 0;

  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].value !== '') {
      count++;
    }
  }

  progressBar.style.width = (count / inputs.length) * 100 + '%';
}

function validateForm() {
  
  return true;
}


// Dropdown
function toggleDropdown() {
  var dropdownContent = document.getElementById("dropdown-content");
  dropdownContent.classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.account-btn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
          }
      }
  }
};
