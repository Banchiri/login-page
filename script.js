document.addEventListener("DOMContentLoaded", function(){ 
    const signUpButton=document.getElementById('signUpButton');
    const signInButton=document.getElementById('signInButton');
    const signInForm=document.getElementById('signIn');
    const signUpForm=document.getElementById('signUp');
    function showForm(show, hide) {
        hide.classList.add("hidden"); // Hide the other form
        setTimeout(() => {
            hide.style.display = "none";
            show.style.display = "block";
            show.classList.remove("hidden"); // Show the selected form
        }, 300); // Delay to allow the fade-out animation
    }

    signUpButton.addEventListener('click',function(){
        showForm(signUpForm, signInForm);


    }); 

    signInButton.addEventListener('click',function(){
        showForm(signInForm, signUpForm)

    });

});