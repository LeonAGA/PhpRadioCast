inputsLog = document.querySelector('.inputsLog');
inputsSign = document.querySelector('.inputsSign');
passwordBtn = document.querySelector('.passlogineye');
passLoginInput = document.querySelector('.passLoginInput');
passwordBtn2 = document.querySelector('.passsingupeye');
passSignupInput = document.querySelector('.passSignUpInput');
passwordBtn3 = document.querySelector('.passsingupeye2');
passSignupInput2 = document.querySelector('.passSignUpInput2');

if(inputsLog !== null){

    passwordBtn.addEventListener('mousedown', function(){
        passLoginInput.setAttribute('type', 'text');
    });
    passwordBtn.addEventListener('mouseup', function(){
        passLoginInput.setAttribute('type', 'password');
    });
}

if(inputsSign !== null){

    passwordBtn2.addEventListener('mousedown', function(){
        passSignupInput.setAttribute('type', 'text');
    });
    passwordBtn2.addEventListener('mouseup', function(){
        passSignupInput.setAttribute('type', 'password');
    });
}

if(inputsSign !== null){

    passwordBtn3.addEventListener('mousedown', function(){
        passSignupInput2.setAttribute('type', 'text');
    });
    passwordBtn3.addEventListener('mouseup', function(){
        passSignupInput2.setAttribute('type', 'password');
    });
}