<?php
//include "connect.php";
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("utf-8");
function siteHeader($title)
{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css"/>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="functions.css"/>
        <script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="js/validations.js" type="text/javascript"></script>
    </head>
    <body>
    <header>
        <img src="TeamLogo.png" alt="teamLogo"/>
        <nav class="mainNav">
            <ul>
                <li class="topMenu"><a class="item" href="index.php">Начало</a></li>
                <li class="topMenu"><a class="item" href="new_topic.php">Нова тема</a></li>

                <li><a class="topMenu" href="create_cat.php">Нова категория</a></li>

                <li class="topMenu"><a href="about.php">Контакти</a></li>
            </ul>
        </nav>
        <div id="userbar">
            <?php
            if (isset($_SESSION['signed_in'])) {
                echo "Здравей   " . $_SESSION['user_name'] . "! <a href=\"signout.php\">Изход</a>";
            } else {
                echo '<a href="signIn.php">Вход</a> или <a href="signUp.php">Регистрация</a>';
            }
            ?>
        </div>

    </header>
<?php
}

function showCategories()
{
    echo "<table border=1>";
    echo "<thead><tr><th>Име на категория</th><th>Описание</th><th>Добавено на</th></tr></thead>";
    $query = "SELECT * FROM categories WHERE 1";
    $rs = mysql_query($query);
    while ($row = mysql_fetch_assoc($rs)) {
        echo "<tr><td>" . $row['cat_name'] . "</td><td>" . $row['cat_description'] . "</td><td>" . $row['date_added'] . "</td></tr>";
    }
    echo "</table>";
}


function mainContent()
{
    ?>
    <div id="container">
        <section class="forumRules">
            <h2 class="articleMainHeader">Правила на форума</h2>
        </section>
        <section>
            <h2 class="articleMainHeader">Теми</h2>
        </section>
        <!--        Additionally we can add more topics-->

    </div>
<?php
}

function siteFooter($con)
{
    ?>
        <footer>
            <div class="total=cats">
                Общо категории : <?php echo totalCats($con) ?>
            </div>
            <div class="total-members">
                Общо членове : <?php echo totalMembers($con) ?>
            </div>
            <div class="total-categories">
                Общо мнения : <?php echo totalOpinions($con) ?>
            </div>
            <div class="newest-member">
                Най-новият потребител е : <?php echo getNewestMember($con) ?>
            </div>
            <p id="copyrights">
                Powered by Chicago Nerds
            </p>
        </footer>
        </body>
        </html>
<?php

}

function totalMembers($databaseConnection) {
    $query = "SELECT user_id FROM users";
    $result = mysqli_query($databaseConnection, $query);
    $usersCount = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $usersCount++;
    }
    return $usersCount;
}
function totalOpinions($databaseConnection) {
    $query = "SELECT topic_id FROM topics";
    $result = mysqli_query($databaseConnection, $query);
    $topicCount = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $topicCount++;
    }
    return $topicCount;
}
function getNewestMember($databaseConnection) {
    $query = "SELECT user_name FROM users ORDER BY user_id DESC LIMIT 1";
    $result = mysqli_query($databaseConnection, $query);
    $row = mysqli_fetch_assoc($result);
    $lastUsr = $row['user_name'];
    return $lastUsr;
}
function totalCats($databaseConnection) {
    $query = "SELECT cat_id FROM categories";
    $result = mysqli_query($databaseConnection, $query);
    $categories = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $categories++;
    }
    return $categories;
}


