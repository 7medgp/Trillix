/*modal*/
var mybtn=document.getElementById("mybtn");
var modal=document.getElementById("modal");
var close=document.querySelector(".close");
mybtn.onclick=function(){
    modal.style.display="block";
}
close.onclick=function(){
    modal.style.display="none";
}
window.onclick=function(event){
    if(event.target==modal){
        modal.style.display="none";
    }
}
/*zina taa el form*/
const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const main = document.getElementById('main');

		signUpButton.addEventListener('click', () => {
			main.classList.add("right-panel-active");
		});
		signInButton.addEventListener('click', () => {
			main.classList.remove("right-panel-active");
		});