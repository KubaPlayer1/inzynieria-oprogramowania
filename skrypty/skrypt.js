const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnpopup = document.querySelector('.button-pop');
const close = document.querySelector('.close-button');

registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
});

btnpopup.addEventListener('click', ()=> {
    wrapper.classList.add('active-popup');
});

close.addEventListener('click', ()=> {
    wrapper.classList.remove('active-popup');
});