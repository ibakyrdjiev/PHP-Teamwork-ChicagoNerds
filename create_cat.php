<?php
//create_cat.php
//session_start();
include 'connect.php';
include 'functions.php';
siteHeader("Категории");
echo '<h2>Създаване на категория</h2>';
if ($_SESSION['signed_in'] == false | $_SESSION['user_level'] != 1) {
    //the user is not an admin
    echo 'Не си админ.';
    header("Location: index.php");
    exit;
} else {
    //the user is admin
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        //if there is no new cat
        if ($_GET['mode'] === "edit" && $_GET['id'] > 0) {
            $id = (int)$_GET['id'];
            $rs = mysql_query('SELECT * FROM categories WHERE cat_id='.$id);
            $editInfo = mysql_fetch_assoc($rs);
        }
        echo '<form method="post" action="">';
        echo   'Име: <input type="text" name="cat_name" value="'.$editInfo['cat_name'].'"/><br />';
        echo   'Описание:<br /> <textarea name="cat_description" />'.$editInfo['cat_description'].'</textarea><br /><br />';
        echo   '<input type="submit" value="Add category" />';
        if ($_GET['mode'] == "edit") {
            echo '<input type="hidden" name="edit-cat" value="'. $_GET['id'].'">';
        }
        echo '</form>';
    } else {
        $name = htmlentities(trim($_POST['cat_name']));
        $description = htmlentities(trim($_POST['cat_description']));
        //the form has been posted, so save it in the category table
        $id = (int)$_GET['id'];
        if ($_POST['edit-cat'] > 0) {       //Ще редактираме
            mysql_query('UPDATE categories SET cat_name="'.$name.'", cat_description="'.$description.'" WHERE cat_id='.$id);

        }else {
            $sql = "INSERT INTO categories(cat_name, cat_description)
		   VALUES('" . mysqli_real_escape_string($con, $name) . "',
				 '" . mysqli_real_escape_string($con, $description) . "')";

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
    // С кода доло листваме всички налични категории + описанията им
    editCategories();
}


siteFooter();

