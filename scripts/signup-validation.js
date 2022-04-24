const signupBtn = document.getElementById('signup-btn');
const signupForm = document.getElementById('login-form');
const errorDisplayMessage = document.getElementById('signup-err-msg');
let error_msg;
let username_valid = false;
let password_valid = false;

signupBtn.addEventListener('click', e => {
    e.preventDefault();
    const submittedUsername = document.getElementById('username').value;
    const submittedPassword= document.getElementById('password').value;
    if(submittedUsername){
        if(submittedUsername.length >= 6){
            if(submittedUsername.length < 50){
                if(/^[A-Za-z0-9]*$/.test(submittedUsername)){
                    username_valid = true;
                    //document.signupForm.submit();
                }else{
                    error_msg = 'Username must contain only letters and numbers';
                    alert(error_msg);
                    errorDisplayMessage.innerText = error_msg;
                    return;
                }
            }else{
                error_msg = 'Username must be less than 50 characters.';
                errorDisplayMessage.innerText = error_msg;
                alert(error_msg);
                return;
            }
        }else{
            error_msg = 'Username must have 6 or more characters.';
            errorDisplayMessage.innerText = error_msg;
            alert(error_msg);
            return;
        }
    }else{
        error_msg = 'Username cannot be empty.';
        errorDisplayMessage.innerText = error_msg;
        alert(error_msg);
        return;
    }
    if(submittedPassword){
        if(submittedPassword.length >= 8){
            if(submittedPassword.length <= 250){
                if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/.test(submittedPassword)){
                    password_valid = true;
                }else{
                    error_msg = 'Password contains invalid characters.';
                    errorDisplayMessage.innerText = error_msg;
                    errorDisplayMessage.style.visibility = 'visible';
                    alert(error_msg);
                    return;
                }
            }else{
                error_msg = 'Password cannot be longer than 250 characters.';
                errorDisplayMessage.innerText = error_msg;
                errorDisplayMessage.style.visibility = 'visible';
                alert(error_msg);
                return;
            }
        }else{
            error_msg = 'Password must be atleast 8 characters long.';
            errorDisplayMessage.innerText = error_msg;
            errorDisplayMessage.style.visibility = 'visible';
            alert(error_msg);
            return;
        }
    }else{
        error_msg = 'Password cannot be empty';
        errorDisplayMessage.innerText = error_msg;
        errorDisplayMessage.style.visibility = 'visible';
        alert(error_msg);
        return;
    }
    if(username_valid && password_valid){
        document.signupForm.submit();
    }
});