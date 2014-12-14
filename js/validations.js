$(document).ready(function(){
    function disableRegister() {
        $('#registerButton').prop('disabled', 'disabled');
    }
    function enableRegister() {
        $('#registerButton').removeProp('disabled', 'disabled');
    }
    $('#confirmPassReg').on('input', function(){
        var pass = $('#userPassRed').val();
        var confirmPass = $('#confirmPassReg').val();

        if(pass != confirmPass) {
            $('#confirmPassReg').css('background-color', 'red');
            disableRegister();
        }else {
            $('#confirmPassReg').css('background-color', 'white');
            enableRegister();
        }
    });
    $('#userEmailReg').on('input', function() {
        var emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
        var email = $('#userEmailReg').val();
        var isValidMail = emailPattern.test(email);

        if(!isValidMail) {
            $('#userEmailReg').css('border', '2px solid red');
        }else {
            $('#userEmailReg').css('border', '2px solid green');
        }
    });
});
