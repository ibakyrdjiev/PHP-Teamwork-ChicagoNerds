<?php
//create_cat.php
include 'connect.php';
//include 'header.php';


//check for sign in status
if (!$_SESSION['signed_in']) {
    echo 'Трябва да сте регистриран за да можеш да пускаш отговори.';
} else {
    //a real user posted a real reply
    $sql = "INSERT INTO
					posts(post_content,
						  post_date,
						  post_topic,
						  post_by) 
				VALUES ('" . $_POST['reply-content'] . "',
						NOW(),
						" . mysql_real_escape_string($_GET['id']) . ",
						" . $_SESSION['user_id'] . ")";

    $result = mysql_query($sql);

    if (!$result) {
        echo 'Възникна грешка. Моля опитайте по-късно.';
    } else {
        echo 'Вашия отговор е запазаен. Можете да го видите  <a href="topic.php?id=' . htmlentities($_GET['id']) . '">ТУК</a>.';
    }
}


//include 'footer.php';
?>