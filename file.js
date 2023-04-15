/*dark mode*/
let btn=document.getElementById("btn");
let btntext=document.getElementById("btntext");
let btnIcon=document.getElementById("btnIcon");
let tile=document.getElementById("tile");
let logo=document.getElementById("logo");
let logo1=document.getElementById("logo1");
btn.onclick=function(){
    document.body.classList.toggle("dark-theme");
    if( document.body.classList.contains("dark-theme")){
        btnIcon.src="img/bxs-sun.png";
        btntext.innerHTML="Light";
        tile.src ="img/tile.white.png";
        logo.src ="img/bl title.white.png";
        logo1.src ="img/bl title.white.png";
    }else{
        btnIcon.src="img/bxs-moon (1).png";
        btntext.innerHTML="Dark";
        tile.src ="img/tile.png";
        logo.src ="img/bl title.png";
        logo1.src ="img/bl title.png";
    }
}
/*recherche bl enter*/
let rech=document.getElementById('rech');
rech.addEventListener("keypress",function(event){
    if (event.key === "Enter"){
        event.preventDefault();
        document.getElementById("bassara").click();
    }
});
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
/*modal*/
var mybtn=document.getElementById("mybtn");
var modal=document.getElementById("modal");
var close=document.querySelector(".close");
var send=document.querySelector(".send");
mybtn.onclick=function(){
    modal.style.display="block";
}
close.onclick=function(){
    modal.style.display="none";
}
send.onclick=function(){
    modal.style.display="none";
}
window.onclick=function(event){
    if(event.target==modal){
        modal.style.display="none";
    }
}