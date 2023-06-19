/*dark mode*/
let btn=document.getElementById("btn");
let btntext=document.getElementById("btntext");
let btnIcon=document.getElementById("btnIcon");

btn.onclick=function(){
    document.body.classList.toggle("dark-theme");
    let theme = '';
    if( document.body.classList.contains("dark-theme")){
        btnIcon.src="../img/bxs-sun.png";
        btntext.innerHTML="Light";
        theme='dark';
    }else{
        btnIcon.src="../img/bxs-moon (1).png";
        btntext.innerHTML="Dark";
        
        theme='light';
    }
    document.cookie ='theme='+ theme;
}
function redirect(){
    Swal.fire('You have to connect first','error','error');
        function ab3th(){
            window.location.href = "../login-signup/login.php";
        }
        window.setTimeout(ab3th,1000);
}