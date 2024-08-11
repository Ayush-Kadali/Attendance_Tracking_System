const form = document.getElementById('login-form');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const errorOverlay = document.getElementById('error-overlay');
const errorMessage = document.getElementById('error-message');
const closeErrorButton = document.getElementById('close-error');

function validateUsername(username) {
  return username.trim() !== '';
}

function validatePassword(password) {
  const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[&$#@]).{7,}$/;
  return passwordRegex.test(password);
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
  
  console.log('Username:', username);
  console.log('Password:', password);
  window.location.href = 'dash.html';
});

closeErrorButton.addEventListener('click', hideError);
