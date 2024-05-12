const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.loginbtn'); 
const iconClose = document.querySelector('.icon-close');




document.addEventListener('DOMContentLoaded', () => {
  
    
    // Function to handle login/logout button click
    const handleLoginButtonClick = () => {
        if (btnPopup.textContent === 'Login') {
            wrapper.classList.add('active-popup');
        } else {
            // Perform logout action, e.g., redirect to logout URL
            window.location.href = 'includes/logout.php'; // Redirect to logout script
        }
    };
    
    registerLink.addEventListener('click', () => {
        wrapper.classList.add('active');
    });
    
    loginLink.addEventListener('click', () => {
        wrapper.classList.remove('active');
    });
    
    btnPopup.addEventListener('click', handleLoginButtonClick);
    
    iconClose.addEventListener('click', () => {
        wrapper.classList.remove('active-popup');
    });

    // Update login button text if user is logged in
    
});