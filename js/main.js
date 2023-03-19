let connexion = document.querySelector("#modalCo");
let btn = document.querySelector('#btnCo');
let btnClose =document.querySelector('.connexionClose');
let navbar=document.querySelector('#navbar');
let html=document.querySelector('html');


connexion.style.position="absolute"
btn.onclick =()=>{
    connexion.classList.toggle('is-visible');
    html.style.overflow="hidden";
    navbar.classList.toggle('is-visible');
};
btnClose.onclick =()=>{
    connexion.classList.toggle('is-visible');
    html.style.overflow="visible";
    navbar.classList.toggle('is-visible');
};