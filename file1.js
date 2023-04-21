let btn=document.getElementById("btn");
let btntext=document.getElementById("btntext");
let btnIcon=document.getElementById("btnIcon");
let logo=document.getElementById("logo");
let logo1=document.getElementById("logo2");
btn.onclick=function(){
    document.body.classList.toggle("dark-theme");
    let theme = "light";
    if( document.body.classList.contains("dark-theme")){
        btnIcon.src="img/bxs-sun.png";
        btntext.innerHTML="Light";
        logo.src ="img/bl title.white.png";
        logo1.src ="img/bl title.white.png";
        theme="dark";
    }else{
        btnIcon.src="img/bxs-moon (1).png";
        btntext.innerHTML="Dark";
        logo.src ="img/bl title.png";
        logo1.src ="img/bl title.png";
        theme="light";
    }
    document.cookie = "theme=" + theme;
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
/*el chariot*/ 
let basketIcon=document.querySelector('#basketIcon');
let cart=document.querySelector('.cart');
let closeCart = document.querySelector('#close-cart');
basketIcon.onclick=()=>{
    cart.classList.add("active");
};
closeCart.onclick=()=>{
    cart.classList.remove("active");
};
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
    var addCart=document.getElementsByClassName('add-cart');
    for( var i=0; i<addCart.length; i++){
        var button=addCart[i];
        button.addEventListener("event",addCartClicked);
    }
}
function addCartClicked(event){
    var button=event.target;
    var shopProducts= button.parentElement;
    var title=shopProducts.getElementsByClassName('product-title')[0].innerText;
    var price=shopProducts.getElementsByClassName('product-price')[0].innerText;
    var img=shopProducts.getElementsByClassName('product-img')[0].src;
    addProd(title,price,img);
    updatetotal();
}
function addProd(title, price, img){
    var cartShopBox = documentcreateElement("div");
    var cartItems=document.getElementsByClassName("cart-content")[0];
    var CartItemsNames= cartItems.getElementsByClassName("cart-product-title");
    for( var i=0; i<CartItemsNames.length; i++){
        alert("you have alerdu add this in the cart");
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
    }
}*/