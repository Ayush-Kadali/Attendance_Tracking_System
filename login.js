
const form = document.getElementById('login-form');
const forgotPassword = document.getElementById('forgot-password');

form.addEventListener('submit', (event) => {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    // Perform login logic here
    console.log('Username:', username);
    console.log('Password:', password);

    // Redirect to the dashboard page
    window.location.href = 'dash.html';
});

forgotPassword.addEventListener('click', () => {
    // Redirect to the forgot password page
    window.location.href = 'forgetPass.html';
});
