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
            if (isset($_SESSION)) {
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

function editCategories()
{ //available for admins Only
    echo "<table border=1>";
    echo "<thead><tr><th>Име на категория</th><th>Описание</th><th>Добавено на</th><th>Редактирай</th></tr></thead>";
    $query = "SELECT * FROM categories WHERE 1";
    $rs = mysql_query($query);
    while ($row = mysql_fetch_assoc($rs)) {
        echo "<tr><td>" . $row['cat_name'] . "</td>" .
            "<td>" . $row['cat_description'] . "</td><td>" . $row['date_added'] . "</td>" .
            "<td><a href=\"create_cat.php?mode=edit&id=" . $row['cat_id'] . "\">Редактирай</a></td>";

        echo "</tr>";
    }
    echo "</table>";
}

function siteFooter()
{
    ?>
    <footer>
        <div class="statistic">

            <h3>Статистика</h3>

            <p class="totalPosts">


                <?php
                include "connect.php";
                $query = "SELECT
                user_id
                FROM
                users";

                // echo $query;
                $result = mysqli_query($con, $query);
                // var_dump($result);
                $usersCount = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $usersCount++;
                }
                //echo $usersCount;
                ?>

                <?php
                // include "connect.php";
                $query = "SELECT
                topic_id
                FROM
                topics";

                //   echo $query;
                $result = mysqli_query($con, $query);
                //var_dump($result);
                $topicCount = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $topicCount++;
                }
                //echo $usersCount;
                ?>
                <?php
                // include "connect.php";
                $query = "SELECT
                cat_id
                FROM
                categories";

                // echo $query;
                $result = mysqli_query($con, $query);
                //var_dump($result);
                $categories = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $categories++;
                }
                //echo $usersCount;
                ?>
                <?php
                $query = "SELECT user_name FROM users ORDER BY user_id DESC LIMIT 1";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $lastUsr = $row['user_name'];
               // var_dump($row) ;
              //  var_dump($lastUsr);
                ?>

            <p>
                Общо категории : <?php echo $categories ?>
            </p>

            <p>
                Общо мнения : <?php echo $topicCount ?>
            </p>

            <p>
                Общо членове : <?php echo $usersCount ?>
            </p>

            <p>
                Най-нов - <?php echo $lastUsr ?>
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