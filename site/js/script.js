// ProgressBar
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
  // Add your form validation logic here
  return true;
}
function toggleDropdown() {
  console.log('Toggle dropdown called');
  
  var dropdownContent = document.getElementById("dropdown-content");
  
  if (dropdownContent.style.display === "block") {
    dropdownContent.style.display = "none";
    console.log('Dropdown content hidden');
  } else {
    dropdownContent.style.display = "block";
    console.log('Dropdown content shown');
  }
}

console.log('Script loaded');





