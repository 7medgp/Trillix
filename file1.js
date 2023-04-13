let btn=document.getElementById("btn");
let btntext=document.getElementById("btntext");
let btnIcon=document.getElementById("btnIcon");

let logo=document.getElementById("logo");
let logo1=document.getElementById("logo2");
btn.onclick=function(){
    document.body.classList.toggle("dark-theme");
    if( document.body.classList.contains("dark-theme")){
        btnIcon.src="img/bxs-sun.png";
        btntext.innerHTML="Light";
        logo.src ="img/bl title.white.png";
        logo1.src ="img/bl title.white.png";
    }else{
        btnIcon.src="img/bxs-moon (1).png";
        btntext.innerHTML="Dark";
        logo.src ="img/bl title.png";
        logo1.src ="img/bl title.png";
    }
}
/*menu humburger*/
let menu=document.querySelector('#menu-icon');
let navbar=document.querySelector('.navbar');
menu.onclick=()=>{
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('active');
}
/*kifech tna7i menu wa9tli tescrolli*/
window.onscroll=()=>{
    menu.classList.remove('bx-x');
    navbar.classList.remove('active');
}