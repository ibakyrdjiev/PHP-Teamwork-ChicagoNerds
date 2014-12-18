<?php

include 'connect.php';
include 'functions.php';
siteHeader("Създаване на категория");
echo '<h2>Създаване на категория</h2>';
if (!isset($_SESSION['signed_in']) || $_SESSION['user_level'] != 1) {
    //the user is not an admin
    echo 'Само супер юзърите могат да създават категории.';
} else {
    //the user is admin
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        //if there is no new cat
        echo '<form method="post" action="">
			Име: <input type="text" name="cat_name" /><br />
			Описание:<br /> <textarea name="cat_description" /></textarea><br /><br />
			<input id = "add" type="submit" value="Добави Категория" />
		 </form>';
    } else {
        $categoryName = trim($_POST['cat_name']);
        $categoryDesc = trim($_POST['cat_description']);
        if (isset($categoryName, $categoryDesc) && $categoryName != '' && $categoryDesc != '') {
            if ((strlen($$categoryName) > 4 && strlen($categoryName) < 100) || (strlen($categoryDesc) > 6 && strlen($categoryDesc) < 255)) {
                //the form has been posted, so save it in the category table
                $sql = "INSERT INTO categories(cat_name, cat_description, cat_date)
		   VALUES('" . htmlentities(strip_tags(mysqli_real_escape_string($con, $categoryName) )). "',
				 '" . htmlentities(strip_tags(mysqli_real_escape_string($con, $categoryDesc))) . "', NOW()  )";
                $result = mysqli_query($con, $sql);
                if (!$result) {
                    //   $error = mysql_error();
                    if (preg_match_all("/Duplicate entry '.*' for key 'cat_name'/", $error)) {
                        echo 'Грешка: вече съществува такава тема.';
                    }
                    //something went wrong, display the error

                } else {

                    //ouu yeah
                    echo 'Успешно добавяне на категория.';
                }
            }else {
                echo "<div>";
                echo "<h3>Името на категорията трябва да бъде с дължина между [4..100]</h3>";
                echo "<h3>Описанието на категорията трябва да бъде с дължина между [6..255]</h3>";
                echo "</div>";
            }

        }
    }
}

siteFooter($con);

