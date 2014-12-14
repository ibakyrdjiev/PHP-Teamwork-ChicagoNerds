<?php
//create_cat.php
//session_start();
include 'connect.php';
include 'functions.php';
siteHeader("асд");
echo '<h2>Създаване на категория</h2>';
if ($_SESSION['signed_in'] == false | $_SESSION['user_level'] != 1) {
    //the user is not an admin
    echo 'Не си админ.';
} else {
    //the user is admin
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        //if there is no new cat
        echo '<form method="post" action="">
			Име: <input type="text" name="cat_name" /><br />
			Описание:<br /> <textarea name="cat_description" /></textarea><br /><br />
			<input type="submit" value="Add category" />
		 </form>';
    } else {
        //the form has been posted, so save it in the category table
        $sql = "INSERT INTO categories(cat_name, cat_description, cat_date)
		   VALUES('" . htmlentities(strip_tags(mysqli_real_escape_string($con, $_POST['cat_name']) )). "',
				 '" . htmlentities(strip_tags(mysqli_real_escape_string($con, $_POST['cat_description']))) . "', NOW()  )";
        $result = mysql_query($sql);
        if (!$result) {
            $error = mysql_error();
            if (preg_match_all("/Duplicate entry '.*' for key 'cat_name'/", $error)) {
                echo 'Грешка: вече съществува такава тема.';
            }
            //something went wrong, display the error

        } else {

            //ouu yeah
            echo 'Успешно добавяне на категория.';
        }
    }
}

siteFooter();

