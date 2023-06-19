/*dark mode*/
let btn=document.getElementById("btn");
let btntext=document.getElementById("btntext");
let btnIcon=document.getElementById("btnIcon");
let tile=document.getElementById("tile");
let logo=document.getElementById("logo");
let logo1=document.getElementById("logo1");
btn.onclick=function(){
    document.body.classList.toggle("dark-theme");
    let theme = '';
    if( document.body.classList.contains("dark-theme")){
        btnIcon.src="img/bxs-sun.png";
        btntext.innerHTML="Light";
        tile.src ="img/tile.white.png";
        logo.src ="img/bl title.white.png";
        logo1.src ="img/bl title.white.png";
        theme='dark';
    }else{
        btnIcon.src="img/bxs-moon (1).png";
        btntext.innerHTML="Dark";
        tile.src ="img/tile.png";
        logo.src ="img/bl title.png";
        logo1.src ="img/bl title.png";
        theme='light';
    }
    document.cookie ='theme='+ theme;
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
//recherche bl enter
let rech=document.getElementById('rech');
rech.addEventListener("keypress",function(event){
    if (event.key === "Enter"){
        event.preventDefault();
        document.getElementById("bassara").click();
    }
});
function redirect(){
    Swal.fire('You have to connect first','error','error');
        function ab3th(){
            window.location.href = "../login-signup/login.php";
        }
        window.setTimeout(ab3th,1000);
}
/*
if (document.readyState== 'loading'){
    document.addEventListener('DOMContentLoaded', ready);
}else{
    ready();
}
function ready(){
    var removeCartButtons = document.getElementsByClassName('cart-remove');
    console.log(removeCartButtons);
    for(var i=0; i<removeCartButtons.length;i++){
        var button=removeCartButtons[i];
        button.addEventListener("click",removeCartItem);
    }
    var qtteInputs = document.getElementsByClassName('cart-qtte');
    for (var i=0; i<qtteInputs.length;i++){
        var input=qtteInputs[i];
        input.addEventListener("change",qtteChanged);
    }
}
 function qtteChanged(event){
        var input=event.target;
        if(isNaN(input.value)|| input.value <=0){
            input.value=1;
        }
        updatetotal();
    }
    
    function removeCartItem(event){
        var buttonClicked=event.target;
        buttonClicked.parentElement.remove();
        updatetotal();
    }
    function updatetotal(){
        var cartContent=document.getElementsByClassName('cart-content')[0];
        var cartboxes=cartContent.getElementsByClassName('cart-box');
        var total=0;
        for( var i=0; i<cartboxes.length; i++){
            var cartbox= cartboxes[i];
            var priceelement=cartbox.getElementsByClassName('cart-price')[0];
            var qtteelement=cartbox.getElementsByClassName('cart-qtte')[0];
            var qtte=qtteelement.value;
            var price=parseFloat(priceelement.innerText.replace("$",""));
            total= total+(price*qtte);
            total=Math.round(total*100)/100;
            document.getElementsByClassName("total-price")[0].innerText='$'+total;
        }}  */
