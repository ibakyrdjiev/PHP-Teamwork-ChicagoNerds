<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SportsMen | Chicago Team</title>
    <link rel="stylesheet" href="signUp.css"/>
</head>
<body>

<?php
//signup.php
//fixed!
include 'connect.php';
include 'functions.php';
siteHeader("Регистрация");
echo '<h3 id="reg">Регистрирай се <span id="stranger">Страннико!!!</span></h3><br />';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //if the form hasn't been posted yet, display it

    echo '<form method="post" id="signUpform">
        <label for="userNameReg" id="userL">Потребителско Име: </label>
 	 	<input type="text" name="user_name" id="userNameReg"/><br />
 	 	<label for="userPassReg" id="passL">Парола: </label>
 		<input type="password" name="user_pass" id="userPassReg"><br />
 		<label for="confirmPassReg" id="cPassL">Моля повторете паролата: </label>
		<input type="password" name="user_pass_check" id="confirmPassReg"><br />
		<label for="userEmailReg" id="emailL">E-mail: </label>
		<input type="email" name="user_email" id="userEmailReg"><br />
 		<input type="submit" value="Регистрация" id="registerButton" />
 	 </form>';
}
else
{

    $errors = array(); /* declare the array for later use */
//check
    if(isset($_POST['user_name']))
    {
        //the user name exists
        if(!ctype_alnum($_POST['user_name']))
        {
            $errors[] = 'Потребителското име може да бъде само от букви и цифри.';
        }
        if(strlen($_POST['user_name']) > 30)
        {
            $errors[] = 'Потребителското име не може да бъде по-дълго от 30 символа.';
        }
    }
    else
    {
        $errors[] = 'Полето за потребителско име не може да остане празно.';
    }
    if(isset($_POST['user_email'])){
        if(!preg_match_all("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $_POST['user_email'])){
            $errors[] = 'Неправилен E-mail адрес';
        }
    }

//check
    if(isset($_POST['user_pass']))
    {
        if($_POST['user_pass'] != $_POST['user_pass_check'])
        {
            $errors[] = 'Паролите не са еднакви.';
        }
    }
    else
    {
        $errors[] = 'Полето за парола не може да бъде празно.';
    }
//check
    if(!empty($errors))
        //this is for BABA PENKA usr
    {
        echo 'Уфф.. не са попълнени добре полетата<br /><br />';
        echo '<ul>';
        foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
        {
            echo '<li>' . $value . '</li>'; /* this generates a nice error list */
        }
        echo '</ul>';
    }
    else
    {
        //save data, escape data and salt it

        $query = "INSERT INTO
					users(user_name, user_pass, user_email ,user_date, user_level)
				VALUES('" . htmlentities(strip_tags(mysqli_real_escape_string($con, $_POST['user_name']))) . "',
					   '" . sha1($_POST['user_pass']) . "',
					   '" . htmlentities(strip_tags(mysqli_real_escape_string($con, $_POST['user_email']))) . "',
						NOW(),
						0)";
//zero is boolean !
        $result = mysqli_query($con, $query);
        //da se maha
      //  var_dump($con);
        if(!$result)
        {
            //error when it shit itself :P
            echo 'Грешка. ';
            //da go manna posle
          $error =  mysql_error();

            if(preg_match_all("/Duplicate entry '\w+' for key 'user_name'/", $error)){
                echo "Вече съществува потребител със същото име";
            }
            if(preg_match_all("/Duplicate entry '\w+' for key 'user_email'/", $error)){
                echo "Този E-maill вече е регистриран";
            }
          //  echo $_SESSION['user_name'];
        }
        else
        {
            echo "Вече си запалянко! Сега <a href=\"signIn.php\"><strong>ВЛЕЗ</strong></a> и можеш да постваш ! :)";
        }
    }
}

siteFooter($con);

?>

</body>
</html>
