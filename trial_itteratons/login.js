const form = document.getElementById('login-form');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const errorOverlay = document.getElementById('error-overlay');
const errorMessage = document.getElementById('error-message');
const closeErrorButton = document.getElementById('close-error');

// Will be adding afterwords
// Just implemented the logic because it was in the question
const phoneInput = document.getElementById('phone');
const confirmPasswordInput = document.getElementById('confirm-password');
const emailInput = document.getElementById('email');

function validateUsername(username) {
  return username.trim() !== '';
}

function validatePassword(password) {
  const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[&$#@]).{7,}$/;
  return passwordRegex.test(password);
}

function validatePhone(phone) {
  const phoneRegex = /^\d{10}$/;
  return phoneRegex.test(phone);
}

function validateEmail(email) {
  const emailRegex = /^[a-zA-Z]+@[a-zA-Z]{3,}\.[a-zA-Z]{2,3}$/;
  return emailRegex.test(email);
}

function showError(message) {
  errorMessage.textContent = message;
  errorOverlay.style.display = 'block';
}

function hideError() {
  errorOverlay.style.display = 'none';
}

form.addEventListener('submit', (event) => {
  event.preventDefault();
  
  const username = usernameInput.value;
  const password = passwordInput.value;
  
  if (!validateUsername(username)) {
    showError('Username cannot be empty.');
    return;
  }
  
  if (!validatePassword(password)) {
    showError('Password must be at least 7 characters long and contain at least one capital letter, one digit, and one special character (&, $, #, or @).');
    return;
  }
  
  // New validations
  if (phoneInput) {
    const phone = phoneInput.value;
    if (!validatePhone(phone)) {
      showError('Phone number must be 10 digits.');
      return;
    }
  }
  
  if (confirmPasswordInput) {
    const confirmPassword = confirmPasswordInput.value;
    if (password !== confirmPassword) {
      showError('Passwords do not match.');
      return;
    }
  }
  
  if (emailInput) {
    const email = emailInput.value;
    if (!validateEmail(email)) {
      showError('Invalid email address. It should contain @ sign and a dot, with few letters before @, three letters between @ and dot, and 2 or 3 letters after the dot.');
      return;
    }
  }
  
  console.log('Username:', username);
  console.log('Password:', password);
  window.location.href = 'dash.html';
});

closeErrorButton.addEventListener('click', hideError);
