<!--header-->
<!DOCTYPE>
<html>
<head>
    <title>FORUM</title>
<!--        <link rel="stylesheet" href="style.css"/>-->
</head>
<body>
<h1>Lorem ipsum dolor sit amet, ullamcorper justo id netus tempus</h1>

<div id="wrapper">
    <div id="menu">
        <a class="item" href="index.php">Начало</a>
        <a class="item" href="new_topic.php">Нова тема</a>
        <a class="item" href="create_cat.php">Нова категория</a>


        <div id="userbar">
            <?php
            if ($_SESSION['signed_in']) {
                echo "Здравей   " . $_SESSION['user_name'] . "! <a href=\"signout.php\">Изход</a>";
            } else {
                echo '<a href="signin.php">Вход</a> or <a href="signUp.php">Регистрация</a>.';
            }
            ?>
        </div>

        <div id="content">
