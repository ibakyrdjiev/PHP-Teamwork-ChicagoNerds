<?php

header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("utf-8");
function siteHeader($title) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css"/>
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="functions.css"/>
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
                echo "Здравей   " . $_SESSION['user_name'] . "! <a href=\"signOut.php\">Изход</a>";
            } else {
                echo '<a href="signIn.php">Вход</a> или <a href="signUp.php">Регистрация</a>';
            }
            ?>
        </div>

    </header>
<?php
}
function showCategories() {
    echo "<table border=1>";
    echo "<thead><tr><th>Име на категория</th><th>Описание</th><th>Добавено на</th></tr></thead>";
    $query = "SELECT * FROM categories WHERE 1";
    $rs = mysql_query($query);
    while($row = mysql_fetch_assoc($rs)) {
        echo "<tr><td>".$row['cat_name']."</td><td>".$row['cat_description']."</td><td>".$row['date_added']."</td></tr>";
    }
    echo "</table>";
}
function editCategories() { //available for admins Only
    echo "<table border=1>";
    echo "<thead><tr><th>Име на категория</th><th>Описание</th><th>Добавено на</th><th>Редактирай</th></tr></thead>";
    $query = "SELECT * FROM categories WHERE 1";
    $rs = mysql_query($query);
    while($row = mysql_fetch_assoc($rs)) {
        echo "<tr><td>".$row['cat_name']."</td>".
             "<td>".$row['cat_description']."</td><td>".$row['date_added']."</td>" .
             "<td><a href=\"create_cat.php?mode=edit&id=".$row['cat_id']."\">Редактирай</a></td>";

        echo "</tr>";
    }
    echo "</table>";
}
function siteFooter() {
    ?>
    <footer>
        <div class="statistic">
            <h3>Кой е онлайн? </h3>
            <p class="onlineNow">
                Общо онлайн: <?php /*Some php logic for online users*/ ?>
            </p>
            <p>
                <span id="legend">Легенда: </span>
                <span class="administrators">Administrators, </span>
                <span class="moderators">Moderators, </span>
                <span class="normalUsers">Normal users</span>
<!--                //Each group could be with different color-->
            </p>
            <h3>Статистика</h3>
            <p class="totalPosts">
                <p>
                    Общо теми : <?php /*PHP logic for total posts*/?>
                </p>
                <p>
                    Общо мнения : <?php /*PHP logic for total opinions*/?>
                </p>
                <p>
                    Общо членове : <?php /*PHP logic for total members*/?>
                </p>
                <p>
                    Най-нов - <?php /*PHP logic for newest member*/?>
                </p>
            </p>
        </div>
        <p id="copyrights">
            Powered by Chicago Nerds
        </p>
    </footer>
    </body>
    </html>
<?php
}


function mainContent() {
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