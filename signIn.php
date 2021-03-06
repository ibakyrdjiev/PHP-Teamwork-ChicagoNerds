<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SportsMen | Chicago Team</title>
    <link rel="stylesheet" href="signIn.css"/>
</head>
<body>

<?php
//signin.php
//fixed!
include 'connect.php';
include 'functions.php';
siteHeader("asd");
echo '<h3 id="enter">Вход</h3>';


//if is signed
if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
    echo 'Вече си логнат <a href="signout.php">Изход</a>';
} else {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        //if the usr is not registered let we show him the form again
        echo '<form id="signInform" method="post">
            <label for="user_name" id="userL">Потребителско име: </label>
            <input type="text" name="user_name" id="user_name" />
            <label for="user_pass" id="passL">Парола: </label>
            <input type="password" name="user_pass" id="user_pass">
            <input type="submit" value="Sign in" id="submitButton"/>
         </form>';
    } else {
        //check the data
        $errors = array();

        if (!isset($_POST['user_name'])) {
            $errors[] = 'Потребителското име не може да бъде празно.';
          //  var_dump($errors);
        }

        if (!isset($_POST['user_pass'])) {
            $errors[] = 'Паролата не може да бъде празна.';
        }
//иф ве хаже еррорс
        if (!empty($errors)) {
            echo 'Уфф.. не са попълнени добре полетата<br /><br />';
            echo '<ul>';
            foreach ($errors as $key => $value) {
                echo '<li>' . $value . '</li>'; //err list
            }
            echo '</ul>';
        } else {
            //if there are no errors check the intput in the server table
            $query = "SELECT
                        user_id,
                        user_name,
                        user_level
                    FROM
                        users
                    WHERE
                        user_name = '" . htmlentities(strip_tags(mysqli_real_escape_string($con, $_POST['user_name']))) . "'
                    AND
                        user_pass = '" . sha1($_POST['user_pass']) . "'";

            $result = mysqli_query($con, $query);
            if (!$result) {
                //something went wrong, display the error
                echo 'Нещо се прецака, моля опитайте после';
                //posle uncomment samo za test
               echo mysql_error();
            } else {
                //if the server returns info
                //if the info is null
                if (mysqli_num_rows($result) == 0) {
                    echo 'Грешно име или парола.';
                } else {
                    //set the $_SESSION['signed_in'] variable to TRUE
                    $_SESSION['signed_in'] = true;

                    //session for the user data
                    while ($row = mysqli_fetch_assoc($result)) {
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['user_name'] = $row['user_name'];
                        $_SESSION['user_level'] = $row['user_level'];
                    }

                    echo 'Здравей, ' . $_SESSION['user_name'] . '. <a href="index.php">Към Форума:</a>.';
                }
            }
        }
    }
}

siteFooter($con);

?>

</body>
</html>