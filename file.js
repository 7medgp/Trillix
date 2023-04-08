let btn=document.getElementById("btn");
let btntext=document.getElementById("btntext");
let btnIcon=document.getElementById("btnIcon");
btn.onclick=function(){
    document.body.classList.toggle("dark-theme");
    if( document.body.classList.contains("dark-theme")){
        btnIcon.class='bx bxs-sun';
        btntext.innerHTML="Light";
    }else{
        btnIcon.class='bx bxs-moon';
        btntext.innerHTML="Dark";
    }
}