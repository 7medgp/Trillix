/*dark mode*/
let btn=document.getElementById("btn");
let btntext=document.getElementById("btntext");
let btnIcon=document.getElementById("btnIcon");
let tile=document.getElementById("tile");
let logo=document.getElementById("logo");
btn.onclick=function(){
    document.body.classList.toggle("dark-theme");
    if( document.body.classList.contains("dark-theme")){
        btnIcon.class="bx bxs-sun";
        btntext.innerHTML="Light";
        tile.src ="img/tile.white.png";
        logo.src ="img/bl title.white.png";
    }else{
        btnIcon.class="bx bxs-moon";
        btntext.innerHTML="Dark";
        tile.src ="img/tile.png";
        logo.src ="img/bl title.png";
    }
}