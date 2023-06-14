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

function toggleAccountDropdown() {
  var dropdownMenu = document.getElementById("option-dropdown-menu");
  if (dropdownMenu.style.display === "block") {
    dropdownMenu.style.display = "none";
  } else {
    dropdownMenu.style.display = "block";
  }
}

function toggleOptionDropdown() {
  var dropdownMenu = document.getElementById("account-dropdown-menu");
  if (dropdownMenu.style.display === "block") {
    dropdownMenu.style.display = "none";
  } else {
    dropdownMenu.style.display = "block";
  }
}

console.log('Script loaded');

// Overzicht pagina
function ShowAndHide(section) {
  var sections = document.getElementsByClassName("section");
  for (var i = 0; i < sections.length; i++) {
    sections[i].style.display = "none";
  }
  document.getElementsByClassName("section" + section)[0].style.display = "block";
}

document.addEventListener('DOMContentLoaded', function() {
  const accountDropdown  = document.getElementById('option-dropdown');
  const optionDropdown = document.getElementById('account-dropdown-button');

  // Option Dropdown
  const optionDropdownButton = document.getElementById('account-dropdown-button');
  optionDropdownButton.addEventListener('click', function() {
    toggleOptionDropdown();
    toggleAccountDropdown(); // Close account dropdown if open
  });

  // Account Dropdown
  const accountDropdownButton = document.getElementById('option-dropdown-button');
  accountDropdownButton.addEventListener('click', function() {
    toggleOptionDropdown();
    toggleAccountDropdown(); // Close option dropdown if open
  });

  const dropdownItems = document.querySelectorAll('.dropdown-item');
  for (var i = 0; i < dropdownItems.length; i++) {
    dropdownItems[i].addEventListener('click', function() {
      const index = parseInt(this.getAttribute('data-table'));
      ShowAndHide(index);
      toggleOptionDropdown(); // Hide the option dropdown after selection
    });
  }

  // Handle form submission
  $('#search-form').submit(function(event) {
    event.preventDefault(); // Prevent default form submission

    var searchQuery = $('#search-input').val(); // Get the search query

    // Make an AJAX request to search.php
    $.ajax({
      url: 'search.php',
      type: 'GET',
      data: { search: searchQuery },
      dataType: 'html',
      success: function(response) {
        // Update the table with the response
        $('#gebruiker-table').html(response);
      },
      error: function() {
        alert('Error occurred while searching.'); // Show an error message
      }
    });
  });
});
