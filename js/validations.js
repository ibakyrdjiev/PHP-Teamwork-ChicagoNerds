$(document).ready(function(){
    function disableRegister() {
        var btn = $('#registerButton');
       btn = btn.prop('disabled', true);
    }
    function enableRegister() {
        var btn = $('#registerButton');
        btn = btn.prop('disabled', false);
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
            disableRegister();
            $('#userEmailReg').css('border', '2px solid red');
        }else {
            enableRegister();
            $('#userEmailReg').css('border', '2px solid green');
        }
    });
});
