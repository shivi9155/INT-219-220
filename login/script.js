// Toggle between login and signup forms
function toggleForms() {
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');
    
    if (loginForm.classList.contains('hidden')) {
        loginForm.classList.remove('hidden');
        signupForm.classList.add('hidden');
    } else {
        loginForm.classList.add('hidden');
        signupForm.classList.remove('hidden');
    }
}

// Toggle password visibility
function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const toggleButton = passwordInput.nextElementSibling;
    const icon = toggleButton.querySelector('i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Form submission handlers
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = this.querySelector('input[type="text"]').value;
    const password = this.querySelector('input[type="password"]').value;
    
    // Create form data
    const formData = new FormData();
    formData.append('action', 'login');
    formData.append('username', username);
    formData.append('password', password);
    
    // Send login request
    fetch('process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirect to dashboard
            window.location.href = '../index.php';
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred during login. Please try again.');
    });
});

document.getElementById('signupForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = this.querySelector('input[type="text"]').value;
    const password = this.querySelector('input[id="signupPassword"]').value;
    const confirmPassword = this.querySelector('input[id="confirmPassword"]').value;
    
    // Get selected gender
    const genderRadios = this.querySelectorAll('input[name="gender"]');
    let gender = '';
    genderRadios.forEach(radio => {
        if (radio.checked) {
            gender = radio.value;
        }
    });
    
    // Get selected role
    const roleRadios = this.querySelectorAll('input[name="role"]');
    let role = '';
    roleRadios.forEach(radio => {
        if (radio.checked) {
            role = radio.value;
        }
    });
    
    // Validate form
    if (!username || !password || !confirmPassword || !gender || !role) {
        alert('Please fill in all fields');
        return;
    }
    
    if (password !== confirmPassword) {
        alert('Passwords do not match');
        return;
    }
    
    // Create form data
    const formData = new FormData();
    formData.append('action', 'signup');
    formData.append('username', username);
    formData.append('password', password);
    formData.append('confirm_password', confirmPassword);
    formData.append('gender', gender);
    formData.append('role', role);
    
    // Send signup request
    fetch('process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Registration successful! Please login.');
            toggleForms(); // Switch to login form
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred during registration. Please try again.');
    });
}); 