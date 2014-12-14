<?php
//signin.php
include 'connect.php';
include 'functions.php';
siteHeader("asd");
echo '<h3>Вход</h3>';

//if is signed
if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
    echo 'Вече си логнат <a href="signОut.php">Изход</a>';
} else {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        //if the usr is not registered let we show him the form again
        echo '<form method="post" action="">
            Потребителско име: <input type="text" name="user_name" />
            Парола: <input type="password" name="user_pass">
            <input type="submit" value="Регистрация" />
         </form>';
    } else {
        //check the data
        $errors = array();

        if (!isset($_POST['user_name'])) {
            $errors[] = 'Потребителското име не може да бъде празно.';
            var_dump($errors);
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

            $result = mysql_query($query);
            if (!$result) {
                //something went wrong, display the error
                echo 'Нещо се прецака, моля опитайте после';
                //posle uncomment samo za test
                echo mysql_error();
            } else {
                //if the server returns info
                //if the info is null
                if (mysql_numrows($result) == 0) {
                    echo 'Грешно име или парола.';
                } else {
                    //set the $_SESSION['signed_in'] variable to TRUE
                    $_SESSION['signed_in'] = true;

                    //session for the user data
                    while ($row = mysql_fetch_assoc($result)) {
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

siteFooter()
?>